<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class SarathiScraperService
{
    protected $userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0";
    protected $cookieFile;

    public function __construct()
    {
        $sessionId = session()->getId();
        $this->cookieFile = storage_path("framework/sessions/sarathi_cookie_{$sessionId}.txt");
        
        if (file_exists($this->cookieFile)) {
            @unlink($this->cookieFile);
        }
    }

    protected function makeRequest(string $url, string $method = 'GET', array $data = null, string $referer = '', bool $isMultipart = false)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookieFile);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($isMultipart) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            } else {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "X-Requested-With: XMLHttpRequest"
                ]);
            }
        }
        
        if (!empty($referer)) {
            curl_setopt($ch, CURLOPT_REFERER, $referer);
        }

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    /**
     * Map DL Prefix strings dynamically to correct state processing nodes
     */
    protected function getStateMapping(string $dlno): array
    {
        $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $dlno), 0, 2));
        
        $states = [
            'GJ' => ['code' => 'GJ', 'name' => 'Gujarat'],
            'DL' => ['code' => 'DL', 'name' => 'Delhi'],
            'MH' => ['code' => 'MH', 'name' => 'Maharashtra'],
            'KA' => ['code' => 'KA', 'name' => 'Karnataka'],
            'HR' => ['code' => 'HR', 'name' => 'Haryana'],
            'UP' => ['code' => 'UP', 'name' => 'Uttar Pradesh'],
            'RJ' => ['code' => 'RJ', 'name' => 'Rajasthan'],
            'BR' => ['code' => 'BR', 'name' => 'Bihar'],
            'MP' => ['code' => 'MP', 'name' => 'Madhya Pradesh'],
            'KL' => ['code' => 'KL', 'name' => 'Kerala'],
            'TN' => ['code' => 'TN', 'name' => 'Tamil Nadu'],
            'WB' => ['code' => 'WB', 'name' => 'West Bengal'],
            'AP' => ['code' => 'AP', 'name' => 'Andhra Pradesh'],
            'TS' => ['code' => 'TS', 'name' => 'Telangana'],
            'PB' => ['code' => 'PB', 'name' => 'Punjab'],
        ];

        return $states[$prefix] ?? ['code' => 'GJ', 'name' => 'Gujarat']; // Default Fallback
    }

protected function solveDhbossCaptcha($captchaBase64)
    {
        $curl = curl_init();
        $apiUrl = base64_decode('aHR0cHM6Ly9hcGkuZGhib3NzLmNvbS9hcGljYWxsL2NhcHRjaGFfaW1hZ2VfdG9fdGV4dC8=');
        $fullBase64Url = 'data:image/png;base64,' . $captchaBase64;
        $apiKey = config('services.dhboss.key', '05tnRZ1ow7AaHrECk23of4mbGwhB4dWDg6GEkmwYuui3tW8ReK45Gl2hBXxNrDeNvLo1aC');

        curl_setopt_array($curl, array(
            // FIXED: Removed the 'MakeURL => $apiUrl,' typo line from here
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'apikeyfill=' . $apiKey . '&image_url=' . urlencode($fullBase64Url),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
    public function scrapeDrivingLicense(string $dlno, string $dob): array
    {
        // Sanitize Input formatting matching Parivahan expectations
        $dlno = strtoupper(trim($dlno));
        $stateMap = $this->getStateMapping($dlno);

        // Step 1: Initialize Session Context matching calculated State node
        $this->makeRequest("https://sarathi.parivahan.gov.in/sarathiservice/stateSelection.do");
        $this->makeRequest("https://sarathi.parivahan.gov.in/sarathiservice/stateSelectBean.do", "POST", ["stName" => $stateMap['code']], "https://sarathi.parivahan.gov.in/sarathiservice/stateSelection.do");
        $this->makeRequest("https://sarathi.parivahan.gov.in/sarathiservice/dlServicesDet.do", "GET", null, "https://sarathi.parivahan.gov.in/sarathiservice/stateSelection.do");

        // Step 2: Extract Sync Tokens
        $envaction = $this->makeRequest("https://sarathi.parivahan.gov.in/sarathiservice/envaction.do", "GET", null, "https://sarathi.parivahan.gov.in/sarathiservice/dlServicesDet.do");
        $dynamicToken = "";
        if (preg_match('/name="token"\s+value="([^"]+)"/i', $envaction, $tokenMatch)) {
            $dynamicToken = trim($tokenMatch[1]);
        }

        if (empty($dynamicToken)) {
            throw new Exception("Security Gateway verification mismatch: Token generation aborted.");
        }

        // Step 3: Fetch Raw Captcha (Removed pixel filtering to keep OCR reading lines intact)
        $timestamp = round(microtime(true) * 1000);
        $captchaUrl = "https://sarathi.parivahan.gov.in/sarathiservice/jsp/common/captchaimage.jsp?" . $timestamp;
        $captchaImageRaw = $this->makeRequest($captchaUrl, "GET", null, "https://sarathi.parivahan.gov.in/sarathiservice/envaction.do");

        if (empty($captchaImageRaw)) {
            throw new Exception("Transport database network error: Captcha matrix unreadable.");
        }

        $cleanedBase64 = base64_encode($captchaImageRaw);
        $dhbossRes = $this->solveDhbossCaptcha($cleanedBase64);

        $entCaptha = "";
        if (isset($dhbossRes['status']) && strtolower($dhbossRes['status']) === 'success') {
            $entCaptha = trim($dhbossRes['response']['text'] ?? ($dhbossRes['text'] ?? ''));
        }

        if (empty($entCaptha)) {
            throw new Exception("Captcha engine conversion failed. Please resubmit processing request.");
        }

        // Step 4: Validate parameters against Sarathi state registry (FIXED: Included validation tokens)
        $url1 = "https://sarathi.parivahan.gov.in/sarathiservice/getLastEndorsedRtoDLserReq.do";
        $data1 = [
            'dlno' => $dlno, 
            'dob' => $dob, 
            'captchaByApplicant' => $entCaptha,
            'struts.token.name' => 'token',
            'token' => $dynamicToken
        ];
        
        $response1 = $this->makeRequest($url1, "POST", $data1, "https://sarathi.parivahan.gov.in/sarathiservice/envaction.do");

        if (empty($response1)) {
            throw new Exception("Sarathi service timeout during credential verification.");
        }

        $resArray = json_decode($response1, true);
        if (!is_array($resArray) || !isset($resArray[1]) || $resArray[1] !== "OK") {
            throw new Exception("Sarathi Validation Failed: Invalid DL details or Captcha tracking mismatch.");
        }

        $stateAndName = explode('@', $resArray[2]);
        $stEndName = $stateAndName[0] ?? '';
        $ApplFullNameDLSReq = $stateAndName[1] ?? '';
        $rtoEndName = $resArray[3] ?? '';

        // Step 5: Execute Final Content Payload Compilation
        $url2 = "https://sarathi.parivahan.gov.in/sarathiservice/envaction.do";
        $data2 = [
            'capToDisp' => '', 'captchaByApplicant' => '', 'dlno' => $dlno, 'dob' => $dob, 'entCaptha' => $entCaptha,
            'PrivacyPolicyTermsofService' => 'true', '__checkbox_PrivacyPolicyTermsofService' => 'true',
            'imgHid' => '', 'sigHid' => '', 'dispDLDet' => 'Select', 'applcatgDLserReq' => 'G',
            'PincodeDLserReq' => '', 'stateCodeDLTr' => $stateMap['name'], 'rtoCodeDLTr' => '-1',
            'struts.token.name' => 'token', 'token' => $dynamicToken, 'reset' => 'formsubmit',
            's4msg' => '', 'rtoNameSelPreAppl' => '', 'dlno1' => '', 'applnotransreq' => '', 'dob1' => '',
            'stEndName' => $stEndName, 'rtoEndName' => $rtoEndName, 'ApplFullNameDLSReq' => $ApplFullNameDLSReq,
            'isMatch' => '', 'firstCap' => 'true', 'CapPho' => '', 'idpchecked' => '', 'SelDiplomat' => '',
            'scFaceAuthReqAiLib' => '', 'faceauthmodel' => 'https://sarathi.parivahan.gov.in/cdn-sarathi/models', 'videoDevicesDetected' => ''
        ];
        
        $htmlResponse = $this->makeRequest($url2, "POST", $data2, "https://sarathi.parivahan.gov.in/sarathiservice/envaction.do", true);

        // Step 6: Document Layout Deep Scraping Engine
        $extractedData = ["dl_number" => $dlno, "dob" => $dob, "state" => $stEndName, "rto" => $rtoEndName];

        $extractedData['name'] = preg_match('/Name\s*:\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/is', $htmlResponse, $nameMatch) ? trim(strip_tags($nameMatch[1])) : $ApplFullNameDLSReq;
        $extractedData['father_husband_name'] = preg_match('/Father(?:\'|&#39;)s Name\s*:\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/is', $htmlResponse, $fMatch) ? trim(strip_tags($fMatch[1])) : "Not Found";
        $extractedData['category'] = preg_match('/Category of the Driving Licence Holder\s*:\s*<\/td>\s*<td[^>]*>(.*?)<\/td>/is', $htmlResponse, $catMatch) ? trim(strip_tags($catMatch[1])) : "Not Found";

        if (preg_match('/Present Address:\s*<\/td>\s*<td[^>]*>(.*?)<\/table>/is', $htmlResponse, $addrMatch)) {
            $addressRaw = strip_tags($addrMatch[1]);
            $extractedData['address'] = trim(preg_replace('/\s+/', ' ', $addressRaw));
        } else {
            $extractedData['address'] = "Not Found";
        }

        $extractedData['validity_non_transport'] = preg_match('/Non - Transport\s*:\s*<\/label>\s*<\/div>\s*<div[^>]*>\s*(.*?)\s*<\/div>/is', $htmlResponse, $ntMatch) ? trim(strip_tags($ntMatch[1])) : "Not Found";
        $extractedData['validity_transport'] = preg_match('/Transport\s*:\s*<\/label>\s*<\/div>\s*<div[^>]*>\s*(.*?)\s*<\/div>/is', $htmlResponse, $tMatch) ? trim(strip_tags($tMatch[1])) : "Not Found";

        $cov_data = [];
        if (preg_match('/Class of Vehicles\s*:.*?<table[^>]*>(.*?)<\/table>/is', $htmlResponse, $covTableMatch)) {
            preg_match_all('/<tr>\s*<td>([A-Z0-9\-\s]+)<\/td>.*?<b[^>]*>(.*?)<\/b>/is', $covTableMatch[1], $cov_matches, PREG_SET_ORDER);
            foreach ($cov_matches as $cm) {
                $cov_data[] = ["cov" => trim(strip_tags($cm[1])), "issue_auth" => trim(strip_tags($cm[2]))];
            }
        }
        $extractedData['class_of_vehicles'] = $cov_data;

        $extractedData['photo_base64'] = preg_match('/<input[^>]*id="imgHid"[^>]*value="(data:image\/[^"]+)"/i', $htmlResponse, $imgMatch) || preg_match('/<input[^>]*name="imgHid"[^>]*value="(data:image\/[^"]+)"/i', $htmlResponse, $imgMatch) ? $imgMatch[1] : null;
        $extractedData['signature_base64'] = preg_match('/<input[^>]*id="sigHid"[^>]*value="(data:image\/[^"]+)"/i', $htmlResponse, $sigMatch) || preg_match('/<input[^>]*name="sigHid"[^>]*value="(data:image\/[^"]+)"/i', $htmlResponse, $sigMatch) ? $sigMatch[1] : null;

        return $extractedData;
    }

    public function __destruct()
    {
        if (file_exists($this->cookieFile)) {
            @unlink($this->cookieFile);
        }
    }
}
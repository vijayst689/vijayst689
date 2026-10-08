alter table users add cpassword varchar(10) DEFAULT NULL after password;
alter table users add profile varchar(10) DEFAULT NULL after cpassword;
alter table users add status varchar(10) DEFAULT NULL after profile;
alter table users add user_type_id varchar(10) DEFAULT NULL after name;
alter table users add gender varchar(10) DEFAULT NULL after user_type_id;
alter table users add phone varchar(10) DEFAULT NULL after gender;
alter table users add address varchar(10) DEFAULT NULL after phone;
alter table users add aadhaar_no varchar(10) DEFAULT NULL after address;
alter table users add date_of_birth varchar(10) DEFAULT NULL after aadhaar_no;
alter table users add status varchar(10) DEFAULT NULL after date_of_birth;
alter table users add wallet decimal(10,2) DEFAULT NULL after status;

CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT '0',
  `service_name` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(10)  DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `cus_document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(10) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `cus_docx` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table users add refferal_id varchar(10) DEFAULT NULL after user_type_id;
alter table users modify wallet decimal(10,2) DEFAULT 0;

CREATE TABLE `applied_service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `customer_id` int(11) DEFAULT 0,
  `service_amount` decimal(10,2) DEFAULT 0,
  `status` varchar(20) DEFAULT NULL,
  `applied_date` varchar(20) DEFAULT NULL,
  `completed_date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table services add service_image varchar(10) DEFAULT NULL after service_name;

CREATE TABLE `service_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


alter table users add aadhaar_file varchar(10) DEFAULT NULL after aadhaar_no;
alter table users add pan_no varchar(10) DEFAULT NULL after aadhaar_file;
alter table users add pan_file varchar(10) DEFAULT NULL after pan_no;


alter table msme add distributor_id int DEFAULT 0 after retailer_id;

22/10/2024

alter table msme modify acknowledgement varchar(20);

alter table tnega_services modify aadhaar_back varchar(20);
alter table tnega_services modify old_can_document varchar(20);
alter table tnega_services modify salary_slip varchar(20);
alter table tnega_services modify pancard varchar(20);
alter table tnega_services modify income_yearly varchar(20);
alter table tnega_services modify income_monthly varchar(20);
alter table tnega_services modify relationship varchar(20);
alter table tnega_services modify tc_community_certificate varchar(20);
alter table tnega_services modify income_certificate varchar(20);
alter table tnega_services modify community_certificate varchar(20);
alter table tnega_services modify birth_certificate varchar(20);
alter table tnega_services modify smartcard_online varchar(20);
alter table tnega_services modify voterid varchar(20);
alter table tnega_services modify driving_license varchar(20);
alter table tnega_services modify marksheet varchar(20);
alter table tnega_services modify mrg_invitation varchar(20);
alter table tnega_services modify deed varchar(20);
alter table tnega_services modify bank_pass_book varchar(20);
alter table tnega_services modify personal_strap varchar(20);
alter table tnega_services modify joint_strap varchar(20);
alter table tnega_services modify deed_details varchar(20);
alter table tnega_services modify deed_yes varchar(20);
alter table tnega_services modify hus_wife_photo varchar(20);
alter table tnega_services modify permanent_social_certificate_groom varchar(20);
alter table tnega_services modify bride_permanent_social_certificate varchar(20);
alter table tnega_services modify mrg_registration_certificate varchar(20);
alter table tnega_services modify anyothers_certificate varchar(20);
alter table tnega_services modify chitta varchar(20);
alter table tnega_services modify aggregation varchar(20);
alter table tnega_services modify ec_certificate varchar(20);
alter table tnega_services modify villankam varchar(20);
alter table tnega_services modify vao_certificate varchar(20);
alter table tnega_services modify self_declaration_certificate varchar(20);
alter table tnega_services modify other_certificate varchar(20);
alter table tnega_services modify passport varchar(20);
alter table tnega_services modify placement_registration varchar(20);
alter table tnega_services modify school_transfer_certificate varchar(20);
alter table tnega_services modify study_proof varchar(20);
alter table tnega_services modify family_income_certificate varchar(20);
alter table tnega_services modify acknowledgement varchar(20);

alter table tnega_services add mrg_docdetails varchar(30) DEFAULT NULL after mrg_documents;
alter table tnega_services add any_proof varchar(30) DEFAULT NULL after mrg_docdetails;
alter table tnega_services add age_proof varchar(30) DEFAULT NULL after smartcard_online;

alter table users add smartcard varchar(20) DEFAULT NULL after pan_file;
alter table users add signature varchar(20) DEFAULT NULL after smartcard;
alter table users add dist_id int(11) DEFAULT NULL after signature;
alter table users add taluk_id int(11) DEFAULT NULL after dist_id;
alter table users add panchayath_id int(11) DEFAULT NULL after taluk_id;
alter table users add can_details varchar(20) DEFAULT NULL after panchayath_id;
alter table users add can_number varchar(20) DEFAULT NULL after can_details;

alter table gst modify business_address varchar(200);
alter table gst add mobile varchar(20) after business_address;



alter table itr add email varchar(60) DEFAULT NULL after mobile;
alter table itr add aadhaar_no varchar(15) DEFAULT NULL after email;

CREATE TABLE tec_exam (
  id int(11) NOT NULL AUTO_INCREMENT,
  service_id int(11) DEFAULT 0,
  user_id int(11) DEFAULT 0,
  retailer_id int(11) DEFAULT 0,
  distributor_id int(11) DEFAULT 0,
  admin_id int(11) DEFAULT 0,
  amount decimal(10,2) DEFAULT 0.00,
  tec_number varchar(50) DEFAULT NULL,
  tec_password varchar(20) DEFAULT NULL,
  aadhaar_card varchar(20) DEFAULT NULL,
  photo varchar(20) DEFAULT NULL,
  acknowledgement varchar(20) DEFAULT NULL,
  status varchar(20) DEFAULT NULL,
  remarks varchar(100) DEFAULT NULL,
  application_no varchar(50) DEFAULT NULL,
  certificate varchar(20) DEFAULT NULL,
  applied_date varchar(10) DEFAULT NULL,
  completed_date varchar(10) DEFAULT NULL,
  created_at varchar(10) DEFAULT NULL,
   PRIMARY KEY (id)
) ENGINE=InnoDB;

alter table tec_exam add applicant_name varchar(30) DEFAULT NULL after tec_password;
alter table tec_exam add mobile varchar(10) DEFAULT NULL after applicant_name;
alter table tec_exam add gender varchar(10) DEFAULT NULL after mobile;
alter table tec_exam add district varchar(15) DEFAULT NULL after gender;
alter table tec_exam add father_name varchar(30) DEFAULT NULL after district;
alter table tec_exam add email varchar(30) DEFAULT NULL after father_name;
alter table tec_exam add dob varchar(10) DEFAULT NULL after email;
alter table tec_exam add address varchar(200) DEFAULT NULL after dob;

//23/10/2024

CREATE TABLE `smartcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT '0',
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `birth_certificate` varchar(20) DEFAULT NULL,
  `voter_id` varchar(20) DEFAULT NULL,
  `death_certificate` varchar(20) DEFAULT NULL,
  `mrg_certificate` varchar(20) DEFAULT NULL,
  `mrg_invitation` varchar(20) DEFAULT NULL,
  `passport` varchar(20) DEFAULT NULL,
  `electricity_bill_receipt` varchar(20) DEFAULT NULL,
  `telephone_charges` varchar(20) DEFAULT NULL,
  `gas_cylinder_receipt` varchar(20) DEFAULT NULL,
  `property_tax_applicant_owns_house` varchar(20) DEFAULT NULL,
  `lease_deed` varchar(20) DEFAULT NULL,
  `allotment_rder_of_slum_replacement_board` varchar(20) DEFAULT NULL,
  `bond_leave_proof` varchar(20) DEFAULT NULL,
  `first_page_of_bank_account_book` varchar(20) DEFAULT NULL,
  `name_tamil` varchar(20) DEFAULT NULL,
  `name_english` varchar(20) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `monthly_income` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table smartcard add pin_code varchar(20) DEFAULT NULL after photo;
alter table smartcard add father_or_husband_english varchar(50) DEFAULT NULL after name_english;
alter table smartcard add father_or_husband_tamil varchar(50) DEFAULT NULL after name_tamil;
alter table smartcard add application_no varchar(50) DEFAULT NULL after acknowledgement;
alter table smartcard add any_document varchar(100) DEFAULT NULL after application_no;
alter table smartcard modify acknowledgement varchar(20);


alter table smartcard add bank_passbook varchar(50) DEFAULT NULL after passport;
alter table smartcard add family_head_name varchar(50) DEFAULT NULL after bank_passbook;
alter table smartcard add email_id varchar(50) DEFAULT NULL after family_head_name;
alter table smartcard add monthly_income varchar(50) DEFAULT NULL after email_id;
alter table smartcard add family_head_photo varchar(50) DEFAULT NULL after monthly_income;
alter table smartcard add address_tamil_1 varchar(50) DEFAULT NULL after family_head_photo;
alter table smartcard add address_tamil_2 varchar(50) DEFAULT NULL after address_tamil_1;
alter table smartcard add address_tamil_3 varchar(50) DEFAULT NULL after address_tamil_2;
alter table smartcard add address_english_1 varchar(50) DEFAULT NULL after address_tamil_3;
alter table smartcard add address_english_2 varchar(50) DEFAULT NULL after address_english_1;
alter table smartcard add address_english_3 varchar(50) DEFAULT NULL after address_english_2;
alter table smartcard add gas_connection_no varchar(50) DEFAULT NULL after address_english_3;

alter table tnega_services add distributor_id int DEFAULT 0 after retailer_id;
alter table smartcard add retailer_id int Default 0 after user_id;
alter table smartcard add distributor_id int Default 0 after retailer_id;


alter table smartcard_otp add relationship varchar(20) DEFAULT NULL; 

//24-10-2024

CREATE TABLE `can_edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `can_number` varchar(15) DEFAULT NULL,
  `name_tamil` varchar(50) DEFAULT NULL,
  `name_english` varchar(50) DEFAULT NULL,
  `personalized_name_english` varchar(50) DEFAULT NULL,
  `personalized` varchar(50) DEFAULT NULL,
  `personalized_name_tamil` varchar(50) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `relationship_name_tamil` varchar(50) DEFAULT NULL,
  `relationship_name_english` varchar(50) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `education` varchar(50) DEFAULT NULL,
  `work` varchar(50) DEFAULT NULL,
  `door_no` varchar(20) DEFAULT NULL,
  `village_administrative_area` varchar(20) DEFAULT NULL,
  `community` varchar(20) DEFAULT NULL,
  `caste` varchar(20) DEFAULT NULL,
  `maritial_status` varchar(20) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_number` varchar(15) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `smartcard_number` varchar(15) DEFAULT NULL,
  `street_name_tamil` varchar(50) DEFAULT NULL,
  `postal_name` varchar(50) DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `pin_code` varchar(15) DEFAULT NULL,
  `original_dob` varchar(10) DEFAULT NULL,
  `new_mobile_no` varchar(10) DEFAULT NULL,
  `certificate_name` varchar(50) DEFAULT NULL,
  `address_tamil` varchar(200) DEFAULT NULL,
  `address_english` varchar(200) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
   PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE TABLE `aadhaarcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `name_english` varchar(30) DEFAULT NULL,
  `name_tamil` varchar(30) DEFAULT NULL,
  `address_tamil` varchar(200) DEFAULT NULL,
  `address_english` varchar(200) DEFAULT NULL,
  `address_proof` varchar(200) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table aadhaarcard add aadhaar_no varchar(12) after aadhaar_card;

alter table aadhaarcard add retailer_id int Default 0 after user_id;
alter table aadhaarcard add distributor_id int Default 0 after retailer_id;
alter table aadhaarcard add application_no varchar(50) DEFAULT NULL after acknowledgement;
alter table aadhaarcard add proof varchar(20) DEFAULT NULL after address_proof;
alter table aadhaarcard modify acknowledgement varchar(20);

alter table smartcard add commodity_card varchar(20) DEFAULT NULL after application_no;
alter table smartcard add rice_card varchar(20) DEFAULT NULL after commodity_card;
alter table smartcard add sugar_card varchar(20) DEFAULT NULL after rice_card;
alter table smartcard add others varchar(20) DEFAULT NULL after sugar_card;
alter table smartcard add any_proof varchar(40) DEFAULT NULL after sugar_card;
alter table smartcard add new_proof varchar(40) DEFAULT NULL after any_proof;
alter table smartcard add certificate varchar(20) DEFAULT NULL after new_proof;

alter table smartcard add applicant_reciept varchar(20) DEFAULT NULL after certificate;
alter table smartcard add smart_mobile varchar(10) DEFAULT NULL after applicant_reciept;
alter table smartcard add change_cardtype varchar(20) DEFAULT NULL after smart_mobile;
alter table smartcard add smartcard_online varchar(20) DEFAULT NULL after change_cardtype;

alter table tnega_services add certificate varchar(20) DEFAULT NULL after status;


Folder Create

bank_passbook
//26-10-24
alter table aadhaarcard add pan_card_no varchar(15) after proof;
alter table aadhaarcard add aadhaar_entrolment_slip varchar(20) after pan_card_no;
alter table aadhaarcard add smart_link_no varchar(15) after aadhaar_entrolment_slip;
alter table aadhaarcard add documents varchar(30) after  smart_link_no;

CREATE TABLE `voterid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `voter_id` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `epic_no` varchar(10) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
   PRIMARY KEY (`id`)
  ) ENGINE=InnoDB;

CREATE TABLE `nalavariyam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `mobile` varchar(10) DEFAULT NULL,
  `register_no` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB;


CREATE TABLE `bond` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `service_id` int(11) DEFAULT 0,
 `user_id` int(11) DEFAULT 0,
 `retailer_id` int(11) DEFAULT 0,
 `distributor_id` int(11) DEFAULT 0,
 `admin_id` int(11) DEFAULT 0,
 `amount` decimal(10,2) DEFAULT 0.00,
 `applicant_name` varchar(50) DEFAULT NULL,
 `document_number` varchar(20) DEFAULT NULL,
 `aadhaar_no` varchar(12) DEFAULT NULL,
 `year` varchar(10) DEFAULT NULL,
 `dist_id` int(11) DEFAULT 0,
 `taluk_id` int(11) DEFAULT 0,
 `panchayath_id` int(11) DEFAULT 0,
 `acknowledgement` varchar(20) DEFAULT NULL,
 `application_no` varchar(20) DEFAULT NULL,
 `status` varchar(20) DEFAULT NULL,
 `remarks` varchar(100) DEFAULT NULL,
 `applied_date` varchar(10) DEFAULT NULL,
 `completed_date` varchar(10) DEFAULT NULL,
 `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `fssai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `shop_name` varchar(50) DEFAULT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
   PRIMARY KEY (`id`)
  ) ENGINE=InnoDB;

  CREATE TABLE `covid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
   PRIMARY KEY (`id`)
  ) ENGINE=InnoDB;

  alter table fssai add old_food_license varchar(20) after pan_card;

CREATE TABLE `pancard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `license` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `service_id` int(11) DEFAULT 0,
 `user_id` int(11) DEFAULT 0,
 `retailer_id` int(11) DEFAULT 0,
 `distributor_id` int(11) DEFAULT 0,
 `admin_id` int(11) DEFAULT 0,
 `amount` decimal(10,2) DEFAULT 0.00,
 `reg_cell_number` varchar(10) DEFAULT NULL,
 `aadhaar_card` varchar(20) DEFAULT NULL,
 `dob` varchar(10) DEFAULT NULL,
 `driving_license` varchar(20) DEFAULT NULL,
 `id_proof` varchar(20) DEFAULT NULL,
 `acknowledgement` varchar(20) DEFAULT NULL,
 `status` varchar(20) DEFAULT NULL,
 `remarks` varchar(100) DEFAULT NULL,
 `application_no` varchar(50) DEFAULT NULL,
 `certificate` varchar(20) DEFAULT NULL,
 `applied_date` varchar(10) DEFAULT NULL,
 `completed_date` varchar(10) DEFAULT NULL,
 `created_at` varchar(10) DEFAULT NULL,
   PRIMARY KEY (`id`)
  ) ENGINE=InnoDB;

CREATE TABLE `pancard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `pancard_type` varchar(20) DEFAULT NULL,
  `relative_name` varchar(20) DEFAULT NULL,
  `email_id` varchar(30) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


alter table tnega_services add tailoring_certificate text default null;

CREATE TABLE `tailor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `significant` varchar(20) DEFAULT NULL,
  `father_or_hus_name` varchar(30) DEFAULT NULL,
  `door_no` varchar(20) DEFAULT NULL,
  `street_name` varchar(30) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `pmkissan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `land_document` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;




alter table aadhaarcard add enrollment_slip varchar(20) after address_proof;
alter table aadhaarcard add correction_proof varchar(20) after enrollment_slip;
alter table aadhaarcard add enrollment_no varchar(20) after correction_proof;
alter table aadhaarcard add enrollment_type varchar(30) after enrollment_no;


alter table can_edit add relationship1 varchar(50) after relationship_name_english;
alter table can_edit add mother_name_tamil varchar(50) after relationship1;
alter table can_edit add mother_name_english varchar(50) after mother_name_tamil;

CREATE TABLE `birth_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `childname` varchar(30) DEFAULT NULL,
  `date_of_birth` varchar(10) DEFAULT NULL,
  `place_of_birth` varchar(20) DEFAULT NULL,
  `hospital_name` varchar(50) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


alter table can_edit modify address_tamil varchar(200);

alter table tec_exam add dist_id int(11) DEFAULT NULL after amount;
alter table tec_exam add taluk_id int(11) DEFAULT NULL after dist_id;
alter table tec_exam add panchayath_id int(11) DEFAULT NULL after taluk_id;
alter table tec_exam add name varchar(30) DEFAULT NULL after panchayath_id;
alter table tec_exam add shop_name varchar(50) DEFAULT NULL after mobile;
alter table tec_exam add shop_address varchar(200) DEFAULT NULL after shop_name;
alter table tec_exam add postal_name varchar(30) DEFAULT NULL after shop_address;
alter table tec_exam add village_name varchar(30) DEFAULT NULL after postal_name;
alter table tec_exam add door_no varchar(15) DEFAULT NULL after village_name;
alter table tec_exam add street_name varchar(30) DEFAULT NULL after village_name;
alter table tec_exam add pincode varchar(10) DEFAULT NULL after street_name;
alter table tec_exam add pan_card varchar(20) DEFAULT NULL after pincode;
alter table tec_exam add tec_certificate varchar(20) DEFAULT NULL after pan_card;
alter table tec_exam add bank_passbook varchar(20) DEFAULT NULL after tec_certificate;
alter table tec_exam add voterid varchar(20) DEFAULT NULL after bank_passbook;
alter table tec_exam add bc_agent_certificate varchar(20) DEFAULT NULL after voterid;


alter table tnega_services add family_plannnig_certificate varchar(20) after tailoring_certificate;
alter table tnega_services add birth_certificate_children varchar(20) after family_plannnig_certificate;
alter table tnega_services add id_proof varchar(20) after birth_certificate_children;
alter table tnega_services add family_photo varchar(20) after id_proof;
alter table tnega_services add handicapped_proof varchar(20) after family_photo;
alter table tnega_services add udid_card varchar(20) after handicapped_proof;
alter table tnega_services add registered_deed varchar(20) after udid_card;
alter table tnega_services add chitta_and_villangam varchar(20) after registered_deed;
alter table tnega_services add property_details varchar(20) after chitta_and_villangam;
alter table tnega_services add residential_certificate varchar(20) after property_details;
alter table tnega_services add damage_certificate varchar(20) after residential_certificate;


alter table tec_exam add csc_id_number varchar(20) DEFAULT NULL after bc_agent_certificate;
alter table tec_exam add csc_password varchar(15) DEFAULT NULL after csc_id_number;
alter table tec_exam add e_aadhaar_pdf varchar(15) DEFAULT NULL after csc_password;
alter table tec_exam add e_aadhaar_password varchar(15) DEFAULT NULL after e_aadhaar_pdf;
alter table tec_exam add signature varchar(20) DEFAULT NULL after photo;

alter table tec_exam modify e_aadhaar_pdf varchar(20);

CREATE TABLE `medicalscheme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `family_head_name` varchar(30) DEFAULT NULL,
  `smartcard_onlineprint` varchar(20) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `allfamily_mem_aadhaarcard` varchar(20) DEFAULT NULL,
  `family_head_photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

ALTER TABLE `license` CHANGE `reg_cell_number` `driving_license_no` VARCHAR(15)  DEFAULT NULL;
alter table license add rc_number varchar(15) DEFAULT NULL after driving_license_no;

CREATE TABLE `voterid_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `wrong_data` varchar(100) DEFAULT NULL,
  `new_data` varchar(100) DEFAULT NULL,
  `correction_documents` varchar(50) DEFAULT NULL,
  `voterid_correction` varchar(20) DEFAULT NULL,
  `doc` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table tec_exam add any_proof varchar(100) DEFAULT NULL after signature;

//19-11-24
alter table birth_certificate modify place_of_birth varchar(100);
alter table birth_certificate add date_of_death varchar(10) DEFAULT NULL after date_of_birth;
alter table birth_certificate add place_of_death varchar(100) DEFAULT NULL after date_of_death;

CREATE TABLE `dharsan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `darshan_date` varchar(10) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table users add rawallet decimal(10,2) DEFAULT 0 after wallet;
alter table payment add newbalance decimal(10,2) DEFAULT 0 after amount;

alter table services add ser_id int(11) DEFAULT 0 after parent_id;


22-11-2024

alter table family_member add income int(11) DEFAULT 0 after relation_status;
alter table family_member add profession varchar(20) DEFAULT NULL after income;


CREATE TABLE `recharge` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) DEFAULT NULL,
  `circle` varchar(10) DEFAULT NULL,
  `operator` varchar(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0,
  `commission_amount` decimal(10,2) DEFAULT 0,
  `recharge_date` date not NULL,
  `recharge_time` varchar(10) DEFAULT NULL,
  user_id int DEFAULT 0,
  plan_id int DEFAULT 0,
  usertx varchar(20) DEFAULT NULL,
  status varchar(20) DEFAULT NULL,
  message varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;


alter table aadhaarcard add certificate varchar(20) DEFAULT NULL after acknowledgement;
alter table voterid modify application_no varchar(40);


CREATE TABLE `callback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `operator` varchar(200) DEFAULT NULL,
  `callback_date` varchar(10) DEFAULT NULL,
  `callback_time` varchar(10) DEFAULT NULL,
  `usertx` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  message varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table payment add newbalance decimal(10,2) DEFAULT 0 after amount;

//26-11-24
alter table dharsan add route varchar(50) DEFAULT NULL after time;

CREATE TABLE `operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT 0.00,
  `retailer_commission` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

29-11-2024

CREATE TABLE `smartcard_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  `admin_amount` decimal(10,2) DEFAULT 0,
  `time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `pan_callback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `opid` varchar(200) DEFAULT NULL,
  `callback_date` varchar(10) DEFAULT NULL,
  `callback_time` varchar(10) DEFAULT NULL,
  `usertx` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;



CREATE TABLE `service_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT 0,
  `service_type` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;



alter table pancard add pan_no varchar(20) DEFAULT NULL after name;
alter table pancard add dob varchar(20) DEFAULT NULL after pan_no;
alter table users add smartcard_no varchar(15) DEFAULT NULL after smartcard;

CREATE TABLE `agentregister` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `door_no` varchar(20) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `taluk` varchar(50) DEFAULT NULL,
  `post_office` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `village` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table agentregister add userid int DEFAULT 0;
alter table agentregister add parent_id int DEFAULT 0;

alter table users add rawallet decimal(10,2) DEFAULT NULL after wallet;



CREATE TABLE `find_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0,
  `ser_image` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `find_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `pancard_find` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `father_name` varchar(200) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `dl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `dlnumber` varchar(20) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `rc` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `rc_no` varchar(10) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table pancard_find add amount decimal(10,2) after service_id;

alter table dl add amount decimal(10,2) after service_id;
alter table rc add amount decimal(10,2) after service_id;
alter table ration add amount decimal(10,2) after service_id;

CREATE TABLE `ration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table ramji_payment add newbalance decimal(10,2) DEFAULT 0 after amount;

INSERT INTO `find_services` VALUES (1,'Adhaar to Pan Number',12.00,'1.jpg','Active','2024-12-19 09:38:31'),(2,'Pan To Pan Details',11.00,'2.jpg','Active','2024-12-19 09:45:15'),(3,'Driving License PDF',7.00,'3.jpg','Active','2024-12-19 09:48:00'),(4,'RC Pdf',10.00,'4.jpg','Active','2024-12-19 09:49:12'),(5,'Smart Card Pdf',7.00,'5.jpg','Active','2024-12-19 09:51:21');


    CREATE TABLE `ramji_payment` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `from_id` int(11) DEFAULT 0,
    `to_id` int(11) DEFAULT 0,
    `amount` decimal(10,2) DEFAULT 0.00,
    `iscommission` tinyint(4) DEFAULT 0,
    `customer_id` int(11) DEFAULT NULL,
    `service_id` int(11) DEFAULT NULL,
    `pay_id` int(11) DEFAULT NULL,
    `service_status` varchar(20) DEFAULT NULL,
    `message` varchar(100) DEFAULT NULL,
    `ad_info` varchar(100) DEFAULT NULL,
    `ad_info2` varchar(100) DEFAULT NULL,
    `paid_image` varchar(100) DEFAULT NULL,
    `time` varchar(100) DEFAULT NULL,
    `paydate` varchar(50) DEFAULT NULL,
    `log_id` int(11) DEFAULT NULL,
    `k_status` int(11) DEFAULT 1,
    `service_entity` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB;


CREATE TABLE `user_permission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `parent_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `utility_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;


INSERT INTO `utility_services` VALUES (1,'Mobile Recharge','1.png','Active','2024-12-20 10:21:50'),(2,'DTH Recharge','2.jpg','Active','2024-12-20 10:20:22'),(3,'Electricity Bill Payments','3.jpg','Active','2024-12-26 17:47:16'),(4,'Lic Bill Payments','4.png','Active','2024-12-26 17:50:32'),(5,'Bus Ticket Booking','5.png','Active','2024-12-26 17:53:00');


CREATE TABLE `operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT 0.00,
  `admin_commission` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `operator` VALUES (1,'A','1','Airtel',2.30,1.90),(2,'BT','1','BSNL TOP UP',5.80,4.00),(3,'RC','1','JIO',1.30,1.00),(4,'V','1','Vodafone',4.00,3.50),(5,'BR','1','BSNL STV',5.80,4.00),(6,'I','1','IDEA',4.00,3.50),(7,'ATV','2','Airtel Digital TV',4.20,3.50),(8,'DTV','2','Dish TV',4.40,3.70),(9,'STV','2','SUNDIRECT DTH TV',3.50,3.00),(10,'VTV','2','VIDEOCON DTH TV',4.20,3.50),(11,'TTV','2','TATASKY DTH TV',4.10,3.50);

CREATE TABLE `recharge` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) DEFAULT NULL,
  `circle` varchar(10) DEFAULT NULL,
  `operator` varchar(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0,
  `commission_amount` decimal(10,2) DEFAULT 0,
  `recharge_date` date not NULL,
  `recharge_time` varchar(10) DEFAULT NULL,
  user_id int DEFAULT 0,
  plan_id int DEFAULT 0,
  usertx varchar(20) DEFAULT NULL,
  status varchar(20) DEFAULT NULL,
  message varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `recharge_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT '0',
  `service_id` int DEFAULT '0',
  `distributor_amount` decimal(10,2) DEFAULT '0.00',
  `retailer_amount` decimal(10,2) DEFAULT '0.00',
  `customer_amount` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `panservice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `panpayment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

08-01-2025

CREATE TABLE `voter_find` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `epic_no` varchar(20) DEFAULT NULL,
  `scode` varchar(20) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `new_mobile` varchar(10) DEFAULT NULL,
  `state_name` varchar(50) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

INSERT INTO `find_services` VALUES (1,'Adhaar to Pan Number',12.00,'1.jpg','Active','2024-12-19 09:38:31'),(2,'Pan To Pan Details',11.00,'2.jpg','Active','2024-12-19 09:45:15'),(3,'Driving License PDF',7.00,'3.jpg','Active','2024-12-19 09:48:00'),(4,'RC Pdf',10.00,'4.jpg','Active','2024-12-19 09:49:12'),(5,'Smart Card Pdf',7.00,'5.jpg','Active','2024-12-19 09:51:21'),(6,'Cell Number Link In Voter ID',25.00,'6.jpg','Inactive','2024-12-20 19:12:02'),(7,'Voter ID Pdf',25.00,'7.jpg','Inactive','2024-12-20 19:14:05');

/11-01-2025

alter table tnega_services add personalized varchar(100) DEFAULT NULL after can_details;
alter table tnega_services add relationship_1 varchar(50) DEFAULT NULL after personalized;
alter table tnega_services add relationship_2 varchar(50) DEFAULT NULL after relationship_1;
alter table tnega_services add relationship_3 varchar(50) DEFAULT NULL after relationship_2;
alter table tnega_services add dob varchar(10) DEFAULT NULL after relationship_3;
alter table tnega_services add religion varchar(50) DEFAULT NULL after dob;
alter table tnega_services add education varchar(100) DEFAULT NULL after religion;
alter table tnega_services add work varchar(50) DEFAULT NULL after education;
alter table tnega_services add door_no varchar(20) DEFAULT NULL after work;
alter table tnega_services add personalized_name_tamil varchar(100) DEFAULT NULL after door_no;
alter table tnega_services add relationship_name_tamil_1 varchar(100) DEFAULT NULL after personalized_name_tamil;
alter table tnega_services add relationship_name_tamil_2 varchar(100) DEFAULT NULL after relationship_name_tamil_1;
alter table tnega_services add relationship_name_tamil_3 varchar(100) DEFAULT NULL after relationship_name_tamil_2;
alter table tnega_services add community varchar(50) DEFAULT NULL after relationship_name_tamil_3;
alter table tnega_services add smartcard_number varchar(20) DEFAULT NULL after community;
alter table tnega_services add street_name_tamil varchar(100) DEFAULT NULL after smartcard_number;
alter table tnega_services add personalized_name_english varchar(100) DEFAULT NULL after postal_name;
alter table tnega_services add relationship_name_english_1 varchar(100) DEFAULT NULL after personalized_name_english;
alter table tnega_services add relationship_name_english_2 varchar(100) DEFAULT NULL; afterelationship_name_english_1;
alter table tnega_services add relationship_name_english_3 varchar(100) DEFAULT NULL afterelationship_name_english_2;
alter table tnega_services add maritial_status varchar(20) DEFAULT NULL; after relationship_name_english_3;
alter table tnega_services add caste varchar(50) DEFAULT NULL; after maritial_status;
alter table tnega_services add street_name varchar(100) DEFAULT NULL; after caste;
alter table tnega_services add pin_code varchar(20) DEFAULT NULL; after street_name;
alter table tnega_services add village_administrative_area varchar(50) DEFAULT NULL after pin_code;

alter table can_edit add relationship_1 varchar(50) DEFAULT NULL after relationship;
alter table can_edit add relationship_2 varchar(50) DEFAULT NULL after relationship_1;
alter table can_edit add relationship_3 varchar(50) DEFAULT NULL after relationship_2;
alter table can_edit add relationship_name_english_1 varchar(100) DEFAULT NULL after personalized;
alter table can_edit add relationship_name_english_2 varchar(100) DEFAULT NULL after relationship_name_english_1;
alter table can_edit add relationship_name_english_3 varchar(100) DEFAULT NULL after relationship_name_english_2;
alter table can_edit add relationship_name_tamil_1 varchar(100) DEFAULT NULL after relationship_name_english_3;
alter table can_edit add relationship_name_tamil_2 varchar(100) DEFAULT NULL after relationship_name_tamil_1;
alter table can_edit add relationship_name_tamil_3 varchar(100) DEFAULT NULL after relationship_name_tamil_2;

/20-01-2025

alter table services add sub_service_image varchar(30) after service_image;
alter table services add software varchar(50) after sub_service_image;

CREATE TABLE `software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `device_name` varchar(200) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table users add panchayath_name varchar(50) after panchayath_id;

//24-01-2025
alter table services add banner_image varchar(30) after service_image;
alter table services add banner varchar(50) after banner_image;


CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `organization_name` varchar(200) DEFAULT NULL,
  `content` varchar(200) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `model_image` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

//27-01-2025

ALTER TABLE `tailor` CHANGE `course_name` `course_name` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

alter table tec_exam add new_proof varchar(20) DEFAULT NULL after any_proof;
alter table tec_exam add any_document varchar(100) DEFAULT NULL after application_no;

alter table tec_exam add selects varchar(20) DEFAULT NULL after application_no;
alter table aadhaarcard add selects varchar(20) DEFAULT NULL after application_no;
alter table birth_certificate add selects varchar(20) DEFAULT NULL after application_no;
alter table bond add selects varchar(20) DEFAULT NULL after application_no;
alter table can_edit add selects varchar(20) DEFAULT NULL after application_no;
alter table covid add selects varchar(20) DEFAULT NULL after application_no;
alter table dharsan add selects varchar(20) DEFAULT NULL after application_no;
alter table fssai add selects varchar(20) DEFAULT NULL after application_no;
alter table gst add selects varchar(20) DEFAULT NULL after application_no;
alter table itr add selects varchar(20) DEFAULT NULL after application_no;
alter table license add selects varchar(20) DEFAULT NULL after application_no;
alter table msme add selects varchar(20) DEFAULT NULL after application_no;
alter table nalavariyam add selects varchar(20) DEFAULT NULL after application_no;
alter table pancard add selects varchar(20) DEFAULT NULL after application_no;
alter table pmkissan add selects varchar(20) DEFAULT NULL after application_no;
alter table smartcard add selects varchar(20) DEFAULT NULL after application_no;
alter table software add selects varchar(20) DEFAULT NULL after application_no;
alter table tailor add selects varchar(20) DEFAULT NULL after application_no;
alter table voterid add selects varchar(20) DEFAULT NULL after application_no;

//29-01-2025

CREATE TABLE `tnega_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` text DEFAULT '0',
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_back` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `old_can_document` varchar(20) DEFAULT NULL,
  `can_number` text DEFAULT NULL,
  `can_details` varchar(20) DEFAULT NULL,
  `job_type` varchar(20) DEFAULT NULL,
  `salary_slip` varchar(20) DEFAULT NULL,
  `pancard` varchar(20) DEFAULT NULL,
  `income_yearly` text DEFAULT NULL,
  `income_monthly` varchar(20) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `tc_community_certificate` varchar(20) DEFAULT NULL,
  `income_certificate` varchar(20) DEFAULT NULL,
  `community_certificate` varchar(20) DEFAULT NULL,
  `birth_certificate` varchar(20) DEFAULT NULL,
  `smartcard_online` varchar(20) DEFAULT NULL,
  `age_proof` varchar(30) DEFAULT NULL,
  `voterid` varchar(20) DEFAULT NULL,
  `driving_license` varchar(20) DEFAULT NULL,
  `marksheet` varchar(20) DEFAULT NULL,
  `mrg_invitation` varchar(20) DEFAULT NULL,
  `deed` varchar(20) DEFAULT NULL,
  `bank_pass_book` varchar(20) DEFAULT NULL,
  `personal_strap` varchar(20) DEFAULT NULL,
  `joint_strap` varchar(20) DEFAULT NULL,
  `deed_details` varchar(20) DEFAULT NULL,
  `deed_yes` varchar(20) DEFAULT NULL,
  `hus_wife_photo` varchar(20) DEFAULT NULL,
  `permanent_social_certificate_groom` varchar(20) DEFAULT NULL,
  `bride_permanent_social_certificate` varchar(20) DEFAULT NULL,
  `mrg_registration_certificate` varchar(20) DEFAULT NULL,
  `anyothers_certificate` varchar(20) DEFAULT NULL,
  `chitta` varchar(20) DEFAULT NULL,
  `aggregation` varchar(20) DEFAULT NULL,
  `ec_certificate` varchar(20) DEFAULT NULL,
  `villankam` varchar(20) DEFAULT NULL,
  `vao_certificate` varchar(20) DEFAULT NULL,
  `self_declaration_certificate` varchar(20) DEFAULT NULL,
  `other_certificate` varchar(20) DEFAULT NULL,
  `passport` text DEFAULT NULL,
  `placement_registration` varchar(20) DEFAULT NULL,
  `school_transfer_certificate` varchar(20) DEFAULT NULL,
  `study_proof` text DEFAULT NULL,
  `family_income_certificate` varchar(20) DEFAULT NULL,
  `husband_death_certificate` varchar(20) DEFAULT NULL,
  `legal_heir_certificate` varchar(20) DEFAULT NULL,
  `widow_certificate` varchar(20) DEFAULT NULL,
  `mrg_documents` varchar(20) DEFAULT NULL,
  `mrg_docdetails` text DEFAULT NULL,
  `any_proof` text DEFAULT NULL,
  `smartcard_no` varchar(15) DEFAULT NULL,
  `tailoring_certificate` varchar(20) DEFAULT NULL,
  `family_plannnig_certificate` varchar(20) DEFAULT NULL,
  `birth_certificate_children` varchar(20) DEFAULT NULL,
  `id_proof` varchar(20) DEFAULT NULL,
  `family_photo` text DEFAULT NULL,
  `handicapped_proof` varchar(20) DEFAULT NULL,
  `udid_card` varchar(20) DEFAULT NULL,
  `registered_deed` text DEFAULT NULL,
  `chitta_and_villangam` varchar(20) DEFAULT NULL,
  `property_details` varchar(20) DEFAULT NULL,
  `residential_certificate` varchar(20) DEFAULT NULL,
  `damage_certificate` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `application_no` text DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


alter table tnega_services add personalized text DEFAULT NULL after can_details;
alter table tnega_services add relationship_1 varchar(50) DEFAULT NULL after personalized;
alter table tnega_services add relationship_2 varchar(50) DEFAULT NULL after relationship_1;
alter table tnega_services add relationship_3 varchar(50) DEFAULT NULL after relationship_2;
alter table tnega_services add dob varchar(10) DEFAULT NULL after relationship_3;
alter table tnega_services add religion varchar(50) DEFAULT NULL after dob;
alter table tnega_services add education text DEFAULT NULL after religion;
alter table tnega_services add work text DEFAULT NULL after education;
alter table tnega_services add door_no varchar(20) DEFAULT NULL after work;
alter table tnega_services add personalized_name_tamil text DEFAULT NULL after door_no;
alter table tnega_services add relationship_name_tamil_1 text DEFAULT NULL after personalized_name_tamil;
alter table tnega_services add relationship_name_tamil_2 text DEFAULT NULL after relationship_name_tamil_1;
alter table tnega_services add relationship_name_tamil_3 text DEFAULT NULL after relationship_name_tamil_2;
alter table tnega_services add community text DEFAULT NULL after relationship_name_tamil_3;
alter table tnega_services add smartcard_number varchar(20) DEFAULT NULL after community;
alter table tnega_services add street_name_tamil text DEFAULT NULL after smartcard_number;
alter table tnega_services add postal_name text DEFAULT NULL after street_name_tamil;
alter table tnega_services add personalized_name_english text DEFAULT NULL after postal_name;
alter table tnega_services add relationship_name_english_1 text DEFAULT NULL after personalized_name_english;
alter table tnega_services add relationship_name_english_2 text DEFAULT NULL after relationship_name_english_1;
alter table tnega_services add relationship_name_english_3 text DEFAULT NULL after relationship_name_english_2;
alter table tnega_services add maritial_status varchar(20) DEFAULT NULL after relationship_name_english_3;
alter table tnega_services add caste text DEFAULT NULL after maritial_status;
alter table tnega_services add street_name text DEFAULT NULL after caste;
alter table tnega_services add pin_code text DEFAULT NULL after street_name;
alter table tnega_services add village_administrative_area text DEFAULT NULL after pin_code;


alter table tnega_services add selects varchar(20) DEFAULT NULL after application_no;
alter table medicalscheme add selects varchar(20) DEFAULT NULL after application_no;
alter table can_edit add vao_area varchar(50) DEFAULT NULL;

//31-01-2025

alter table banner add selects varchar(20) DEFAULT NULL after application_no;

alter table voterid add selects varchar(20) DEFAULT NULL after application_no;
alter table can_edit drop column postal_name;
alter table can_edit drop village_administrative_area;

alter table can_edit add postal_area_tamil text DEFAULT NULL after vao_area;
alter table can_edit add postal_area_english text DEFAULT NULL after postal_area_tamil;

alter table tec_exam add lects varchar(20) DEFAULT NULL after application_no;
alter table aadhaarcard add lects varchar(20) DEFAULT NULL after application_no;
alter table birth_certificate add lects varchar(20) DEFAULT NULL after application_no;
alter table bond add lects varchar(20) DEFAULT NULL after application_no;
alter table can_edit add lects varchar(20) DEFAULT NULL after application_no;
alter table covid add lects varchar(20) DEFAULT NULL after application_no;
alter table dharsan add lects varchar(20) DEFAULT NULL after application_no;
alter table fssai add lects varchar(20) DEFAULT NULL after application_no;
alter table gst add lects varchar(20) DEFAULT NULL after application_no;
alter table itr add lects varchar(20) DEFAULT NULL after application_no;
alter table license add lects varchar(20) DEFAULT NULL after application_no;
alter table msme add lects varchar(20) DEFAULT NULL after application_no;
alter table nalavariyam add lects varchar(20) DEFAULT NULL after application_no;
alter table pancard add lects varchar(20) DEFAULT NULL after application_no;
alter table pmkissan add lects varchar(20) DEFAULT NULL after application_no;
alter table smartcard add lects varchar(20) DEFAULT NULL after application_no;
alter table software add lects varchar(20) DEFAULT NULL after application_no;
alter table tailor add lects varchar(20) DEFAULT NULL after application_no;
alter table voterid add lects varchar(20) DEFAULT NULL after application_no;
alter table tnega_services add lects varchar(20) DEFAULT NULL after application_no;
alter table medicalscheme add lects varchar(20) DEFAULT NULL after application_no;
alter table banner add lects varchar(20) DEFAULT NULL after application_no;

alter table tec_exam add application varchar(20) DEFAULT NULL after application_no;
alter table aadhaarcard add application varchar(20) DEFAULT NULL after application_no;
alter table birth_certificate add application varchar(20) DEFAULT NULL after application_no;
alter table bond add application varchar(20) DEFAULT NULL after application_no;
alter table can_edit add application varchar(20) DEFAULT NULL after application_no;
alter table covid add application varchar(20) DEFAULT NULL after application_no;
alter table dharsan add application varchar(20) DEFAULT NULL after application_no;
alter table fssai add application varchar(20) DEFAULT NULL after application_no;
alter table gst add application varchar(20) DEFAULT NULL after application_no;
alter table itr add application varchar(20) DEFAULT NULL after application_no;
alter table license add application varchar(20) DEFAULT NULL after application_no;
alter table msme add application varchar(20) DEFAULT NULL after application_no;
alter table  nalavariyam add application varchar(50) DEFAULT NULL after acknowledgement;
alter table pancard add application varchar(20) DEFAULT NULL after application_no;
alter table pmkissan add application varchar(20) DEFAULT NULL after application_no;
alter table smartcard add application varchar(20) DEFAULT NULL after application_no;
alter table software add application varchar(20) DEFAULT NULL after application_no;
alter table tailor add application varchar(20) DEFAULT NULL after application_no;
alter table voterid add application varchar(20) DEFAULT NULL after application_no;
alter table tnega_services add application varchar(20) DEFAULT NULL after application_no;
alter table medicalscheme add application varchar(20) DEFAULT NULL after application_no;
alter table banner add application varchar(20) DEFAULT NULL after application_no;

//26-02-2025

alter table tnega_services add mother_name_tamil text DEFAULT NULL after relationship_name_tamil_1;
alter table tnega_services add mother_name_english text DEFAULT NULL after mother_name_tamil;
alter table family_member add relation_name_tamil text DEFAULT NULL after relation_name;
alter table family_member add service_id int(11) DEFAULT 0 after user_id;

alter table family_member add occupation text DEFAULT NULL after relation_name_tamil;
alter table tnega_services add affidavit text DEFAULT NULL after relationship;
alter table tnega_services add self_community_certificate text DEFAULT NULL after affidavit;
alter table tnega_services drop column postal_name;

alter table tnega_services add postal_area_tamil text DEFAULT NULL after street_name;
alter table tnega_services add postal_area_english text DEFAULT NULL after postal_area_tamil;
alter table family_member add education varchar(100) DEFAULT NULL;

alter table tnega_services modify application text;
alter table tec_exam modify application text;
alter table aadhaarcard modify application text;
alter table birth_certificate modify application text;
alter table bond modify application text;
alter table can_edit modify application text;
alter table covid modify application text;
alter table dharsan modify application text;
alter table fssai modify application text;
alter table gst modify application text;
alter table itr modify application text;
alter table license modify application text;
alter table msme modify application text;
alter table nalavariyam modify application text;
alter table pancard modify application text;
alter table pmkissan modify application text;
alter table smartcard modify application text;
alter table software modify application text;
alter table tailor modify application text;
alter table voterid modify application text;
alter table medicalscheme modify application text;
alter table banner modify application text;

alter table tnega_services add father_community text DEFAULT NULL after postal_area_tamil;
alter table tnega_services add father_caste text DEFAULT NULL after father_community;
alter table tnega_services add mother_community text DEFAULT NULL after father_caste;
alter table tnega_services add mother_Caste text DEFAULT NULL after mother_community;

CREATE TABLE `document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int DEFAULT 0,
  `doc_name` varchar(50) DEFAULT NULL,
  `doc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table family_member add doc varchar(20) DEFAULT NULL;
alter table tnega_services add living_status_1 text DEFAULT NULL;
alter table tnega_services add living_status_2 text DEFAULT NULL;
alter table tnega_services add signature1 text DEFAULT NULL;
alter table tnega_services add signature2 text DEFAULT NULL;

alter table tnega_services add area text DEFAULT NULL;
alter table tnega_services add application text DEFAULT NULL;
alter table tnega_services add strap text DEFAULT NULL;


alter table tnega_services add selects varchar(20) DEFAULT NULL after application_no;
alter table medicalscheme add selects varchar(20) DEFAULT NULL after application_no;

//27-02-2025

CREATE TABLE `agri_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int DEFAULT 0,
  `district` varchar(100) DEFAULT NULL,
  `taluk` varchar(100) DEFAULT NULL,
  `village` varchar(100) DEFAULT NULL,
  `patta_no` varchar(100) DEFAULT NULL,
  `field_no` varchar(100) DEFAULT NULL,
  `subdivision_no` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table agri_details add pattatype varchar(100) DEFAULT NULL;

//1-03-2025

alter table tnega_services add course_complete text DEFAULT NULL after affidavit;
alter table tnega_services add year_of_passing text DEFAULT NULL after course_complete;
alter table tnega_services add current_course text DEFAULT NULL after year_of_passing;
alter table tnega_services add current_academy_yr text DEFAULT NULL after current_course;
alter table tnega_services add institute_name_tamil text DEFAULT NULL after current_academy_yr;
alter table tnega_services add institute_name_english text DEFAULT NULL after institute_name_tamil;
alter table tnega_services add institute_address_tamil text DEFAULT NULL after institute_name_english;
alter table tnega_services add institute_address_english text DEFAULT NULL after institute_address_tamil;
alter table tnega_services drop column postal_name;

//6-03-2025

alter table family_member add education text DEFAULT NULL after relation_name;

//8-03-2025

alter table tnega_services drop column mother_Caste;
alter table tnega_services add mother_caste text DEFAULT NULL after mother_community;

//21-03-2025

CREATE TABLE `aadhaar_verify` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;


//03-04-2025

CREATE TABLE `patta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `can_no` varchar(15) DEFAULT NULL,
  `reg_office` varchar(50) DEFAULT NULL,
  `subdivision_no` varchar(30) DEFAULT NULL,
  `rev_village` varchar(50) DEFAULT NULL,
  `survey_no` varchar(30) DEFAULT NULL,
  `transacted_area` varchar(50) DEFAULT NULL,
  `bond_doc` varchar(50) DEFAULT NULL,
  `ec` varchar(50) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `application` varchar(50) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `utislpan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `date_of_birth` varchar(100) DEFAULT NULL,
  `father_name` varchar(20) DEFAULT NULL,
  `mode` varchar(20) DEFAULT NULL,
  `aadhaar_pdf` varchar(20) DEFAULT NULL,
  `pan_file` varchar(20) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `utislpanservice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `utislpanpayment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table utislpan add selects varchar(20) DEFAULT NULL after application_no;
alter table utislpan add lects varchar(20) DEFAULT NULL after application_no;
alter table utislpan add application varchar(20) DEFAULT NULL after application_no;

//07-04-2025
update services set ser_id = 6 where id in(200,201,202,203);
update services set ser_id = 6 where id in(204,205,206,207);

alter table patta add aadhaar_card varchar(20) DEFAULT NULL;
alter table patta add patta_no varchar(20) DEFAULT NULL;
alter table patta add mobile varchar(10) DEFAULT NULL;

update services set status = 'Active' where id in(200,201,202,203);
update services set status = 'Active' where id in(204,205,206,207);

update services set ser_id = 7 where id in(152,153,154);

update services set ser_id = 4 where id in(60,62,63,64,65,66,67,208,209,210,211);

18-04-2025

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notify` varchar(2000) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

update services set ser_id = 8 where id in(36,37,38,39,40,41,42,43);

//9-05-2025

alter table can_edit add applicant_name varchar(100) DEFAULT NULL after application_no;

//13-05-2025

CREATE TABLE `smartcard_otp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `application` varchar(50) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table smartcard add add_member varchar(50) DEFAULT NULL after aadhaar_card;
alter table smartcard add aadhaar_card2 varchar(20) DEFAULT NULL after add_member;
alter table smartcard add aadhaar_card3 varchar(20) DEFAULT NULL after aadhaar_card2;
alter table smartcard add aadhaar_card4 varchar(20) DEFAULT NULL after aadhaar_card3;
alter table smartcard add aadhaar_card5 varchar(20) DEFAULT NULL after aadhaar_card4;


//14-05-2025
alter table service_payment add admin_amount decimal(10,2) DEFAULT NULL after service_id;
alter table service_payment add coordinator_permission int(11) DEFAULT 0 after admin_amount;

//15-05-2025

CREATE TABLE `pstm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `name_tamil` varchar(100) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_name_tamil` varchar(100) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_name_tamil` varchar(100) DEFAULT NULL,
  `emis_id` varchar(30) DEFAULT NULL,
  `academic_yr_from` varchar(30) DEFAULT NULL,
  `class_to` varchar(20) DEFAULT NULL,
  `school_type` varchar(30) DEFAULT NULL,
  `academic_yr_to` varchar(30) DEFAULT NULL,
  `school_name` varchar(200) DEFAULT NULL,
  `class_from` varchar(20) DEFAULT NULL,
  `block` varchar(200) DEFAULT NULL,
  `tc` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `application` varchar(50) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table can_edit add certificate_number varchar(20) DEFAULT NULL after application_no;
alter table can_edit add certificate_name varchar(20) DEFAULT NULL after application_no;

alter table can_edit add document varchar(20) Default NULL;
alter table can_edit add save_application_number varchar(20) Default NULL;
alter table can_edit add save_certificate varchar(20) Default NULL;


alter table can_edit modify can_number varchar(30);
alter table can_edit modify certificate_name varchar(100) DEFAULT NULL;
alter table can_edit modify certificate_number varchar(100) DEFAULT NULL;

//21-05-2025
alter table can_edit add application_name varchar(100) Default NULL;
alter table can_edit add father_name text Default NULL;
alter table can_edit add father_name_english text Default NULL;
alter table can_edit add revenue_village text Default NULL;

//23-05-2025
alter table tailor add api_processing text DEFAULT NULL after certificate;
alter table tailor add api_approved text DEFAULT NULL after api_processing;

alter table can_edit add api_processing text DEFAULT NULL after certificate;
alter table can_edit add api_approved text DEFAULT NULL after api_processing;

//24-06-2025

alter table smartcard add add_member varchar(50) DEFAULT NULL after aadhaar_card;
alter table smartcard add aadhaar_card2 varchar(20) DEFAULT NULL after add_member;
alter table smartcard add aadhaar_card3 varchar(20) DEFAULT NULL after aadhaar_card2;
alter table smartcard add aadhaar_card4 varchar(20) DEFAULT NULL after aadhaar_card3;
alter table smartcard add aadhaar_card5 varchar(20) DEFAULT NULL after aadhaar_card4;
alter table smartcard add member varchar(50) DEFAULT NULL after aadhaar_card5;
alter table smartcard add aadhaar varchar(50) DEFAULT NULL after member;
alter table smartcard add aadhaar2 varchar(20) DEFAULT NULL after aadhaar;
alter table smartcard add aadhaar3 varchar(20) DEFAULT NULL after aadhaar2;
alter table smartcard add aadhaar4 varchar(20) DEFAULT NULL after aadhaar3;
alter table smartcard add aadhaar5 varchar(20) DEFAULT NULL after aadhaar4;
alter table smartcard add documents varchar(20) DEFAULT NULL after aadhaar5;
alter table smartcard add patta varchar(20) DEFAULT NULL after documents;
alter table smartcard add rental_agreement varchar(20) DEFAULT NULL after patta;
alter table smartcard add already_applied_application text DEFAULT NULL after rental_agreement;
alter table smartcard add family_head_aadhaar text DEFAULT NULL after already_applied_application;
alter table smartcard_otp add smart_card text DEFAULT NULL after family_head_aadhaar;

//25-06-2025
alter table tailor add api_processing text DEFAULT NULL after certificate;
alter table tailor add api_approved text DEFAULT NULL after api_processing;

alter table can_edit add api_processing text DEFAULT NULL after certificate;
alter table can_edit add api_approved text DEFAULT NULL after api_processing;

alter table itr add api_processing text DEFAULT NULL after certificate;
alter table itr add api_approved text DEFAULT NULL after api_processing;

alter table gst add api_processing text DEFAULT NULL after certificate;
alter table gst add api_approved text DEFAULT NULL after api_processing;

alter table tec_exam add api_processing text DEFAULT NULL after certificate;
alter table tec_exam add api_approved text DEFAULT NULL after api_processing;

alter table tnega_services add api_processing text DEFAULT NULL after certificate;
alter table tnega_services add api_approved text DEFAULT NULL after api_processing;

alter table smartcard add api_processing text DEFAULT NULL after certificate;
alter table smartcard add api_approved text DEFAULT NULL after api_processing;

alter table aadhaarcard add api_processing text DEFAULT NULL after certificate;
alter table aadhaarcard add api_approved text DEFAULT NULL after api_processing;

alter table bond add api_processing text DEFAULT NULL after certificate;
alter table bond add api_approved text DEFAULT NULL after api_processing;

alter table voterid add api_processing text DEFAULT NULL after certificate;
alter table voterid add api_approved text DEFAULT NULL after api_processing;

alter table fssai add api_processing text DEFAULT NULL after certificate;
alter table fssai add api_approved text DEFAULT NULL after api_processing;

alter table covid add api_processing text DEFAULT NULL after certificate;
alter table covid add api_approved text DEFAULT NULL after api_processing;

alter table nalavariyam add api_processing text DEFAULT NULL after certificate;
alter table nalavariyam add api_approved text DEFAULT NULL after api_processing;

alter table license add api_processing text DEFAULT NULL after certificate;
alter table license add api_approved text DEFAULT NULL after api_processing;

alter table pmkissan add api_processing text DEFAULT NULL after certificate;
alter table pmkissan add api_approved text DEFAULT NULL after api_processing;

alter table birth_certificate add api_processing text DEFAULT NULL after certificate;
alter table birth_certificate add api_approved text DEFAULT NULL after api_processing;

alter table medicalscheme add api_processing text DEFAULT NULL after certificate;
alter table medicalscheme add api_approved text DEFAULT NULL after api_processing;

alter table dharsan add api_processing text DEFAULT NULL after certificate;
alter table dharsan add api_approved text DEFAULT NULL after api_processing;

alter table software add api_processing text DEFAULT NULL after certificate;
alter table software add api_approved text DEFAULT NULL after api_processing;

alter table utislpan add api_processing text DEFAULT NULL after certificate;
alter table utislpan add api_approved text DEFAULT NULL after api_processing;

alter table patta add api_processing text DEFAULT NULL after certificate;
alter table patta add api_approved text DEFAULT NULL after api_processing;

alter table smartcard_otp add api_processing text DEFAULT NULL after certificate;
alter table smartcard_otp add api_approved text DEFAULT NULL after api_processing;

//26-6-2025

alter table msme add api_processing text DEFAULT NULL after certificate;
alter table msme add api_approved text DEFAULT NULL after api_processing;

alter table pancard add api_processing text DEFAULT NULL after certificate;
alter table pancard add api_approved text DEFAULT NULL after api_processing;

alter table banner add api_processing text DEFAULT NULL after certificate;
alter table banner add api_approved text DEFAULT NULL after api_processing;

alter table pstm add api_processing text DEFAULT NULL after certificate;
alter table pstm add api_approved text DEFAULT NULL after api_processing;

alter table smartcard add vao_area text DEFAULT NULL after already_applied_application;
alter table smartcard add door_no text DEFAULT NULL after vao_area;
alter table smartcard add street_name text DEFAULT NULL after door_no;
alter table smartcard add street_name_tamil text DEFAULT NULL after street_name;
alter table smartcard add postal_area_english text DEFAULT NULL after street_name_tamil;
alter table smartcard add postal_area_tamil text DEFAULT NULL after postal_area_english;

//27-06-2025
alter table can_edit add select_name varchar(50) DEFAULT NULL;
//9-07-2025

alter table fssai add documents varchar(20) Default NULL;
alter table fssai add rental_agreement varchar(20) Default NULL;
alter table fssai add electricity_bill varchar(20) Default NULL;
alter table fssai add property_tax varchar(20) Default NULL;
alter table fssai add food_service varchar(20) Default NULL;
alter table fssai add shop_photo varchar(20) Default NULL;

//11-07-2025

alter table medicalscheme add member varchar(20) DEFAULT NULL after application_no;
alter table medicalscheme add aadhaar varchar(20) DEFAULT NULL after member;
alter table medicalscheme add aadhaar2 varchar(20) DEFAULT NULL after aadhaar;
alter table medicalscheme add aadhaar3 varchar(20) DEFAULT NULL after aadhaar2;
alter table medicalscheme add aadhaar4 varchar(20) DEFAULT NULL after aadhaar3;
alter table medicalscheme add aadhaar5 varchar(20) DEFAULT NULL after aadhaar4;
alter table medicalscheme add aadhaar6 varchar(20) DEFAULT NULL after aadhaar5;

//16-07-2025

alter table smartcard add relationship text DEFAULT NULL;
alter table smartcard add dob text DEFAULT NULL;
alter table smartcard_otp add name varchar(100) DEFAULT NULL;
alter table smartcard_otp add documents varchar(50) DEFAULT NULL;
alter table smartcard_otp add name_tamil varchar(50) DEFAULT NULL;
alter table smartcard_otp add name_english varchar(50) DEFAULT NULL;

//18-07-2025

alter table fssai add food_service varchar(20) Default NULL;
alter table fssai add shop_photo varchar(20) Default NULL;
alter table fssai add mobile_no varchar(20) Default NULL;

23-07-2025

alter table services add api_id int(11) Default 0 after ser_id;

alter table users add verified int(11) Default NULL after refferal_id;

CREATE TABLE `nalavariyam_customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district` varchar(100) DEFAULT NULL,
  `taluk` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table nalavariyam_customer add aadhaar_no varchar(12) Default NULL;
alter table nalavariyam_customer add refferal int(11) Default NULL after aadhaar_no;
alter table nalavariyam_customer add customer_user_type_id int DEFAULT 0 after refferal;
alter table nalavariyam_customer add date varchar(10) DEFAULT NULL;
alter table nalavariyam_customer add customer_user_type_id int DEFAULT 0 after refferal;
alter table nalavariyam_customer add date varchar(10) DEFAULT NULL;

CREATE TABLE `nalavariyam_form` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT 0,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `user_type_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `customer_user_type_id` int(11) DEFAULT 0,
  `service_status` varchar(100) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `from_image` varchar(300) DEFAULT NULL,
  `log_id` int(11) DEFAULT 0,
  `online_status` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table nalavariyam_form add reason text DEFAULT NULL;
alter table nalavariyam_form add application_no varchar(50) DEFAULT NULL;
alter table nalavariyam_form add online_reason text DEFAULT NULL;
alter table nalavariyam_form add bill int(11) DEFAULT 0;

CREATE TABLE `nalavariyam_district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(100) DEFAULT NULL,
  `districtid` varchar(100) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `nalavariyam_district` VALUES (1,'அரியலூர்','01',20,'Active'),(2,'செங்கல்பட்டு','02',29,'Active'),(3,'சென்னை','03',24,'Active'),(4,'கோயம்புத்தூர் ','04',12,'Active'),(5,'கடலூர்','05',83,'Active'),(6,'தர்மபுரி','06',108,'Active'),(7,'திண்டுக்கல்','07',80,'Active'),(8,'ஈரோடு','08',45,'Active'),(9,'கள்ளக்குறிச்சி','09',25,'Active'),(10,'காஞ்சிபுரம்','10',32,'Active'),(11,'நாகர்கோவில்','11',4,'Active'),(12,'கரூர்','12',39,'Active'),(13,'கிருஷ்ணகிரி','13',27,'Active'),(14,'மதுரை','14',62,'Active'),(15,'மயிலாடுதுறை','15',1,'Active'),(16,'நாகப்பட்டினம்','16',41,'Active'),(17,'நாமக்கல்','17',110,'Active'),(18,'பெரம்பலூர்','18',78,'Active'),(19,'புதுக்கோட்டை','19',82,'Active'),(20,'ராமநாதபுரம்','20',35,'Active'),(21,'ராணிப்பேட்டை','21',33,'Active'),(22,'சேலம்','22',1521,'Active'),(23,'சிவகங்கை','23',36,'Active'),(24,'தென்காசி','24',42,'Active'),(25,'தஞ்சாவூர்','25',44,'Active'),(26,'நீலகிரி','26',85,'Active'),(27,'தேனி','27',5,'Active'),(28,'திருச்சிராப்பள்ளி','28',77,'Active'),(29,'திருவாரூர்','29',79,'Active'),(30,'தூத்துக்குடி','30',31,'Active'),(31,'திருநெல்வேலி','31',70,'Active'),(32,'திருப்பத்தூர்','32',2191,'Active'),(33,'திருப்பூர்','33',26,'Active'),(34,'திருவள்ளூர்','34',43,'Active'),(35,'திருவண்ணாமலை','35',34,'Active'),(36,'வேலூர்','36',65,'Active'),(37,'விழுப்புரம்','38',81,'Active'),(38,'விருதுநகர்','38',109,'Active'),(39,'பொன்னேரி','',NULL,'Active'),(40,'மார்த்தாண்டம்','',NULL,'Active'),(42,'விருத்தாசலம்',NULL,NULL,'Active');

alter table users add nalavariyam_usertype int(11) Default NULL after user_type_id;
alter table users add nalavariyam_dist_id int(11) Default NULL after panchayath_id;
alter table users add nalavariyam_taluk_id int(11) Default NULL after nalavariyam_dist_id;

CREATE TABLE `nalavariyam_service` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) DEFAULT NULL,
  `service_payment` varchar(10) DEFAULT NULL,
  `additional_url` varchar(50) DEFAULT NULL,
  `next_url` int DEFAULT NULL,
  `nexts` varchar(100) DEFAULT NULL,
  `from_image` varchar(500) DEFAULT NULL,
  `from_pdf` varchar(200) DEFAULT NULL,
  `download` varchar(5000) DEFAULT NULL,
  `upload` varchar(5000) DEFAULT NULL,
  `submitting_url` varchar(1000) DEFAULT NULL,
  `marge_right` varchar(10) DEFAULT NULL,
  `marge_bottom` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `servicetype` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23;

CREATE TABLE `service_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT 0,
  `service_type` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `nalavariyam_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  `admin_amount` decimal(10,2) DEFAULT 0,
  `time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table service_payment add admin_amount decimal(10,2) DEFAULT NULL after service_id;
alter table service_payment add coordinator_permission int(11) DEFAULT 0 after admin_amount;

CREATE TABLE `useractivation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT '0',
  `service_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  `admin_id` int DEFAULT '0',
  `distributor_amount` decimal(10,2) DEFAULT '0.00',
  `retailer_amount` decimal(10,2) DEFAULT '0.00',
  `admin_amount` decimal(10,2) DEFAULT '0.00',
  `superadmin_amount` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `nalavariyam_remarks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `remarks` text,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12;

INSERT INTO `nalavariyam_remarks` VALUES (1,'Crop and Resize (800*1100)','Active'),(2,'Fill All Columns','Active'),(3,'Use Blue Ink','Active'),(4,'Fill Academic Year(Example : 2025-2026)','Active'),(5,'Fill studying year (Example: 1st Year, 2nd Year ,3rd Year,4th Year)','Active'),(6,'Signature (Dont Cut & Paste)','Active'),(7,'Fill Date Of Birth ( Expect Adhaar)','Active'),(8,'Degree Name (Example BA, MBA,MA,BE, Diploma, ITI,....)','Active'),(9,'Fill Registration Number & Date','Active'),(10,'Fill Working Years','Active'),(11,'Fill Work Name As Per Labour Department work list Chart','Active');

//01-08-2025
alter table tnega_services add address_proof varchar(20) DEFAULT NULL;

//4-8-2025

CREATE TABLE `serverpayment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `website_index` varchar(50) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT 0,
  `activation_date` varchar(20) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `payment_proof` text DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table serverpayment add website_name text DEFAULT NULL;

alter table users add payment_date varchar(20) DEFAULT NULL;
alter table users add server_amount decimal(10,2) DEFAULT 0;
alter table users add payment_status int(11) DEFAULT 0;

//12-08-2025
alter table tnega_services add tc varchar(30) DEFAULT NULL after mother_form;

alter table aadhaarcard add door_no text DEFAULT NULL;
alter table aadhaarcard add street_name text DEFAULT NULL after door_no;
alter table aadhaarcard add postal_area_english text DEFAULT NULL after street_name;
alter table aadhaarcard add pin_code text DEFAULT NULL after postal_area_english;
alter table aadhaarcard add street_name_tamil text DEFAULT NULL after pin_code;
alter table aadhaarcard add postal_area_tamil text DEFAULT NULL after street_name_tamil;


CREATE TABLE `wallet_topup_api` (
  `id` int NOT NULL AUTO_INCREMENT,
  `row_id` int(11) DEFAULT NULL,
  `website_index` varchar(50) DEFAULT NULL,
  `website_name` varchar(100) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT 0,
  `date` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `payment_proof` text DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `website_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `website_name` varchar(100) DEFAULT NULL,
  `website_link` varchar(50) DEFAULT NULL,
  `index` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

//22-09-2025

CREATE TABLE `sitepayment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `website_id` int DEFAULT 0,
  `site_paymentid` varchar(50) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `payment_reason` text DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0,
  `payment_status` varchar(20) DEFAULT NULL,
  `paid_status` varchar(20) DEFAULT NULL,
  `payment_date` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `paid_image` text DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

21-09-2025

CREATE TABLE `gst_find` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `pan_no` varchar(10) DEFAULT NULL,
  `central_jurisdiction` varchar(20) DEFAULT NULL,
  `constitution` varchar(10) DEFAULT NULL,
  `gstin` varchar(10) DEFAULT NULL,
  `legal_name` varchar(30) DEFAULT NULL,
  `primary_address` varchar(200) DEFAULT NULL,
  `state_jurisdiction` varchar(100) DEFAULT NULL,
  `tax_payer_type` varchar(100) DEFAULT NULL,
  `trade_name` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `gst_status` varchar(20) DEFAULT NULL,
  `registration_date` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

//21-09-2025
alter table family_member add relation_income varchar(100) DEFAULT NULL;

//24-09-2025
alter table bond add sub_reg_office varchar(100) DEFAULT NULL;
alter table bond add mobile varchar(10) DEFAULT NULL;

CREATE TABLE `employment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `emp_reg_number` varchar(50) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

//27-09-2025

alter table services add ramjiservice_id int(11) DEFAULT 0 after parent_id;
alter table find_services add ramjiservice_id int(11) DEFAULT 0 after id;
alter table operator add ramjiservice_id int(11) DEFAULT 0;
alter table panservice add ramjiservice_id int(11) DEFAULT 0 after id;
alter table service_payment add ramjiservice_id int(11) DEFAULT 0 after parent_id;
alter table find_payment add ramjiservice_id int(11) DEFAULT 0 after service_id;
alter table recharge_payment add ramjiservice_id int(11) DEFAULT 0 after service_id;
alter table panpayment add ramjiservice_id int(11) DEFAULT 0 after service_id;

alter table users add nalavariyamwallet decimal(10,2) DEFAULT 0 after wallet;

CREATE TABLE `nalavariyampayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT 0,
  `to_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `newbalance` decimal(10,2) DEFAULT 0.00,
  `iscommission` tinyint(4) DEFAULT 0,
  `customer_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `service_status` varchar(20) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `ad_info` varchar(100) DEFAULT NULL,
  `ad_info2` varchar(100) DEFAULT NULL,
  `paid_image` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `paydate` varchar(50) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `k_status` int(11) DEFAULT 1,
  `service_entity` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `nalavariyam_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `req_date` date NOT NULL,
  `req_time` time NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

//01-10-2025
CREATE TABLE `police_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` text DEFAULT NULL,
  `father_name` text DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `emailid` varchar(50) DEFAULT NULL,
  `address_tamil` text DEFAULT NULL,
  `address_english` text DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `employment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `emp_reg_number` varchar(50) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table voterid add street_name_tamil text DEFAULT NULL;
alter table voterid add post_office_tamil text DEFAULT NULL;
alter table voterid add taluqa_mandal_tamil text DEFAULT NULL;
alter table voterid add town_village_tamil text DEFAULT NULL;

alter table voterid add correction varchar(30) DEFAULT NULL;
alter table voterid add gender varchar(20) DEFAULT NULL;
alter table voterid add dob varchar(10) DEFAULT NULL;
alter table voterid add age_proof varchar(20) DEFAULT NULL;
alter table voterid add relation varchar(20) DEFAULT NULL;
alter table voterid add document varchar(20) DEFAULT NULL;
alter table voterid add name_tamil varchar(100) DEFAULT NULL;
alter table voterid add name_english varchar(100) DEFAULT NULL;
alter table voterid add name_family_member varchar(500) DEFAULT NULL;
alter table voterid add aadhaar_no varchar(20) DEFAULT NULL;
alter table voterid add within_assembly varchar(50) DEFAULT NULL;
alter table voterid add street_name text DEFAULT NULL;
alter table voterid add post_office text DEFAULT NULL;
alter table voterid add apartment_no varchar(20) DEFAULT NULL;
alter table voterid add taluqa_mandal text DEFAULT NULL;
alter table voterid add town_village text DEFAULT NULL;
alter table voterid add name_assembly_constituency text DEFAULT NULL;
alter table voterid add disability varchar(50) DEFAULT NULL;
alter table voterid add locomotive_certificate varchar(20) DEFAULT NULL;
alter table voterid add visual_certificate varchar(20) DEFAULT NULL;
alter table voterid add dumb_certificate varchar(20) DEFAULT NULL;
alter table voterid add other_certificate varchar(20) DEFAULT NULL;
alter table voterid add description varchar(100) DEFAULT NULL;
alter table voterid add locomotive_percentage decimal(10,2) DEFAULT 0;
alter table voterid add visual_percentage decimal(10,2) DEFAULT 0;
alter table voterid add dumb_percentage decimal(10,2) DEFAULT 0;
alter table voterid add other_percentage decimal(10,2) DEFAULT 0;
alter table voterid add father_name_tamil text DEFAULT NULL;
alter table voterid add father_name_english text DEFAULT NULL;
alter table voterid add husband_name_tamil text DEFAULT NULL;
alter table voterid add husband_name_english text DEFAULT NULL;
alter table voterid add select_relationship varchar(30) DEFAULT NULL;
//14-10-2025
alter table service_payment add othersite_amount decimal(10,2) DEFAULT 0;
alter table find_payment add othersite_amount decimal(10,2) DEFAULT 0;
alter table panpayment add othersite_amount decimal(10,2) DEFAULT 0;

CREATE TABLE `service_payment_logs` (
       `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
       `parent_id` BIGINT UNSIGNED NOT NULL,
       `website` VARCHAR(255) NOT NULL,
       `status` ENUM('pending','success','failed') NOT NULL DEFAULT 'pending',
       `type` VARCHAR(50) NULL,
       `retries` INT NOT NULL DEFAULT 0,
       `response` LONGTEXT NULL,
       `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
       INDEX `idx_parent_id` (`parent_id`),
       INDEX `idx_website` (`website`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table service_payment_logs add ref varchar(50) DEFAULT NULL after type;

//25-11-2025
alter table nalavariyam_form add apiid int(11) DEFAULT 0 after id;
alter table nalavariyam_form add apistatus int(11) DEFAULT 0 after apiid;
alter table nalavariyam_form add website_index varchar(20) DEFAULT 0 after apistatus;
alter table nalavariyam_form add website_name varchar(100) DEFAULT 0 after website_index;

alter table website_data add agree_payment int(11) DEFAULT 0;

//26-11-2025

alter table patta add document_page varchar(20) DEFAULT NULL;
alter table patta add Palmistry_page varchar(20) DEFAULT NULL;
alter table patta add oldpatta_chitta varchar(20) DEFAULT NULL;
alter table patta add original_document varchar(20) DEFAULT NULL;
alter table patta add tabasil_property varchar(20) DEFAULT NULL;
alter table patta add anecdotal_evidence varchar(20) DEFAULT NULL;
alter table patta add heir_proof varchar(20) DEFAULT NULL;
alter table patta add mobile varchar(10) DEFAULT NULL;
alter table patta add aadhaar_card varchar(20) DEFAULT NULL;
alter table patta add patta_no varchar(20) DEFAULT NULL;

//27-11-2025

alter table aadhaarcard add tc varchar(20) DEFAULT NULL;
alter table aadhaarcard add marksheet varchar(20) DEFAULT NULL;
alter table aadhaarcard add relation_aadhaar varchar(20) DEFAULT NULL;
alter table aadhaarcard add community_certificate varchar(20) DEFAULT NULL; 
alter table aadhaarcard add proof varchar(50) DEFAULT NULL; 
alter table aadhaarcard add with_proof varchar(50) DEFAULT NULL;
alter table aadhaarcard add father_name_tamil text Default NULL;
alter table aadhaarcard add father_name_english text Default NULL;
alter table aadhaarcard add mother_name_tamil text Default NULL;
alter table aadhaarcard add mother_name_english text Default NULL;
alter table aadhaarcard add spouse_name_tamil text Default NULL;
alter table aadhaarcard add spouse_name_english text Default NULL;
alter table aadhaarcard add legal_gaurdian_name_tamil text Default NULL;
alter table aadhaarcard add legal_gaurdian_name_english text Default NULL;
alter table aadhaarcard add siblings_name_tamil text Default NULL;
alter table aadhaarcard add siblings_name_english text Default NULL;
alter table aadhaarcard add child_ward_name_tamil text Default NULL;
alter table aadhaarcard add child_ward_name_english text Default NULL;
alter table aadhaarcard add relationship1 varchar(20) Default NULL;




INSERT INTO customers SELECT * FROM users where user_type_id = 5;
//01-12-2025
CREATE TABLE `appointment_reg` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `is_completed` int(11) Default 0,
  `username` varchar(100) DEFAULT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `taluk` varchar(100) DEFAULT NULL,
  `village` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `station_name` varchar(100) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table users add is_completed int(11) Default NULL;
alter table appointment_reg add email varchar(50) default null;

//06-12-2025
CREATE TABLE `voteridpdf_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `name` text DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `epic_no` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

//16-12-2025

CREATE TABLE `spl_member` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `is_completed` int(11) Default 0,
  `username` varchar(100) DEFAULT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `taluk` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `door_no` varchar(20) DEFAULT NULL,
  `post_office_name` varchar(100) DEFAULT NULL,
  `father_hus_name` varchar(100) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `registration_no` varchar(20) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `splmemberactivationpayment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;
alter table spl_member add refferal_id varchar(10) DEFAULT NULL after user_id;


alter table spl_member add relation varchar(20) DEFAULT NULL after post_office_name;
alter table spl_member add customer_user_type_id int(11) DEFAULT 0 after id;
alter table spl_member add cardstatus varchar(20) DEFAULT NULL after remarks;

//19-12-2025
CREATE TABLE `agri_stack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `aadhaar_no` varchar(15) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table rc add engine varchar(15) Default NULL;

//12-01-2026

CREATE TABLE `smartcard_pdf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `smartcard_onlineprint` varchar(20) DEFAULT NULL,
  `smartcard_back_side` varchar(20) DEFAULT NULL,
  `smartcard_front_side` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table medicalscheme add aadhaar_card text DEFAULT null;
alter table medicalscheme add relation varchar(100) DEFAULT null;

alter table bond add revenue_village varchar(100) DEFAULT NULL;

//30-01-2026
alter table users add qrimage varchar(200) after profile;

alter table aadhaarcard add schl_id_card varchar(50) DEFAULT NULL after address_proof;
alter table aadhaarcard add bank_pass_book varchar(50) DEFAULT NULL after address_proof;
alter table aadhaarcard add voterid varchar(50) DEFAULT NULL after address_proof;
alter table aadhaarcard add id_proof varchar(50) DEFAULT NULL after address_proof;
alter table aadhaarcard add smartcard_onlineprint varchar(50) DEFAULT NULL after address_proof;
alter table aadhaarcard add relation_name_tamil varchar(100) DEFAULT NULL after address_proof;
alter table aadhaarcard add relation_name_english varchar(100) DEFAULT NULL after address_proof;

alter table fssai add documents varchar(20) Default NULL;
alter table fssai add rental_agreement varchar(20) Default NULL;
alter table fssai add electricity_bill varchar(20) Default NULL;
alter table fssai add property_tax varchar(20) Default NULL;
alter table fssai add food_service varchar(20) Default NULL;
alter table fssai add shop_photo varchar(20) Default NULL;
alter table fssai add mobile_no varchar(10) DEFAULT NULL;
alter table fssai add pan_no varchar(15) DEFAULT NULL;
alter table fssai add dob varchar(10) DEFAULT NULL;
alter table fssai add aadhaar_no varchar(15) DEFAULT NULL;
alter table fssai add name_as_pan text DEFAULT NULL;
alter table fssai add applicant_name text DEFAULT NULL;
alter table fssai add food_category text DEFAULT NULL;
alter table fssai add shop_address text DEFAULT NULL;
alter table fssai add block_or_division text DEFAULT NULL;
alter table fssai add pin_code varchar(10) DEFAULT NULL;
alter table fssai modify shop_name varchar(100);
alter table fssai add trade_retail text DEFAULT NULL;
alter table fssai add storage text DEFAULT NULL;
alter table fssai add wholesaler text DEFAULT NULL;
alter table fssai add distributor text DEFAULT NULL;
alter table fssai add transportation text DEFAULT NULL;
alter table fssai add retailer text DEFAULT NULL;
alter table fssai add direct_seller text DEFAULT NULL;
alter table fssai add food_vending_agencies text DEFAULT NULL;
alter table fssai add importer text DEFAULT NULL;
alter table fssai add trader_merchant text DEFAULT NULL;
alter table fssai add petty_retailer text DEFAULT NULL;
alter table fssai add central_govt_agencies text DEFAULT NULL;
alter table fssai add storage1 text DEFAULT NULL;
alter table fssai add wholesaler1 text DEFAULT NULL;
alter table fssai add distributor1 text DEFAULT NULL;
alter table fssai add retailer1 text DEFAULT NULL;
alter table fssai add hawker  text DEFAULT NULL;
alter table fssai add fssai_license text DEFAULT NULL;

alter table aadhaarcard add father_hus_aadhaar_no varchar(12) DEFAULT NULL;
alter table aadhaarcard add father_aadhaar_no varchar(12) DEFAULT NULL;
alter table aadhaarcard add father_hus_mobile varchar(10) DEFAULT NULL;
alter table aadhaarcard add father_mobile varchar(10) DEFAULT NULL;

CREATE TABLE `aadhaarfind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `name` text DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `find_number` varchar(30) DEFAULT NULL,
  `nalavariyam_reg_no` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table aadhaarfind add api_processing text DEFAULT NULL after certificate;
alter table aadhaarfind add api_approved text DEFAULT NULL after api_processing;

alter table smartcard_pdf add api_processing text DEFAULT NULL after certificate;
alter table smartcard_pdf add api_approved text DEFAULT NULL after api_processing;

alter table aadhaarcard drop column father_name_tamil;
alter table aadhaarcard drop column father_name_english;
alter table aadhaarcard drop column mother_name_tamil;
alter table aadhaarcard drop column mother_name_english;
alter table aadhaarcard drop column spouse_name_tamil;
alter table aadhaarcard drop column spouse_name_english;
alter table aadhaarcard drop legal_gaurdian_name_tamil;
alter table aadhaarcard drop legal_gaurdian_name_english;
alter table aadhaarcard drop siblings_name_tamil;
alter table aadhaarcard drop siblings_name_english;
alter table aadhaarcard drop child_ward_name_tamil;
alter table aadhaarcard drop child_ward_name_english;

alter table aadhaarcard add document_type varchar(30) DEFAULT NULL;
alter table aadhaarcard add applicant_document_type varchar(30) DEFAULT NULL;
alter table aadhaarcard add parent_mobile varchar(10) DEFAULT NULL;
alter table aadhaarcard add parent_aadhaar_front varchar(20) DEFAULT NULL;
alter table aadhaarcard add birth_certificate varchar(20) DEFAULT NULL;
alter table aadhaarcard add parent_aadhaar varchar(15) DEFAULT NULL;
alter table aadhaarcard add parent_name text DEFAULT NULL;

alter table aadhaarcard add parent_document_type varchar(30) DEFAULT NULL;
alter table aadhaarcard add relative_address_tamil text DEFAULT NULL;
alter table aadhaarcard add relative_address_english text DEFAULT NULL;

alter table aadhaarcard add relation_name text DEFAULT NULL;
alter table aadhaarcard add relation_aadhaar varchar(15) DEFAULT NULL;
alter table aadhaarcard add relation_mobile varchar(10) DEFAULT NULL;
alter table aadhaarcard add marital_status varchar(30) DEFAULT NULL;


//folder aadhaar
parent_aadhaar_front  

CREATE TABLE `agristack_instant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `aadhaar` varchar(20) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table smartcard add application_print varchar(20) DEFAULT NULL;
alter table smartcard add smartcard_number varchar(15) DEFAULT NULL;

CREATE TABLE meetinglist (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    meetingdate DATE NOT NULL,
    place VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    status ENUM('Active','Inactive') DEFAULT 'Inactive',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE meetingdetails (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    meetingid int(11) Default 0,
    user_id int(11) Default 0,
    name VARCHAR(255) Default NULL,
    username VARCHAR(255) Default NULL,
    nalavariyamverified VARCHAR(100) Default NULL,
    mobile VARCHAR(15) Default NULL,
    amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    paymentstatus ENUM('PENDING','SUCCESS','FAILED') DEFAULT 'PENDING',
    meetingpass VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE meetingpayment (
    id INT(11) NOT NULL AUTO_INCREMENT,
    order_id VARCHAR(50) DEFAULT NULL,
    transaction_id VARCHAR(100) DEFAULT NULL,
    user_id INT(11) NOT NULL,
    meeting_id INT(11) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    req_time VARCHAR(20) DEFAULT NULL,
    req_date VARCHAR(20) DEFAULT NULL,
    status VARCHAR(20) DEFAULT NULL,
    updated_at VARCHAR(30) DEFAULT NULL,
    PRIMARY KEY (id),
    INDEX idx_user_id (user_id),
    INDEX idx_order_id (order_id),
    INDEX idx_transaction_id (transaction_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE meetingdetails 
ADD COLUMN photo VARCHAR(255) NULL,
ADD UNIQUE KEY uniq_meeting_user (meetingid, user_id);

ALTER TABLE meetingdetails 
ADD attendance_status ENUM('IN','OUT') DEFAULT 'OUT';

alter table meetinglist add meetingbanner varchar(255) DEFAULT NULL;

12-03-2026

CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_type_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nalavariyam_usertype` int DEFAULT '0',
  `refferal_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `verified` int DEFAULT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aadhaar_no` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `aadhaar_file` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pan_no` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pan_file` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smartcard` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `signature` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dist_id` int DEFAULT NULL,
  `taluk_id` int DEFAULT NULL,
  `panchayath_id` int DEFAULT NULL,
  
  `nalavariyam_dist_id` int DEFAULT NULL,
  `nalavariyam_taluk_id` int DEFAULT NULL,
  `panchayath_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `can_details` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `can_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_birth` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cpassword` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qrimage` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wallet` decimal(10,2) DEFAULT '0.00',
  `nalavariyamwallet` decimal(10,2) DEFAULT '0.00',
  `rawallet` decimal(10,2) DEFAULT '0.00',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_date` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `server_amount` decimal(10,2) DEFAULT '0.00',
  `payment_status` int DEFAULT '0',
  `is_completed` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `wallet_topup_nalavariyam` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `website_index` varchar(50) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT 0,
  `date` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `payment_proof` text DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table aadhaarcard add apartment varchar(50) DEFAULT NULL;
alter table aadhaarcard add state_tamil text DEFAULT NULL;
alter table aadhaarcard add state text DEFAULT NULL;
alter table aadhaarcard add district text DEFAULT NULL;
alter table aadhaarcard add district_tamil text DEFAULT NULL;
alter table aadhaarcard add village text DEFAULT NULL;
alter table aadhaarcard add village_tamil text DEFAULT NULL;
alter table aadhaarcard add post_office text DEFAULT NULL;
alter table aadhaarcard add post_office_tamil text DEFAULT NULL;
alter table aadhaarcard add taluka text DEFAULT NULL;
alter table aadhaarcard add taluka_tamil text DEFAULT NULL;
alter table aadhaarcard add centerno text DEFAULT NULL;

CREATE TABLE `manual_pdf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `aadhaar_no` varchar(15) DEFAULT NULL,
  `dl_no` varchar(20) DEFAULT NULL,
  `rc_no` varchar(20) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table employment add address varchar(500) DEFAULT NULL;
alter table employment add father_name varchar(100) DEFAULT NULL;
alter table employment add dob varchar(10) DEFAULT NULL;
alter table employment add mobile varchar(10) DEFAULT NULL;
alter table employment add community varchar(50) DEFAULT NULL;
alter table employment add caste varchar(50) DEFAULT NULL;
alter table employment add email varchar(50) DEFAULT NULL;
alter table employment add password varchar(20) DEFAULT NULL;
alter table employment add marksheet varchar(20) DEFAULT NULL;

alter table meetingdetails add meeting_place varchar(70) DEFAULT NULL;
alter table meetingdetails add meeting_address varchar(200) DEFAULT NULL;
alter table meetingdetails add email varchar(100) DEFAULT NULL;

alter table manual_pdf add aadhaar_card varchar(20) DEFAULT NULL;

alter table employment add employment_card varchar(20) DEFAULT NULL;
alter table employment add name text DEFAULT NULL;

alter table employment add api_processing text DEFAULT NULL after certificate;
alter table employment add api_approved text DEFAULT NULL after api_processing;


alter table users add column member_id varchar(20) default NULL;
alter table nalavariyam_customer add column member_id varchar(20) default NULL;

alter table nalavariyam_customer add photo varchar(20) DEFAULT NULL;
alter table nalavariyam_customer add signature varchar(20) DEFAULT NULL;
alter table nalavariyam_customer add work_type varchar(200) DEFAULT NULL;
alter table nalavariyam_customer add dob varchar(10) DEFAULT NULL;

ALTER TABLE users
MODIFY COLUMN nalavariyam_dist_id TEXT NULL;

ALTER TABLE nalavariyam_form
MODIFY COLUMN dist_id TEXT NULL;

alter table aadhaarcard add relationship_tamil varchar(70) DEFAULT NULL;

ALTER TABLE nalavariyam_form
MODIFY COLUMN dist_id TEXT NULL;

CREATE TABLE `wallet_topup_nalavariyam` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `website_index` varchar(50) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT 0,
  `date` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `payment_proof` text DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table wallet_topup_nalavariyam add order_id varchar(50) DEFAULT NULL after id;
alter table wallet_topup_nalavariyam add transaction_id varchar(100) DEFAULT NULL after order_id;
alter table wallet_topup_nalavariyam add updated_at varchar(30) DEFAULT NULL after date;

//14-07-2026
CREATE TABLE `tnega_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `name` text DEFAULT NULL,
  `name_tamil` text DEFAULT NULL,
  `aadhaar_no` text DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `can_number` text DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `religion` text DEFAULT NULL,
  `mother_name_tamil` text DEFAULT NULL,
  `mother_name_english` text DEFAULT NULL,
  `father_name_tamil` text DEFAULT NULL,
  `father_name_english` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `district_name` text DEFAULT NULL,
  `panchayath_name` text DEFAULT NULL,
  `taluk_name` text DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `address_tamil` text DEFAULT NULL,
  `marital_status` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `nativity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `aadhaar_no` varchar(15) DEFAULT NULL,
  `nativity_type` varchar(100) DEFAULT NULL,
  `nativity_district` varchar(100) DEFAULT NULL,
  `nativity_taluk` varchar(100) DEFAULT NULL,
  `revenue_village` varchar(100) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `door_no` varchar(50) DEFAULT NULL,
  `pin_code` varchar(10) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `address_count` varchar(50) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `school_proof` varchar(20) DEFAULT NULL,
  `birth_photo` varchar(20) DEFAULT NULL,
  `resisdence_birth_certificate` varchar(20) DEFAULT NULL,
  `birth_aadhaar_card` varchar(20) DEFAULT NULL,
  `birth_certificate` varchar(20) DEFAULT NULL,
  `birth_signature` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `income` int(11) DEFAULT 0,
  `age` varchar(10) DEFAULT NULL,
  `family_count` varchar(10) DEFAULT NULL,
  `income_source` varchar(50) DEFAULT NULL,
  `profession` varchar(50) DEFAULT NULL,
  `relation` varchar(100) DEFAULT NULL,
  `name_english` varchar(100) DEFAULT NULL,
  `name_tamil` varchar(100) DEFAULT NULL,
  `tin_number` varchar(50) DEFAULT NULL,
  `sex` varchar(50) DEFAULT NULL,
  `owned_house` varchar(50) DEFAULT NULL,
  `land_hold` varchar(20) DEFAULT NULL,
  `salary_slip` varchar(20) DEFAULT NULL,
  `pancard` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `tnega_obc` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `service_id` int(11) DEFAULT 0,
       `user_id` int(11) DEFAULT 0,
       `retailer_id` int(11) DEFAULT 0,
       `distributor_id` int(11) DEFAULT 0,
       `admin_id` int(11) DEFAULT 0,
       `amount` decimal(10,2) DEFAULT 0.00,
       `name` text DEFAULT NULL,
       `serial_no` text DEFAULT NULL,
       `father_alive` text DEFAULT NULL,
       `father_occupation` text DEFAULT NULL,
       `father_status` text DEFAULT NULL,
       `father_pay_scale` text DEFAULT NULL,
       `father_designation` text DEFAULT NULL,
       `father_service` text DEFAULT NULL,
       `pay_scale` text DEFAULT NULL,
       `father_date_of_appointment` text DEFAULT NULL,
       `father_promotion_age` text DEFAULT NULL,
       `name_organization` text DEFAULT NULL,
       `service_fromdate` text DEFAULT NULL,
       `service_todate` text DEFAULT NULL,
       `father_death_date` text DEFAULT NULL,
       `father_incapacitation_details` text DEFAULT NULL,
       `father_psu_appointment_date` text DEFAULT NULL,
       `father_profession` text DEFAULT NULL,
       `father_irrigated_land` text DEFAULT NULL,
       `father_irrigated_percentage` text DEFAULT NULL,
       `father_holding_size` text DEFAULT NULL,
       `father_conversion_formula` text DEFAULT NULL,
       `father_crops_fruits` text DEFAULT NULL,
       `father_area_plantation` text DEFAULT NULL,
       `father_unirrigated_land` text DEFAULT NULL,
       `father_location` text DEFAULT NULL,
       `father_size_holding` text DEFAULT NULL,
       `father_property_use` text DEFAULT NULL,
       `father_property_details` text DEFAULT NULL,
       `father_annual_income` text DEFAULT NULL,
       `father_tax_payer` text DEFAULT NULL,
       `father_wealth_tax` text DEFAULT NULL,
       `father_wealth_tax_details` text DEFAULT NULL,
       `father_other_remarks` text DEFAULT NULL,
       `mother_alive` text DEFAULT NULL,
       `mother_occupation` text DEFAULT NULL,
       `mother_status` text DEFAULT NULL,
       `mother_pay_scale` text DEFAULT NULL,
       `mother_designation` text DEFAULT NULL,
       `mother_service` text DEFAULT NULL,
       `mother_gov_designation` text DEFAULT NULL,
       `mother_scale_of_pay` text DEFAULT NULL,
       `mother_date_of_appointment` text DEFAULT NULL,
       `mother_promotion_age` text DEFAULT NULL,
       `mother_name_organization` text DEFAULT NULL,
       `mother_servicefromdate` text DEFAULT NULL,
       `mother_servicetodate` text DEFAULT NULL,
       `mother_death_date` text DEFAULT NULL,
       `mother_incapacitation_details` text DEFAULT NULL,
       `mother_psu_organisation` text DEFAULT NULL,
       `mother_psu_appointment_date` text DEFAULT NULL,
       `mother_profession` text DEFAULT NULL,
       `mother_location` text DEFAULT NULL,
       `mother_irrigated_land` text DEFAULT NULL,
       `mother_irrigated_percentage` text DEFAULT NULL,
       `mother_holding_size` text DEFAULT NULL,
       `mother_conversion_formula` text DEFAULT NULL,
       `mother_crops_fruits` text DEFAULT NULL,
       `mother_area_plantation` text DEFAULT NULL,
       `mother_unirrigated_land` text DEFAULT NULL,
       `mother_property_use` text DEFAULT NULL,
       `mother_property_details` text DEFAULT NULL,
       `mother_annual_income` text DEFAULT NULL,
       `mother_tax_payer` text DEFAULT NULL,
       `mother_wealth_tax` text DEFAULT NULL,
       `mother_wealth_tax_details` text DEFAULT NULL,
       `mother_other_remarks` text DEFAULT NULL,
       `tnega_religion` text DEFAULT NULL,
       `acknowledgement` varchar(20) DEFAULT NULL,
       `application_no` varchar(100) DEFAULT NULL,
       `application` varchar(100) DEFAULT NULL,
       `api_processing` text DEFAULT NULL,
       `api_approved` text DEFAULT NULL,
       `lects` varchar(50) DEFAULT NULL,
       `selects` varchar(50) DEFAULT NULL,
       `certificate` varchar(20) DEFAULT NULL,
       `status` varchar(20) DEFAULT NULL,
       `remarks` varchar(100) DEFAULT NULL,
       `applied_date` varchar(10) DEFAULT NULL,
       `completed_date` varchar(10) DEFAULT NULL,
       `created_at` varchar(10) DEFAULT NULL,
      PRIMARY KEY (`id`)
     ) ENGINE=InnoDB;

ALTER TABLE nativity
MODIFY door_no TEXT,
MODIFY street_name TEXT,
MODIFY pin_code TEXT,
MODIFY revenue_village TEXT,
MODIFY nativity_taluk TEXT,
MODIFY nativity_district TEXT,
MODIFY from_date TEXT,
MODIFY to_date TEXT;

CREATE TABLE `tnega_residence` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `service_id` int(11) DEFAULT 0,
    `user_id` int(11) DEFAULT 0,
    `retailer_id` int(11) DEFAULT 0,
    `distributor_id` int(11) DEFAULT 0,
    `admin_id` int(11) DEFAULT 0,
    `amount` decimal(10,2) DEFAULT 0.00,
    `street_name` longtext DEFAULT NULL,
    `pin_code` longtext DEFAULT NULL,
    `door_no` longtext DEFAULT NULL,
    `revenue_village` longtext DEFAULT NULL,
    `nativity_taluk` longtext DEFAULT NULL,
    `nativity_district` longtext DEFAULT NULL,
    `from_date` longtext DEFAULT NULL,
    `to_date` longtext DEFAULT NULL,
    `address_count` varchar(50) DEFAULT NULL,
    `photo` varchar(20) DEFAULT NULL,
    `aadhaar_card` varchar(20) DEFAULT NULL,
    `signature` varchar(20) DEFAULT NULL,
    `school_proof` varchar(20) DEFAULT NULL,
    `birth_photo` varchar(20) DEFAULT NULL,
    `resisdence_birth_certificate` varchar(20) DEFAULT NULL,
    `birth_aadhaar_card` varchar(20) DEFAULT NULL,
    `birth_certificate` varchar(20) DEFAULT NULL,
    `birth_signature` varchar(20) DEFAULT NULL,
    `acknowledgement` varchar(20) DEFAULT NULL,
    `application_no` varchar(100) DEFAULT NULL,
    `application` varchar(100) DEFAULT NULL,
    `api_processing` text DEFAULT NULL,
    `api_approved` text DEFAULT NULL,
    `lects` varchar(50) DEFAULT NULL,
    `selects` varchar(50) DEFAULT NULL,
    `certificate` varchar(20) DEFAULT NULL,
    `status` varchar(20) DEFAULT NULL,
    `remarks` varchar(100) DEFAULT NULL,
    `applied_date` varchar(10) DEFAULT NULL,
    `completed_date` varchar(10) DEFAULT NULL,
    `created_at` varchar(10) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `tnega_unemployed` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `service_id` int(11) DEFAULT 0,
    `user_id` int(11) DEFAULT 0,
    `retailer_id` int(11) DEFAULT 0,
    `distributor_id` int(11) DEFAULT 0,
    `admin_id` int(11) DEFAULT 0,
    `dist_id` int(11) DEFAULT 0,
    `taluk_id` int(11) DEFAULT 0,
    `amount` decimal(10,2) DEFAULT 0.00,
    `graduation` longtext DEFAULT NULL,
    `school_college_name` longtext DEFAULT NULL,
    `year_of_birth` longtext DEFAULT NULL,
    `year_of_passing` longtext DEFAULT NULL,
    `qualification` longtext DEFAULT NULL,
    `board_university` longtext DEFAULT NULL,
    `from_date` longtext DEFAULT NULL,
    `to_date` longtext DEFAULT NULL,
    `photo` text DEFAULT NULL,
    `aadhaar_card` text DEFAULT NULL,
    `signature` text DEFAULT NULL,
    `study_proof` text DEFAULT NULL,
    `income_certificate` text DEFAULT NULL,
    `employment_card` text DEFAULT NULL,
    `applicant_tc` text DEFAULT NULL,
    `status` varchar(20) DEFAULT NULL,
    `remarks` text DEFAULT NULL,
    `application_no` text DEFAULT NULL,
    `selects` text DEFAULT NULL,
    `lects` text DEFAULT NULL,
    `application` text DEFAULT NULL,
    `certificate` text DEFAULT NULL,
    `api_processing` text DEFAULT NULL,
    `api_approved` text DEFAULT NULL,
    `acknowledgement` text DEFAULT NULL,
    `applied_date` varchar(10) DEFAULT NULL,
    `completed_date` varchar(10) DEFAULT NULL,
    `created_at` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table income add work_tamil varchar(200) DEFAULT NULL; 
alter table income add work_english varchar(200) DEFAULT NULL;
alter table family_member add family_work_tamil varchar(200) DEFAULT NULL; 
alter table family_member add family_work_english varchar(200) DEFAULT NULL;

alter table family_member add family_profession varchar(100) DEFAULT NULL;
alter table family_member add family_income varchar(100) DEFAULT NULL;
alter table family_member add family_income varchar(100) DEFAULT NULL;

alter table tnega_services add address text DEFAULT NULL;   
alter table tnega_services add father_name_tamil text DEFAULT NULL after address;   
alter table tnega_services add father_name_english text DEFAULT NULL after father_name_tamil;   
alter table tnega_services add name_tamil text DEFAULT NULL after father_name_english;   
alter table tnega_services add gender text DEFAULT NULL after name_tamil;   
alter table tnega_services add district_name text DEFAULT NULL after gender;   
alter table tnega_services add panchayath_name text DEFAULT NULL after district_name;   
alter table tnega_services add taluk_name text DEFAULT NULL after panchayath_name;   
alter table tnega_services add address_tamil text DEFAULT NULL after taluk_name;   
alter table tnega_services add marital_status text DEFAULT NULL after address_tamil;   
alter table tnega_services add requested_community text DEFAULT NULL after marital_status;   
alter table tnega_services add requeste_caste text DEFAULT NULL after requested_community;   
alter table aadhaarcard add relationship_tamil varchar(70) DEFAULT NULL;


ALTER TABLE tnega_customers DROP COLUMN retailer_id;
ALTER TABLE tnega_customers DROP COLUMN distributor_id;


ALTER TABLE `smartcard`
    ADD COLUMN `otp_send` TINYINT(1) NOT NULL DEFAULT 0 AFTER `mobile`,
    ADD COLUMN `otp_code` text NULL DEFAULT NULL AFTER `otp_send`,
    ADD COLUMN `otp_msg` TEXT NULL DEFAULT NULL AFTER `otp_code`;


alter table manual_pdf add smartcard_no varchar(20) DEFAULT NULL;

CREATE TABLE obc_castes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    serial_no INT NOT NULL,
    caste_name text NOT NULL
);

INSERT INTO obc_castes (serial_no, caste_name) VALUES
(41,'Gounder'),
(42,'Gowda (including Gammala, Kalali and Anuppa Gounder)'),
(43,'Hegde'),
(44,'Idiga'),
(45,'Illathu Pillaimar, Illuvar, Ezhuvar and Illathar'),
(46,'Inji Koravar (In Thanjavur, Tiruchirapalli and Pudukottai districts)'),
(47,'Isaivellalar'),
(48,'Jambuvankodai'),
(49,'Jangam'),
(50,'Jhetty'),
(51,'Jogi (including Jogis)'),
(52,'Kabbera'),
(53,'Kaikolan, Kaikolar, Sengunthar'),
(54,'Kaladi'),
(55,'Kala Koravar (In Thanjavur, Tiruchirapalli and Pudukottai districts)'),
(56,'Kalari Kurup including Kalari Panicker (In Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(57,'Kalingi'),
(58,'Kalinji Dabikoravar (In Thanjavur and Pudukottai districts)'),
(59,'Kallar (including Easanattu Kallar, Gandarvakkottai Kallar, Koottappal Kallar, Piramalai Kallar and Periasooriyur Kallar)'),
(60,'Kalveli Gounder'),
(61,'Kambar'),
(62,'Kammalar or Viswakarama, Viswakammala (including Thattar, Porkollar, Kannar, Karumar, Kollar, Thacher, Kalthacher, Kamsala and Viswabrahmin)'),
(63,'Kani, Kanisu, Kaniyar Panikkar'),
(64,'Kannada Saineegar, Kannadiyar (throughout the State) and Dasapalanjika (Coimbatore, Erode and Nilgiris districts)'),
(65,'Karuneegar (Seer Karuneegar, Sri Karuneegar, Sarattu Karuneegar, Kaikatti Karuneegar, Mathu Vazhi Kanakkar, Sozhi Kanakkar and Sunnambu Karuneegar)'),
(66,'Katesar, Pattamkatti'),
(67,'Kavuthiyar'),
(68,'Kepmari (in Chengalpattu, Pudukottai and Tiruchirapalli districts)'),
(69,'Kerala Mudali'),
(70,'Kharvi'),
(71,'Khatri'),
(72,'Kongu Chettiar (in Coimbatore and Periyar district only)'),
(73,'Kongu Vellalar (including Vellala Gounder, Nattu Gounder, Narambukkatti Gounder, Tirumudi Vellalar, Thondu Vellalar, Pala Gounder, Poosari Gounder, Anuppa Vellala Gounder, Kurumba Gounder, Padaithalai Gounder, Chendalai Gounder, Pavalankatti Vellala Gounder, Pala Vellala Gounder, Sanku Vellala Gounder and Rathinagiri Gounder)'),
(74,'Koppala Velama'),
(75,'Koracha'),
(76,'Koravar (in Chengalpattu, Ramanathapuram, Kamarajar, Pasumpon Muthuramalingam, Pudukottai, Thanjavur, Tiruchirappalli, Tirunelveli, Madras, Madurai and the Nilgiris districts)'),
(77,'Koteyar'),
(78,'Krishnanvaka (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(79,'Kudumbi (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(80,'Kulala (including Kuyavar, Kumbarar and Velar)'),
(81,'Kunchidigar'),
(82,'Kunnuvar Mannadi'),
(83,'Kurhini Chetty'),
(84,'Kurumba (where they are not Scheduled Tribe)'),
(85,'Labbai, Rowthar and Marakayar (whether their spoken language is Tamil or Urdu)'),
(86,'Lambadi'),
(87,'Latin Catholic (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(88,'Jangama'),
(89,'Mahratta (non-Brahmin) (including Namdev Mahratta)'),
(90,'Mahendra, Medara'),
(91,'Malayan, Malayar'),
(92,'Male'),
(93,'Maniagar'),
(94,'Mapilla'),
(95,'Maravar (including Karumaravar, Appanad Kondayamkottai Maravar and Sembanad Maravar)'),
(96,'Maruthuvar, Navithar, Mangala, Velakkattalavar, Velakkattalanair and Pronopakari'),
(97,'Meenavar, Parvatharajakulam, Pattanavar, Sembadavar (including converts to Christianity)'),
(98,'Monda Koravar'),
(99,'Mooppan'),
(100,'Moundadan Chetty'),
(101,'Mukkuvan, Mukkuvar or Mukayar (including converts to Christianity)'),
(102,'Muthuraja, Muthuracha, Muttiriyar, Muthiriyar, Mutharaiyar'),
(103,'Mutlakampatti'),
(104,'Nadar, Shanar and Gramani (including Christian Nadar, Christian Shanar and Christian Gramani)'),
(105,'Nagaram'),
(106,'Naikkar (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(107,'Nanjil Mudali (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(108,'Narikoravar'),
(109,'Nokkar'),
(110,'Odar (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(111,'Odiya'),
(112,'Ovachar'),
(113,'Pamulu'),
(114,'Panar (Except in Kanniyakumari district and Shencottah taluk of Tirunelveli district where the community is a Scheduled Caste)'),
(115,'Pannayar (including Kathikarar in Kanniyakumari district)'),
(116,'Pannirandam Chettiar or Uthama Chettiar'),
(117,'Paravar including converts to Christianity (except in Kanniyakumari district and Shencottah taluk of Tirunelveli district where the community is a Scheduled Caste)'),
(118,'Parkavakulam (Suruthimar including those Suruthimar who call themselves as Moopanar, Nathamar including those Nathamar who call themselves as Nainar, Malayamar)'),
(119,'Perike (including Perike Balija)'),
(120,'Perumkollar (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(121,'Ponnai Koravar (in North Arcot district)'),
(122,'Poraya'),
(123,'Pulluvar or Pooluvar, Pooluva Gounder'),
(124,'Pusala'),
(125,'Sadhu Chetty (including Telugu Chetty, Telugupatty Chetty, Twenty-four Manai Telugu Chetty)'),
(126,'Sakkaravar or Kavathi (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(127,'Sakkaraithamadai Koravar (in North Arcot district)'),
(128,'Salem Melnad Koravar (in Madurai, Coimbatore, Periyar, Pudukottai, Tiruchirappalli, Salem and North Arcot districts)'),
(129,'Salem Uppu Koravar (in Salem district)'),
(130,'Salivagana, Salivahana'),
(131,'Saliyar, Padmasaliyar, Pattusaliyar, Pattariyar and Adhaviyar'),
(132,'Saranga Palli Koravar'),
(133,'Sathatha Srivaishnava (including Sathanai, Chattadi and Chattada Srivaishnava)'),
(134,'Savalakkarar'),
(135,'Senaithalaivar, Senaikudiyar and Illaivaniar'),
(136,'Sourashtra (Patnulkarar)'),
(137,'Sozhia Chetty'),
(138,'Sozhia Vellalar (including Sozha Vellalar, Vetrilaikarar, Kodikalkarar and Keeraikarar)'),
(139,'Srisayar'),
(140,'Thalli Koravar (in Salem district)'),
(141,'Thogamalai Koravar or Kepmari (in Tiruchirappalli and Pudukottai districts)'),
(142,'Thogatta Veerakshatriya'),
(143,'Tholkollar (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(144,'Tholuva Naicker and Vetalakara Naicker'),
(145,'Thondaman'),
(146,'Thoriyar, Badaga Thoraiyar of Nilgiris'),
(147,'Thottiya Naicker (including Rajakambalam, Gollavar, Sillavar, Thockalavar and Tholuva Naicker)'),
(148,'Uppara, Uppillia and Sagara'),
(149,'Uppukoravar or Settipalli Koravar (in Thanjavur, Pudukottai, Madurai and North Arcot districts)'),
(150,'Urali Gounder (throughout the State) and Orudya Gounder or Oorudaya Gounder (in Madurai, Coimbatore, Periyar, Tiruchirapalli, Pudukottai and Salem districts)'),
(151,'Vaduvarpatti Koravar (in Madurai, Ramanathapuram, Pasumpon Muthuramalingam, Kamarajar, Tirunelveli, Tiruchirappalli and Pudukottai districts)'),
(152,'Valaiyar (including Chettinad Valaiyar)'),
(153,'Vallambar'),
(154,'Valmiki'),
(155,'Vaniyar, Vania Chettiar (including Gandla, Ganika, Telikula and Chekkalar)'),
(156,'Vannar (Salavai Thozhilalar) including Agasa, Madivala, Ekali, Rajakula, Veluthadar and Rajaka (except in Kanniyakumari district and Shencottah taluk of Tirunelveli district where the community is a Scheduled Caste)'),
(157,'Vanniyakula Kshatriya (including Vanniya, Vanniyar, Vannia Gounder, Gounder or Kander, Padayachi, Palli and Agnikula Kshatriya)'),
(158,'Varaganeri Koravar (in Tiruchirappalli and Pudukottai districts)'),
(159,'Vayalpad or Nawalpeta Koracha'),
(160,'Veduvar/Vettaikkarar (throughout the State) and Vedar (except in Kanniyakumari district and Shencottah taluk of Tirunelveli district where the community is a Scheduled Caste)'),
(161,'Veerasaiva (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(162,'Vellan Chettiar'),
(163,'Veluthodathu Nair (in Kanniyakumari district and Shencottah taluk of Tirunelveli district)'),
(164,'Vetta Koravar (in Salem district)'),
(165,'Vettuva Gounder, Punnan Vettuva Gounder'),
(165.1,'Virakodi Vellala (former Panisaivan only)'),
(166,'Vokkaligar (including Vakkaligar, Okkaligar, Kappiliyar, Kappiliya, Okkaliya, Gowda, Okkaliya Gowda, Okkaliga Gowda, Okkaliya Gowder)'),
(167,'Wynad Chetty (The Nilgiris district)'),
(168,'Yadava (including Idaiyar, Telugu speaking Idaiyar known as Vaduga Ayar or Vaduga Idaiyar or Golla, Mond Golla and Asthanthra Golla)'),
(169,'Yavana'),
(170,'Yerukula'),
(171,'Yogeeswarar'),
(172,'Christian converts from any Hindu Backward Classes'),
(173,'Battu Turkas'),
(174,'Devagudi Talayari'),
(175,'Podikara Vellalar'),
(176,'Pulavar'),
(177,'Nangudi Vellalar'),
(178,'Kuga Vellalar'),
(179,'Kallar Kula Thondaman'),
(180,'Thiyya');

alter table tnega_obc add caste text DEFAULT NULL after name; 
alter table tnega_obc add graduation text DEFAULT NULL after caste; 
alter table tnega_obc add dist_id int(11) DEFAULT 0 after admin_id; 
alter table tnega_obc add taluk_id int(11) DEFAULT 0 after dist_id; 
alter table tnega_obc add photo text DEFAULT NULL after tnega_religion; 
alter table tnega_obc add aadhaar_card text DEFAULT NULL after photo; 
alter table tnega_obc add community text DEFAULT NULL after aadhaar_card; 
alter table tnega_obc add signature text DEFAULT NULL after community; 
alter table tnega_obc add mother_income_proof text DEFAULT NULL after signature; 
alter table tnega_obc add mother_income_proof_file text DEFAULT NULL after mother_income_proof; 
alter table tnega_obc add father_income_proof_file text DEFAULT NULL after mother_income_proof_file; 
alter table tnega_obc add father_income_proof text DEFAULT NULL after father_income_proof_file; 


CREATE TABLE `tnega_unmarried` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `service_id` int(11) DEFAULT 0,
    `user_id` int(11) DEFAULT 0,
    `retailer_id` int(11) DEFAULT 0,
    `distributor_id` int(11) DEFAULT 0,
    `admin_id` int(11) DEFAULT 0,
    `dist_id` int(11) DEFAULT 0,
    `taluk_id` int(11) DEFAULT 0,
    `amount` decimal(10,2) DEFAULT 0.00,
    `document_type` text DEFAULT NULL,
    `photo` text DEFAULT NULL,
    `aadhaar_card` text DEFAULT NULL,
    `signature` text DEFAULT NULL,
    `licence` text DEFAULT NULL,
    `marksheet` text DEFAULT NULL,
    `voterid` text DEFAULT NULL,
    `birth_certificate` text DEFAULT NULL,
    `applicant_tc` text DEFAULT NULL,
    `marriage_invitation` text DEFAULT NULL,
    `status` varchar(20) DEFAULT NULL,
    `remarks` text DEFAULT NULL,
    `application_no` text DEFAULT NULL,
    `selects` text DEFAULT NULL,
    `lects` text DEFAULT NULL,
    `application` text DEFAULT NULL,
    `certificate` text DEFAULT NULL,
    `api_processing` text DEFAULT NULL,
    `api_approved` text DEFAULT NULL,
    `acknowledgement` text DEFAULT NULL,
    `applied_date` varchar(10) DEFAULT NULL,
    `completed_date` varchar(10) DEFAULT NULL,
    `created_at` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table smartcard add smartcard_number varchar(20) DEFAULT NULL; 
alter table smartcard_otp add smartcard_number varchar(20) DEFAULT NULL; 
alter table smartcard add petition_no varchar(20) DEFAULT NULL; 
alter table smartcard add aadhaar_no varchar(20) DEFAULT NULL; 
alter table smartcard add name_count int DEFAULT NULL;
alter table smartcard add member_name text DEFAULT NULL;
alter table smartcard add shop_number varchar(20) DEFAULT NULL;

alter table smartcard_otp add relationship varchar(20) DEFAULT NULL; 

CREATE TABLE `bulk_service_usage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT '0',
  `service_id` int DEFAULT '0',
  `total` int DEFAULT '0',
  `used` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE income
MODIFY created_at TIMESTAMP NULL;

ALTER TABLE family_member
MODIFY income INT NULL;

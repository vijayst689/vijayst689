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

alter table users add aadhaar_file varchar(10) DEFAULT NULL after aadhaar_no;
alter table users add pan_no varchar(10) DEFAULT NULL after aadhaar_file;
alter table users add pan_file varchar(10) DEFAULT NULL after pan_no;

28/10/2024

alter table services add service_image varchar(20) DEFAULT NULL after service_name;

alter table users add dist_id int(11) DEFAULT NULL after refferal_id;
alter table users add taluk_id int(11) DEFAULT NULL after dist_id;
alter table users add panchayath_id int(11) DEFAULT NULL after taluk_id;
alter table users add smartcard varchar(20) DEFAULT NULL after panchayath_id;
alter table users add signature varchar(20) DEFAULT NULL after smartcard;
alter table users add can_number varchar(20) DEFAULT NULL after signature;
alter table users add can_details varchar(20) DEFAULT NULL after can_number;

CREATE TABLE `tnega_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  `retailer_id` int DEFAULT '0',
  `distributor_id` int DEFAULT '0',
  `admin_id` int DEFAULT '0',
  `amount` decimal(10,2) DEFAULT '0.00',
  `name` varchar(50) DEFAULT '0',
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int DEFAULT '0',
  `taluk_id` int DEFAULT '0',
  `panchayath_id` int DEFAULT '0',
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_back` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `old_can_document` varchar(20) DEFAULT NULL,
  `can_number` varchar(20) DEFAULT NULL,
  `can_details` varchar(20) DEFAULT NULL,
  `job_type` varchar(20) DEFAULT NULL,
  `salary_slip` varchar(20) DEFAULT NULL,
  `pancard` varchar(20) DEFAULT NULL,
  `income_yearly` varchar(20) DEFAULT NULL,
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
  `passport` varchar(20) DEFAULT NULL,
  `placement_registration` varchar(20) DEFAULT NULL,
  `school_transfer_certificate` varchar(20) DEFAULT NULL,
  `study_proof` varchar(20) DEFAULT NULL,
  `family_income_certificate` varchar(20) DEFAULT NULL,
  `husband_death_certificate` varchar(20) DEFAULT NULL,
  `legal_heir_certificate` varchar(20) DEFAULT NULL,
  `widow_certificate` varchar(20) DEFAULT NULL,
  `mrg_documents` varchar(20) DEFAULT NULL,
  `mrg_docdetails` varchar(50) DEFAULT NULL,
  `any_proof` varchar(30) DEFAULT NULL,
  `smartcard_no` varchar(20) DEFAULT NULL,
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


CREATE TABLE `msme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  `retailer_id` int DEFAULT '0',
  `distributor_id` int DEFAULT '0',
  `admin_id` int DEFAULT '0',
  `amount` decimal(10,2) DEFAULT '0.00',
  `name` varchar(50) DEFAULT '0',
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int DEFAULT '0',
  `taluk_id` int DEFAULT '0',
  `panchayath_id` int DEFAULT '0',
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `cmp_name` varchar(100) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `building_name` varchar(100) DEFAULT NULL,
  `ward_no` varchar(50) DEFAULT NULL,
  `pin_code` varchar(20) DEFAULT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `confirm_account_no` varchar(50) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `micr_no` varchar(100) DEFAULT NULL,
  `male_count` varchar(100) DEFAULT NULL,
  `female_count` varchar(100) DEFAULT NULL,
  `amount_in_lakhs` varchar(100) DEFAULT NULL,
  `gst` varchar(50) DEFAULT NULL,
  `gst_number` varchar(20) DEFAULT NULL,
  `itr` varchar(100) DEFAULT NULL,
  `itr_form` varchar(100) DEFAULT NULL,
  `organization` varchar(100) DEFAULT NULL,
  `category_of_work` varchar(100) DEFAULT NULL,
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

CREATE TABLE `itr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  `retailer_id` int DEFAULT '0',
  `distributor_id` int DEFAULT '0',
  `admin_id` int DEFAULT '0',
  `amount` decimal(10,2) DEFAULT '0.00',
  `name` varchar(50) DEFAULT '0',
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int DEFAULT '0',
  `taluk_id` int DEFAULT '0',
  `panchayath_id` int DEFAULT '0',
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `bank_passbook` varchar(20) DEFAULT NULL,
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

alter table itr add email varchar(40) DEFAULT NULL after mobile;
alter table itr add aadhaar_no varchar(12) DEFAULT NULL after email;

CREATE TABLE `gst` (
`id` int NOT NULL AUTO_INCREMENT,
`service_id` int DEFAULT '0',
`user_id` int DEFAULT '0',
`retailer_id` int DEFAULT '0',
`distributor_id` int DEFAULT '0',
`admin_id` int DEFAULT '0',
`amount` decimal(10,2) DEFAULT '0.00',
`dist_id` int DEFAULT '0',
`taluk_id` int DEFAULT '0',
`panchayath_id` int DEFAULT '0',
`aadhaar_card` varchar(20) DEFAULT NULL,
`aadhaar_no` varchar(20) DEFAULT NULL,
`pan_card` varchar(20) DEFAULT NULL,
`pan_no` varchar(20) DEFAULT NULL,
`smart_card` varchar(20) DEFAULT NULL,
`photo` varchar(20) DEFAULT NULL,
`trade_name` varchar(50) DEFAULT NULL,
`business_details` varchar(50) DEFAULT NULL,
`business_details_documents` varchar(50) DEFAULT NULL,
`rental_agreement` varchar(20) DEFAULT NULL,
`ebbill` varchar(20) DEFAULT NULL,
`property_tax` varchar(20) DEFAULT NULL,
`bank_pass_book_front_page` varchar(20) DEFAULT NULL,
`business_address` varchar(200) DEFAULT NULL,
`mobile` varchar(20) DEFAULT NULL,
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

CREATE TABLE `tec_exam` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  `retailer_id` int DEFAULT '0',
  `distributor_id` int DEFAULT '0',
  `admin_id` int DEFAULT '0',
  `amount` decimal(10,2) DEFAULT '0.00',
  `tec_number` varchar(50) DEFAULT NULL,
  `tec_password` varchar(20) DEFAULT NULL,
  `applicant_name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `district` varchar(15) DEFAULT NULL,
  `father_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
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
  `address_tamil` varchar(50) DEFAULT NULL,
  `address_english` varchar(50) DEFAULT NULL,
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

 01/11/2024

alter table tnega_services add mrg_docdetails varchar(30) DEFAULT NULL after mrg_documents;
alter table tnega_services add any_proof varchar(30) DEFAULT NULL after mrg_docdetails;
alter table tnega_services add age_proof varchar(30) DEFAULT NULL after smartcard_online;

CREATE TABLE `aadhaarcard` (
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
  `photo` varchar(20) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `name_english` varchar(30) DEFAULT NULL,
  `name_tamil` varchar(30) DEFAULT NULL,
  `address_tamil` varchar(200) DEFAULT NULL,
  `address_english` varchar(200) DEFAULT NULL,
  `address_proof` varchar(200) DEFAULT NULL,
  `proof` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table aadhaarcard add pan_card_no varchar(15) after proof;
alter table aadhaarcard add aadhaar_entrolment_slip varchar(20) after pan_card_no;
alter table aadhaarcard add smart_link_no varchar(15) after aadhaar_entrolment_slip;
alter table aadhaarcard add documents varchar(30) after smart_link_no;

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
  `old_food_license` varchar(20) DEFAULT NULL,
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

CREATE TABLE `bond` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  `retailer_id` int DEFAULT '0',
  `distributor_id` int DEFAULT '0',
  `admin_id` int DEFAULT '0',
  `amount` decimal(10,2) DEFAULT '0.00',
  `name` varchar(30) DEFAULT NULL,
  `applicant_name` varchar(50) DEFAULT NULL,
  `document_number` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `dist_id` int DEFAULT '0',
  `taluk_id` int DEFAULT '0',
  `panchayath_id` int DEFAULT '0',
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `smartcard` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int DEFAULT '0',
  `user_id` int DEFAULT '0',
  `retailer_id` int DEFAULT '0',
  `distributor_id` int DEFAULT '0',
  `admin_id` int DEFAULT '0',
  `amount` decimal(10,2) DEFAULT '0.00',
  `name` varchar(50) DEFAULT '0',
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int DEFAULT '0',
  `taluk_id` int DEFAULT '0',
  `panchayath_id` int DEFAULT '0',
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `pin_code` varchar(20) DEFAULT NULL,
  `birth_certificate` varchar(20) DEFAULT NULL,
  `voter_id` varchar(20) DEFAULT NULL,
  `death_certificate` varchar(20) DEFAULT NULL,
  `mrg_certificate` varchar(20) DEFAULT NULL,
  `mrg_invitation` varchar(20) DEFAULT NULL,
  `passport` varchar(20) DEFAULT NULL,
  `bank_passbook` varchar(50) DEFAULT NULL,
  `family_head_name` varchar(50) DEFAULT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `electricity_bill_receipt` varchar(20) DEFAULT NULL,
  `telephone_charges` varchar(20) DEFAULT NULL,
  `gas_cylinder_receipt` varchar(20) DEFAULT NULL,
  `property_tax_applicant_owns_house` varchar(20) DEFAULT NULL,
  `lease_deed` varchar(20) DEFAULT NULL,
  `allotment_rder_of_slum_replacement_board` varchar(20) DEFAULT NULL,
  `bond_leave_proof` varchar(20) DEFAULT NULL,
  `first_page_of_bank_account_book` varchar(20) DEFAULT NULL,
  `name_tamil` varchar(20) DEFAULT NULL,
  `father_or_husband_tamil` varchar(50) DEFAULT NULL,
  `name_english` varchar(20) DEFAULT NULL,
  `father_or_husband_english` varchar(50) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `monthly_income` varchar(20) DEFAULT NULL,
  `family_head_photo` varchar(50) DEFAULT NULL,
  `address_tamil_1` varchar(50) DEFAULT NULL,
  `address_tamil_2` varchar(50) DEFAULT NULL,
  `address_tamil_3` varchar(50) DEFAULT NULL,
  `address_english_1` varchar(50) DEFAULT NULL,
  `address_english_2` varchar(50) DEFAULT NULL,
  `address_english_3` varchar(50) DEFAULT NULL,
  `gas_connection_no` varchar(50) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `commodity_card` varchar(20) DEFAULT NULL,
  `rice_card` varchar(20) DEFAULT NULL,
  `sugar_card` varchar(20) DEFAULT NULL,
  `any_proof` varchar(40) DEFAULT NULL,
  `new_proof` varchar(40) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `applicant_reciept` varchar(20) DEFAULT NULL,
  `smart_mobile` varchar(10) DEFAULT NULL,
  `change_cardtype` varchar(20) DEFAULT NULL,
  `smartcard_online` varchar(20) DEFAULT NULL,
  `others` varchar(20) DEFAULT NULL,
  `any_document` varchar(100) DEFAULT NULL,
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


CREATE TABLE `service_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table users modify wallet decimal(10,2) DEFAULT 0;
alter table users add smartcard_no varchar(15) DEFAULT NULL after smartcard;

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

CREATE TABLE `passport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `application_type` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `no_of_pages` varchar(20) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `father_name` varchar(30) DEFAULT NULL,
  `mother_name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `validity` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `place_of_birth` varchar(30) DEFAULT NULL,
  `district_of_birth` varchar(30) DEFAULT NULL,
  `state_of_birth` varchar(30) DEFAULT NULL,
  `qualification` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email_id` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `age_id_proof` varchar(50) DEFAULT NULL,
  `employee_type` varchar(50) DEFAULT NULL,
  `area_police_station_name` varchar(30) DEFAULT NULL,
  `address_proof` varchar(500) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `school_tc` varchar(20) DEFAULT NULL,
  `marksheet` varchar(20) DEFAULT NULL,
  `birth_certificate` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `voter_id` varchar(20) DEFAULT NULL,
  `driving_licence` varchar(20) DEFAULT NULL,
  `lic_policy_bond` varchar(20) DEFAULT NULL,
  `service_record_extract` varchar(20) DEFAULT NULL,
  `bank_statement` varchar(20) DEFAULT NULL,
  `old_passport_copy` varchar(20) DEFAULT NULL,
  `electric` varchar(20) DEFAULT NULL,
  `gas_connection_proof` varchar(20) DEFAULT NULL,
  `rent_agreement` varchar(20) DEFAULT NULL,
  `certificate_from_employer` varchar(20) DEFAULT NULL,
  `parent_passport` varchar(20) DEFAULT NULL,
  `income_tax_assesssment` varchar(20) DEFAULT NULL,
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

//23-11-24
alter table family_member add income int(11) DEFAULT 0 after relation_status;
alter table family_member add profession varchar(20) DEFAULT NULL after income;

26-11-2024

alter table users add rawallet decimal(10,2) DEFAULT 0 after wallet;
alter table payment add newbalance decimal(10,2) DEFAULT 0 after amount;

alter table services add ser_id int(11) DEFAULT 0 after parent_id;

alter table family_member add income int(11) DEFAULT 0 after relation_status;
alter table family_member add profession varchar(20) DEFAULT NULL after income;

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

//29-11-24

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


alter table tnega_services add family_plannnig_certificate varchar(20) DEFAULT NULL after tailoring_certificate;
alter table tnega_services add birth_certificate_children varchar(20) DEFAULT NULL after family_plannnig_certificate;
alter table tnega_services add id_proof varchar(20) DEFAULT NULL after birth_certificate_children;
alter table tnega_services add family_photo varchar(20) DEFAULT NULL after id_proof;
alter table tnega_services add handicapped_proof varchar(20) DEFAULT NULL after family_photo;
alter table tnega_services add udid_card varchar(20) DEFAULT NULL after handicapped_proof;
alter table tnega_services add registered_deed varchar(20) DEFAULT NULL after udid_card;
alter table tnega_services add chitta_and_villangam varchar(20) DEFAULT NULL after registered_deed;
alter table tnega_services add property_details varchar(20) DEFAULT NULL after chitta_and_villangam;
alter table tnega_services add residential_certificate varchar(20) DEFAULT NULL after property_details;
alter table tnega_services add damage_certificate varchar(20) DEFAULT NULL after residential_certificate;


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


alter table pancard add last_name varchar(40) DEFAULT NULL after name;
alter table pancard add email varchar(60) DEFAULT NULL after mobile;
alter table pancard add title varchar(30) DEFAULT NULL after email;
alter table pancard add mode varchar(30) DEFAULT NULL after title;
alter table pancard add gender varchar(20) DEFAULT NULL after mode;
alter table pancard add api_status varchar(30) DEFAULT NULL after status;
alter table pancard add api_url varchar(700) DEFAULT NULL after api_status;
alter table pancard add api_txid varchar(30) DEFAULT NULL after api_url;

alter table pancard add pancard_type varchar(20) DEFAULT NULL after pan_card;
alter table pancard add relative_name varchar(20) DEFAULT NULL after pancard_type;
alter table pancard add email_id varchar(40) DEFAULT NULL after relative_name;
alter table pancard add signature varchar(40) DEFAULT NULL after relative_name;
alter table pancard add relationship varchar(20) DEFAULT NULL after signature;


CREATE TABLE `service_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT 0,
  `service_type` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

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


CREATE TABLE `find_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0,
  `ser_image` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

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

CREATE TABLE `find_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table pancard_find add amount decimal(10,2) after service_id;

alter table dl add service_id int(11) after user_id;
alter table rc add service_id int(11) after user_id;
alter table ration add service_id int(11) after user_id;

alter table dl add amount decimal(10,2) after service_id;
alter table rc add amount decimal(10,2) after service_id;
alter table ration add amount decimal(10,2) after service_id;

CREATE TABLE `utility_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT 0.00,
  `admin_commission` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

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

CREATE TABLE `utility_services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT 0.00,
  `retailer_commission` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `operator` VALUES (1,'A','Mobile Prepaid','Airtel',2.00,2.00),(2,'BT','Mobile Prepaid','BSNL TOP UP',5.20,4.00),(3,'RC','Mobile Prepaid','JIO',1.30,1.00),(4,'V','Mobile Prepaid','Vodafone',3.50,3.50),(5,'ATV','DTH','Airtel Digital TV',4.20,3.50),(6,'DTV','DTH','Dish TV',4.40,3.40),(7,'STV','DTH','Sun Direct',3.25,3.00),(8,'TTV','DTH','Tata Sky',3.20,2.80),(9,'VTV','DTH','Videocon DTH',4.20,3.50),(10,'BR','Mobile Prepaid','BSNL STV',5.20,4.00),(11,'I','Mobile Prepaid','IDEA',3.50,3.50),(12,'FDF','Fastag','Federal Bank - Fastag',0.10,0.00),(13,'HDF','Fastag','Hdfc Bank - Fastag',0.10,0.00),(14,'ICF','Fastag','Icici Bank Fastag',0.10,0.00),(15,'IBF','Fastag','Idbi Bank Fastag',0.10,0.00),(16,'IFF','Fastag','Idfc First Bank- Fastag',0.10,0.00),(17,'PTF',NULL,'Paytm Payments Bank Fastag',0.10,0.10),(18,'AXF',NULL,'Axis Bank Fastag',0.10,0.10);

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

CREATE TABLE `recharge_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

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

//04-12-24

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


alter table tailor modify photo varchar(200);
alter table tailor modify course_name varchar(100);

alter table tailor add entity varchar(50) DEFAULT NULL;

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

28-12-2024

CREATE TABLE `courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `coursepayment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parent_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0,
  `retailer_amount` decimal(10,2) DEFAULT 0,
  `customer_amount` decimal(10,2) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `panservice` VALUES (1,'New Card','1.jpg',98.00,'Active','2024-12-27 12:44:39'),(2,'Correction Pan Card','2.png',98.00,'Active','2024-12-27 12:45:25');

alter table pancard add api_status varchar(30) DEFAULT Null after status;
alter table pancard add api_url varchar(700) DEFAULT Null after api_status;
alter table pancard add api_txid varchar(30) DEFAULT Null after api_url;

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

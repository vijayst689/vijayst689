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

20-01-2025

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

//04-02-2025

alter table users add panchayath_name varchar(50) after panchayath_id;

CREATE TABLE `tnega_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` text DEFAULT NULL,
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


alter table bond add certificate varchar(20) DEFAULT NULL after status;


//18-02-2025
alter table bond add certificate varchar(20) DEFAULT NULL after status;

alter table can_edit add vao_area text DEFAULT NULL after vao_area;
alter table can_edit drop column postal_name;
alter table can_edit drop village_administrative_area;
alter table can_edit add postal_area_tamil text DEFAULT NULL after vao_area;
alter table can_edit add postal_area_english text DEFAULT NULL after postal_area_tamil;

alter table tnega_services add postal_area_tamil text DEFAULT NULL after pin_code;
alter table tnega_services add postal_area_english text DEFAULT NULL after postal_area_tamil;
alter table tnega_services add family_relationship text DEFAULT NULL after postal_area_english;
alter table tnega_services add relation_name text DEFAULT NULL after family_relationship;
alter table tnega_services add relation_name_tamil text DEFAULT NULL after relation_name;
alter table tnega_services add relation_age text DEFAULT NULL after relation_name_tamil;
alter table tnega_services drop column relation_age;
alter table tnega_services drop column family_relationship;
alter table tnega_services drop column relation_name_tamil;
alter table tnega_services drop column relation_name;
alter table tnega_services add mother_name_tamil text DEFAULT NULL after relationship_name_tamil_1;
alter table tnega_services add mother_name_english text DEFAULT NULL after mother_name_tamil;
alter table family_member add relation_name_tamil text DEFAULT NULL after relation_name;
alter table family_member add service_id int(11) DEFAULT 0 after user_id;

alter table family_member add occupation text DEFAULT NULL after relation_name_tamil;
alter table tnega_services add affidavit text DEFAULT NULL after relationship;
alter table tnega_services add self_community_certificate text DEFAULT NULL after affidavit;
alter table tnega_services add course_complete text DEFAULT NULL after affidavit;
alter table tnega_services add year_of_passing text DEFAULT NULL after course_complete;
alter table tnega_services add current_course text DEFAULT NULL after year_of_passing;
alter table tnega_services add current_academy_yr text DEFAULT NULL after current_course;
alter table tnega_services add institute_name_tamil text DEFAULT NULL after current_academy_yr;
alter table tnega_services add institute_name_english text DEFAULT NULL after institute_name_tamil;
alter table tnega_services add institute_address_tamil text DEFAULT NULL after institute_name_english;
alter table tnega_services add institute_address_english text DEFAULT NULL after institute_address_tamil;
alter table tnega_services drop column postal_name;


CREATE TABLE `pan_aadhaar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `pan_no` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(700) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;


alter table family_member add education varchar(100) DEFAULT NULL;
alter table family_member add doc varchar(20) DEFAULT NULL;
alter table tnega_services add living_status_1 text DEFAULT NULL;
alter table tnega_services add living_status_2 text DEFAULT NULL;
alter table tnega_services add signature1 text DEFAULT NULL;
alter table tnega_services add signature2 text DEFAULT NULL;

alter table tnega_services add mother_community text DEFAULT NULL;
alter table tnega_services add father_community text DEFAULT NULL;
alter table tnega_services add father_caste text DEFAULT NULL;
alter table tnega_services add mother_caste text DEFAULT NULL;


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
alter table nalavariyam add application varchar(50) DEFAULT NULL after acknowledgement;
alter table pancard add application varchar(20) DEFAULT NULL after application_no;
alter table pmkissan add application varchar(20) DEFAULT NULL after application_no;
alter table smartcard add application varchar(20) DEFAULT NULL after application_no;
alter table software add application varchar(20) DEFAULT NULL after application_no;
alter table tailor add application varchar(20) DEFAULT NULL after application_no;
alter table voterid add application varchar(20) DEFAULT NULL after application_no;
alter table tnega_services add application varchar(20) DEFAULT NULL after application_no;
alter table medicalscheme add application varchar(20) DEFAULT NULL after application_no;


alter table tnega_services add father_community text DEFAULT NULL after postal_area_tamil;
alter table tnega_services add father_caste text DEFAULT NULL after father_community;
alter table tnega_services add mother_community text DEFAULT NULL after father_caste;
alter table tnega_services add mother_caste text DEFAULT NULL after mother_community;

//25-02-2025
alter table tnega_services add area text DEFAULT NULL;
alter table tnega_services add application text DEFAULT NULL;
alter table tnega_services add strap text DEFAULT NULL;

CREATE TABLE `document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_id` int DEFAULT 0,
  `doc_name` varchar(50) DEFAULT NULL,
  `doc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

CREATE TABLE `enquiry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `requirement` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

//27-02-2025
alter table enquiry add user_name text DEFAULT NULL after requirement;


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

/14-03-2025
alter table pancard add opid text Default NULL;

//22-03-2025

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

//9-05-2025

alter table can_edit add applicant_name varchar(100) DEFAULT NULL after application_no;

//12-05-2025

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

alter table smartcard modify smart_card varchar(100) DEFAULT NULL;

//27-05-2025
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

alter table service_payment add coordinator_permission int(11) DEFAULT 0 after admin_amount;

alter table can_edit add certificate_number varchar(20) DEFAULT NULL after application_no;
alter table can_edit add certificate_name varchar(20) DEFAULT NULL after application_no;

alter table can_edit add document varchar(20) Default NULL;
alter table can_edit add save_application_number varchar(20) Default NULL;
alter table can_edit add save_certificate varchar(20) Default NULL;

alter table can_edit modify can_number varchar(30);
alter table can_edit modify certificate_number varchar(50);
alter table can_edit add applicant_name varchar(100) DEFAULT NULL after application_no;

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

alter table can_edit add api_response varchar(20) DEFAULT NULL;

//05-06-2025
alter table can_edit add application_name varchar(100) Default NULL;
alter table can_edit add certificate_number varchar(100) DEFAULT NULL;
alter table can_edit add certificate_name varchar(100) DEFAULT NULL;
alter table can_edit add document varchar(20) Default NULL;
alter table can_edit add save_application_number varchar(20) Default NULL;
alter table can_edit add save_certificate varchar(20) Default NULL;

//11-06-2025

CREATE TABLE smartcard_otp (
  id int(11) NOT NULL AUTO_INCREMENT,
  service_id int(11) DEFAULT 0,
  user_id int(11) DEFAULT 0,
  retailer_id int(11) DEFAULT 0,
  distributor_id int(11) DEFAULT 0,

  admin_id int(11) DEFAULT 0,
  amount decimal(10,2) DEFAULT 0.00,
  aadhaar_card varchar(20) DEFAULT NULL,
  acknowledgement varchar(20) DEFAULT NULL,
  application_no varchar(50) DEFAULT NULL,
  application varchar(50) DEFAULT NULL,
  lects varchar(50) DEFAULT NULL,
  selects varchar(50) DEFAULT NULL,
  certificate varchar(20) DEFAULT NULL,
  status varchar(20) DEFAULT NULL,
  remarks varchar(100) DEFAULT NULL,
  applied_date varchar(10) DEFAULT NULL,
  completed_date varchar(10) DEFAULT NULL,
  created_at varchar(10) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

alter table smartcard_otp add smart_card varchar(20) DEFAULT NULL after application_no;

alter table smartcard add add_member varchar(50) DEFAULT NULL after aadhaar_card;
alter table smartcard add aadhaar_card2 varchar(20) DEFAULT NULL after add_member;
alter table smartcard add aadhaar_card3 varchar(20) DEFAULT NULL after aadhaar_card2;
alter table smartcard add aadhaar_card4 varchar(20) DEFAULT NULL after aadhaar_card3;
alter table smartcard add aadhaar_card5 varchar(20) DEFAULT NULL after aadhaar_card4;

alter table smartcard add member varchar(50) DEFAULT NULL after aadhaar_card;
alter table smartcard add aadhaar varchar(50) DEFAULT NULL after member;
alter table smartcard add aadhaar2 varchar(20) DEFAULT NULL after aadhaar;
alter table smartcard add aadhaar3 varchar(20) DEFAULT NULL after aadhaar2;
alter table smartcard add aadhaar4 varchar(20) DEFAULT NULL after aadhaar3;
alter table smartcard add aadhaar5 varchar(20) DEFAULT NULL after aadhaar4;

alter table smartcard add documents varchar(20) DEFAULT NULL after aadhaar3;
alter table smartcard add patta varchar(20) DEFAULT NULL after documents;
alter table smartcard add rental_agreement varchar(20) DEFAULT NULL after patta;
alter table smartcard add already_applied_application text DEFAULT NULL after rental_agreement;
alter table smartcard add family_head_aadhaar text DEFAULT NULL after family_head_photo;

//26-06-2025
alter table aadhaarcard add door_no text DEFAULT NULL after smart_link_no;
alter table aadhaarcard add street_name text DEFAULT NULL after door_no;
alter table aadhaarcard add postal_area_english text DEFAULT NULL after street_name;
alter table aadhaarcard add pin_code text DEFAULT NULL after postal_area_english;
alter table aadhaarcard add street_name_tamil text DEFAULT NULL after pin_code;
alter table aadhaarcard add postal_area_tamil text DEFAULT NULL after street_name_tamil;

//8-07-2025

alter table smartcard add vao_area text DEFAULT NULL after family_head_aadhaar;
alter table smartcard add door_no text DEFAULT NULL after vao_area;
alter table smartcard add street_name text DEFAULT NULL after door_no;
alter table smartcard add street_name_tamil text DEFAULT NULL after street_name;
alter table smartcard add postal_area_english text DEFAULT NULL after street_name_tamil;
alter table smartcard add postal_area_tamil text DEFAULT NULL after postal_area_english;

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

alter table msme add api_processing text DEFAULT NULL after certificate;
alter table msme add api_approved text DEFAULT NULL after api_processing;

alter table pancard add api_processing text DEFAULT NULL after certificate;
alter table pancard add api_approved text DEFAULT NULL after api_processing;

alter table banner add api_processing text DEFAULT NULL after certificate;
alter table banner add api_approved text DEFAULT NULL after api_processing;

alter table pstm add api_processing text DEFAULT NULL after certificate;
alter table pstm add api_approved text DEFAULT NULL after api_processing;

//18-07-2025

alter table smartcard add relationship text DEFAULT NULL;
alter table smartcard add dob text DEFAULT NULL;
alter table smartcard_otp add name varchar(100) DEFAULT NULL;
alter table smartcard_otp add documents varchar(20) DEFAULT NULL;
alter table smartcard_otp add name_tamil varchar(100) DEFAULT NULL;
alter table smartcard_otp add name_english varchar(100) DEFAULT NULL;

alter table fssai add food_service varchar(20) Default NULL;
alter table fssai add shop_photo varchar(20) Default NULL;
alter table fssai add mobile_no varchar(20) Default NULL;
alter table fssai add documents varchar(20) Default NULL;
alter table fssai add rental_agreement varchar(20) Default NULL;
alter table fssai add electricity_bill varchar(20) Default NULL;
alter table fssai add property_tax varchar(20) Default NULL;

//22-07-2025

CREATE TABLE `coordinator_permission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT 0,
  `service_id` int DEFAULT 0,
  `parent_id` int DEFAULT 0,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

-- Nalavariyam

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

CREATE TABLE `nalavariyam_taluk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `taluk_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_croatian_ci NOT NULL,
  `parent` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=329;

INSERT INTO `nalavariyam_taluk` VALUES (1,'ஆண்டிமடம்',1,1),(2,'அரியலூர்',1,1),(3,'செந்துறை',1,1),(4,'உடையார்பாளையம்',1,1),(5,'செங்கல்பட்டு',2,1),(6,'செய்யூர்',2,1),(7,'மதுரந்தகம்',2,1),(8,'பல்லாவரம்',2,1),(9,'தாம்பரம்',2,1),(10,'திருக்கழுகுன்றம்',2,1),(11,'திருப்போரூர்',2,1),(12,'வண்டலூர்',2,1),(13,'ஆலந்தூர்',3,1),(14,'அம்பத்தூர்',3,1),(15,'அமிஞ்சிகரை',3,1),(16,'அயனாவரம்',3,1),(17,'எக்மோர்',3,1),(18,'கிண்டி',3,1),(19,'மாதவரம்',39,1),(20,'மதுரவாயல்',3,1),(21,'மாம்பலம்',3,1),(22,'மயிலாப்பூர்',3,1),(23,'பெரம்பூர்',3,1),(24,'புரசைவாக்கம்',3,1),(25,'சோளிங்கநல்லூர்',3,1),(26,'திருவொற்றியூர்',39,1),(27,'தண்டையார்பேட்டை',3,1),(28,'வேளசெரி',3,1),(29,'ஆணைமலை',4,1),(30,'அன்னூர்',4,1),(31,'கோயம்புத்தூர்(வடக்கு)',4,1),(32,'கோயம்புத்தூர்(தெற்கு)',4,1),(33,'கிணத்துகடவு',4,1),(34,'மதுக்கரை',4,1),(35,'மேட்டுபாளையம்',4,1),(36,'பேரூர்',4,1),(37,'பொள்ளாச்சி',4,1),(38,'சூலூர்',4,1),(39,'வால்பாறை',4,1),(40,'புவனகிரி',5,1),(41,'சிதம்பரம்',42,1),(42,'கடலூர்',5,1),(43,'காட்டுமன்னார்கோவில்',5,1),(44,'குறிஞ்சிபாடி',42,1),(45,'பண்ருட்டி',42,1),(46,'ஸ்ரீமுஷ்ணம்',5,1),(47,'திட்டக்குடி',42,1),(48,'வேப்பூர்',5,1),(49,'விருத்தாசலம்',42,1),(50,'தர்மபுரி',6,1),(51,'ஆரூர்',6,1),(52,'காரிமங்கலம்',6,1),(53,'நல்லாம்பள்ளி',6,1),(54,'பாலக்கோடு',6,1),(55,'பப்பிரேட்டிபட்டி',6,1),(56,'பென்னகராம்',6,1),(57,'ஆத்தூர்',7,1),(58,'திண்டுக்கல்(கிழக்கு)',7,1),(59,'திண்டுக்கல்(மேற்கு)',7,1),(60,'குஜிலியாம்பறை',7,1),(61,'கொடைக்கானல்',7,1),(62,'நத்தம்',7,1),(63,'நிலகோட்டை',7,1),(64,'ஒட்டன்சத்திரம்',7,1),(65,'பழனி',7,1),(66,'வடசந்தூர்',7,1),(67,'அந்தியூர்',8,1),(68,'பவானி',8,1),(69,'ஈரோடு',8,1),(70,'கோபிசெட்டிபாளையம்',8,1),(71,'கொடுமுடி',8,1),(72,'மொடக்குறிச்சி',8,1),(73,'நம்பியூர்',8,1),(74,'பெருந்துறை',8,1),(75,'சத்தியமங்கலம்',8,1),(76,'தளவடி',8,1),(77,'சின்னசேலம்',9,1),(78,'கல்வராயன் மலை',9,1),(79,'கள்ளகுறிச்சி',9,1),(80,'சங்கரபுரம்',9,1),(81,'திருக்கோயிலூர்',9,1),(82,'உளுந்தூர்பேட்டை',9,1),(83,'காஞ்சிபுரம்',10,1),(84,'குன்றத்தூர்',10,1),(85,'ஸ்ரீபெரும்புதூர்',10,1),(86,'உத்திரமேரூர்',10,1),(87,'வாலாஜாபாத்',10,1),(88,'அகஸ்தீஸ்வரம்',11,1),(89,'கல்குளம்',11,1),(90,'கிள்ளியூர்',40,1),(91,'திருவட்டார்',40,1),(92,'தோவாளை',11,1),(93,'விளவன்கோடு',40,1),(94,'அரவக்குறிச்சி',12,1),(95,'கடவூர்',12,1),(96,'கரூர்',12,1),(97,'கிருஷ்ணராயபுரம்',12,1),(98,'குளித்தலை',12,1),(99,'மண்மங்கலம்',12,1),(100,'புகலூர்',12,1),(101,'அஞ்செட்டி',13,1),(102,'பர்கூர்',13,1),(103,'தேன்கனிகோட்டை',13,1),(104,'ஓசூர்',13,1),(105,'கிருஷ்ணகிரி',13,1),(106,'போச்சம்பள்ளி',13,1),(107,'சூளகிரி',13,1),(108,'ஊத்தங்கரை',13,1),(109,'கள்ளிகுடி',14,1),(110,'மதுரை(கிழக்கு)',14,1),(111,'மதுரை(வடக்கு)',14,1),(112,'மதுரை(மேற்கு)',14,1),(113,'மதுரை(தெற்கு)',14,1),(114,'மேலூர்',14,1),(115,'பேரையூர்',14,1),(116,'திருப்பரங்குன்றம்',14,1),(117,'திருமங்கலம்',14,1),(118,'உசிலம்பட்டி',14,1),(119,'வாடிபட்டி',14,1),(120,'குத்தாலம்',15,1),(121,'மயிலாடுதுறை',15,1),(122,'சீர்காழி',15,1),(123,'தரங்கம்பாடி',15,1),(124,'கில்வேலூர்',16,1),(125,'நாகப்பட்டினம்',16,1),(126,'திருக்குவளை',16,1),(127,'வேதாரண்யம்',16,1),(128,'கொல்லிமலை',17,1),(129,'குமாரபாளையம்',17,1),(130,'மோகனூர்',17,1),(131,'நாமக்கல்',17,1),(132,'பரமத்திவேலூர்',17,1),(133,'ராசிபுரம்',17,1),(134,'சேந்தமங்கலம்',17,1),(135,'திருச்செங்கோடு',17,1),(136,'ஆலத்தூர்',18,1),(137,'குன்னம்',18,1),(138,'பெரம்பலூர்',18,1),(139,'வேப்பந்தட்டை',18,1),(140,'ஆலங்குடி',19,1),(141,'அறந்தாங்கி',19,1),(142,'அவடையார்கோயில்',19,1),(143,'கந்தர்வகோட்டை',19,1),(144,'இல்லுப்பூர்',19,1),(145,'கரம்பக்குடி',19,1),(146,'குளத்தூர்',19,1),(147,'மணமேல்குடி',19,1),(148,'பொன்னமராவதி',19,1),(149,'புதுக்கோட்டை',19,1),(150,'திருமயம்',19,1),(151,'விராலிமலை',19,1),(152,'கடலாடி',20,1),(153,'கமுதி',20,1),(154,'கிழகரை',20,1),(155,'முதுகுளத்தூர்',20,1),(156,'பரமக்குடி',20,1),(157,'ராஜசிங்கமங்கலம்',20,1),(158,'இராமநாதபுரம்',20,1),(159,'ராமேஸ்வரம்',20,1),(160,'திருவாடனை',20,1),(161,'அரக்கோணம்',21,1),(162,'ஆற்காடு',21,1),(163,'கலவை',21,1),(164,'நெமிலி',21,1),(165,'சோளிங்கர்',21,1),(166,'வாலாஜாபேட்டை',21,1),(167,'ஆத்தூர்',22,1),(168,'எடப்பாடி',22,1),(169,'கங்காவள்ளி',22,1),(170,'கடையம்பட்டி',22,1),(171,'மேட்டூர்',22,1),(172,'ஓமலூர்',22,1),(173,'பெத்தனைக்கன்பாளையம்',22,1),(174,'சேலம்',22,1),(175,'சேலம் தெற்கு',22,1),(176,'சேலம் மேற்கு',22,1),(177,'சங்ககிரி',22,1),(178,'தலைவாசல்',22,1),(179,'வாலபடி',22,1),(180,'ஏர்காடு',22,1),(181,'தேவக்கோட்டை',23,1),(182,'இளையான்குடி',23,1),(183,'காளையர்கோவில்',23,1),(184,'காரைக்குடி',23,1),(185,'மானாமதுரை',23,1),(186,'சிங்கம்புணரி',23,1),(187,'சிவகங்கை',23,1),(188,'திருப்புவனம்',23,1),(189,'திருப்பத்தூர்',23,1),(190,'ஆலங்குளம்',24,1),(191,'கடையநல்லூர்',24,1),(192,'சங்கரன்கோவில்',24,1),(193,'செங்கோட்டை',24,1),(194,'சிவகிரி',24,1),(195,'தென்காசி',24,1),(196,'திருவேங்கடம்',24,1),(197,'வீரகேரளபுரம்',24,1),(198,'பூதலூர்',25,1),(199,'கும்பகோணம்',25,1),(200,'ஒரத்தநாடு',25,1),(201,'பாபநாசம்',25,1),(202,'பட்டுக்கோட்டை',25,1),(203,'பேராவூரணி',25,1),(204,'தஞ்சாவூர்',25,1),(205,'திருவையாறு',25,1),(206,'திருவிடைமருதூர்',25,1),(207,'குன்னூர்',26,1),(208,'கூடலூர்',26,1),(209,'கோத்தகிரி',26,1),(210,'குந்தா',26,1),(211,'பந்தலூர்',26,1),(212,'உதகமண்டலம்',26,1),(213,'ஆண்டிப்பட்டி',27,1),(214,'போடினயகனுர்',27,1),(215,'பெரியகுளம்',27,1),(216,'தேனி',27,1),(217,'உத்தமபாளையம்',27,1),(218,'லால்குடி',28,1),(219,'மணச்சநல்லூர்',28,1),(220,'மணப்பாறை',28,1),(221,'மருங்காபுரி',28,1),(222,'முசிறி',28,1),(223,'ஸ்ரீரங்கம்',28,1),(224,'திருச்சிராப்பள்ளி-தெற்கு',28,1),(225,'திருவெரம்பூர்',28,1),(226,'தொட்டியம்',28,1),(227,'துறையூர்',28,1),(228,'திருச்சிராப்பள்ளி-கிழக்கு',28,1),(229,'கூத்தநல்லூர்',29,1),(230,'குடவாசல்',29,1),(231,'மன்னார்குடி',29,1),(232,'நன்னிலம்',29,1),(233,'நீடமங்கலம்',29,1),(234,'திருத்துறைப்பூண்டி',29,1),(235,'திருவாரூர்',29,1),(236,'வலங்கைமான்',29,1),(237,'ஏரல்',30,1),(238,'எட்டயபுரம்',30,1),(239,'கயத்தாறு',30,1),(240,'கோவில்பட்டி',30,1),(241,'ஓட்டபிடாரம்',30,1),(242,'சாத்தன்குளம்',30,1),(243,'ஸ்ரீவைகுண்டம்',30,1),(244,'தூத்துக்குடி',30,1),(245,'திருச்செந்தூர்',30,1),(246,'விளாத்திகுளம்',30,1),(247,'அம்பாசமுத்திரம்',31,1),(248,'சேரன்மாதேவி',31,1),(249,'மானூர்',31,1),(250,'நாங்குநேரி',31,1),(251,'பாளையங்கோட்டை',31,1),(252,'ராதாபுரம்',31,1),(253,'திசையன்விளை',31,1),(254,'திருநெல்வேலி',31,1),(255,'ஆம்பூர்',32,1),(256,'நற்றம்பள்ளி',32,1),(257,'திருபத்தூர் தெற்கு',32,1),(258,'வாணியம்பாடி',32,1),(259,'அவினாசி',33,1),(260,'தாராபுரம்',33,1),(261,'காங்கேயம்',33,1),(262,'மாடத்துக்குளம்',33,1),(263,'பல்லடம்',33,1),(264,'திருப்பூர் வடக்கு',33,1),(265,'திருப்பூர் தெற்கு',33,1),(266,'உடுமலைப்பேட்டை',33,1),(267,'ஊத்துக்குளி',33,1),(268,'ஆவடி',34,1),(269,'கும்மிடிப்பூண்டி',39,1),(270,'பள்ளிப்பட்டு',34,1),(271,'பொன்னேரி',39,1),(272,'பூந்தமல்லி',34,1),(273,'R.K.பேட்டை',34,1),(274,'திருத்தணி',34,1),(275,'திருவள்ளூர்',34,1),(276,'உதக்கோட்டை',34,1),(277,'ஆரணி',35,1),(278,'செங்கம்',35,1),(279,'செத்பேட்டை',35,1),(280,'செய்யூர்',35,1),(281,'ஜமுனமரதூர்',35,1),(282,'கலசபாக்கம்',35,1),(283,'கீழ்பென்னதூர்',35,1),(284,'போலூர்',35,1),(285,'தண்டராம்பட்டு',35,1),(286,'திருவண்ணாமலை',35,1),(287,'வந்தவாசி',35,1),(288,'வெம்பாக்கம்',35,1),(289,'அணைகட்டு',36,1),(290,'குடியாத்தம்',36,1),(291,'K V குப்பம்',36,1),(292,'காட்பாடி வடக்கு',36,1),(293,'பேர்ணாம்பட்டு',36,1),(294,'வேலூர் வடக்கு',36,1),(295,'செஞ்சி',37,1),(296,'கண்டாச்சிபுரம்',37,1),(297,'மரக்காணம்',37,1),(298,'மேல்மலையனூர்',37,1),(299,'திருவெண்ணெய்நல்லூர்',37,1),(300,'திண்டிவனம்',37,1),(301,'வானூர்',37,1),(302,'விக்கிரவாண்டி',37,1),(303,'விழுப்புரம்',37,1),(304,'அருப்புகோட்டை',38,1),(305,'காரியாபட்டி',38,1),(306,'ராஜபாளையம்',38,1),(307,'சாத்தூர்',38,1),(308,'சிவகாசி',38,1),(309,'ஸ்ரீவில்லிபுத்தூர்',38,1),(310,'திருச்சுழி',38,1),(311,'வெம்பக்கோட்டை',38,1),(312,'விருதுநகர்',38,1),(313,'வத்திராயிருப்பு',38,1),(315,'இராசிபுரம்',17,1),(317,'காட்பாடி தெற்கு',36,1),(319,'திருவண்ணாமலை(நகரம்)',35,1),(320,'தஞ்சாவூர் நகரம்',25,1),(322,'திருப்பத்தூர் வடக்கு',32,1),(323,'தக்கலை',11,1),(324,'கல்குளம் NEW',26,1),(325,'வேலூர் தெற்கு',36,1),(328,'கோவில்பட்டி நகரம்',30,1);

CREATE TABLE `nalavariyam_remarks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `remarks` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;


INSERT INTO `nalavariyam_remarks` VALUES (1,'Crop and Resize (800*1100)','Active'),
(2,'Fill All Columns','Active'),
(3,'Use Blue Ink','Active'),
(4,'Fill Academic Year(Example : 2025-2026)','Active'),
(5,'Fill studying year (Example: 1st Year, 2nd Year ,3rd Year,4th Year)','Active'),
(6,'Signature (Dont Cut & Paste)','Active'),
(7,'Fill Date Of Birth ( Expect Adhaar)','Active'),
(8,'Degree Name (Example BA, MBA,MA,BE, Diploma, ITI,....)','Active'),
(9,'Fill Registration Number & Date','Active'),
(10,'Fill Working Years','Active'),
(11,'Fill Work Name As Per Labour Department work list Chart','Active');


//04-08-2025
alter table family_member add relation_name_tamil text DEFAULT NULL after relation_name;
alter table family_member add service_id int(11) DEFAULT 0 after user_id;
alter table family_member add occupation text DEFAULT NULL after relation_name_tamil;

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

alter table tnega_services add tc varchar(30) DEFAULT NULL after mother_form;

//9-07-2025

alter table voterid add dist_id int(11) DEFAULT 0;
alter table voterid add taluk_id int(11) DEFAULT 0;
alter table voterid add panchayath_id  int(11) DEFAULT 0;
alter table voterid add constituent_assembly varchar(100) DEFAULT NULL after application_no;
alter table voterid add name_in_tamil varchar(100) DEFAULT NULL after application_no;
alter table voterid add name_in_english varchar(100) DEFAULT NULL after application_no;
alter table voterid add door_no varchar(20) DEFAULT NULL after application_no;
alter table voterid add postal_area_tamil text DEFAULT NULL after application_no;
alter table voterid add postal_area_english text DEFAULT NULL after application_no;
alter table voterid add street_name_tamil text DEFAULT NULL after application_no;
alter table voterid add street_name_english text DEFAULT NULL after application_no;
alter table voterid add voterid_no varchar(10) DEFAULT NULL after application_no;
alter table voterid add pin_code varchar(12) DEFAULT NULL after application_no;

26-08-2025

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
alter table voterid add correction varchar(30) DEFAULT NULL;
alter table voterid add gender varchar(20) DEFAULT NULL;
alter table voterid add dob varchar(10) DEFAULT NULL;
alter table voterid add age_proof varchar(20) DEFAULT NULL;
alter table voterid add relation varchar(20) DEFAULT NULL;
alter table voterid add document varchar(20) DEFAULT NULL;
alter table voterid add name_tamil varchar(100) DEFAULT NULL;
alter table voterid add name_english varchar(100) DEFAULT NULL;
alter table voterid add select_relationship varchar(30) DEFAULT NULL;
alter table voterid add within_assembly varchar(50) DEFAULT NULL;
alter table voterid add street_name text DEFAULT NULL;
alter table voterid add post_office text DEFAULT NULL;
alter table voterid add apartment_no varchar(20) DEFAULT NULL;
alter table voterid add taluqa_mandal text DEFAULT NULL;
alter table voterid add town_village text DEFAULT NULL;
alter table voterid add name_assembly_constituency text DEFAULT NULL;
alter table voterid add dist_id int(11) DEFAULT 0;
alter table voterid add constituent_assembly varchar(200) DEFAULT NULL;
alter table voterid add name_in_english varchar(100) DEFAULT NULL;

11-09-2025

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

CREATE TABLE utislpanservice (
  id int NOT NULL AUTO_INCREMENT,
  service_name varchar(200) DEFAULT NULL,
  ser_image varchar(20) DEFAULT NULL,
  status varchar(20) DEFAULT NULL,
  date varchar(20) DEFAULT NULL,
  PRIMARY KEY (id)
)  ENGINE=InnoDB;

CREATE TABLE utislpanpayment (
  id int NOT NULL AUTO_INCREMENT,
  parent_id int DEFAULT 0,
  service_id int DEFAULT 0,
  distributor_amount decimal(10,2) DEFAULT 0,
  retailer_amount decimal(10,2) DEFAULT 0,
  customer_amount decimal(10,2) DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

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

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notify` varchar(2000) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `wallet_topup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `website_index` varchar(50) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT 0,
  `date` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `payment_proof` text DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

ALTER TABLE request_payment CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE wallet_topup CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

//24-09-2025

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
//21-09-2025
alter table family_member add relation_income varchar(100) DEFAULT NULL;

21-09-2025

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

//2-10-2025

alter table services add ramjiservice_id int(11) DEFAULT 0 after parent_id;
alter table find_services add ramjiservice_id int(11) DEFAULT 0 after id;
alter table operator add ramjiservice_id int(11) DEFAULT 0;
alter table panservice add ramjiservice_id int(11) DEFAULT 0 after id;
alter table service_payment add ramjiservice_id int(11) DEFAULT 0 after parent_id;
alter table find_payment add ramjiservice_id int(11) DEFAULT 0 after service_id;
alter table recharge_payment add ramjiservice_id int(11) DEFAULT 0 after service_id;
alter table panpayment add ramjiservice_id int(11) DEFAULT 0 after service_id;

CREATE TABLE `enquiry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `user_id` varchar(10) DEFAULT 0,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `requirement` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

alter table enquiry add user_id varchar(10) DEFAULT 0 after name;

CREATE TABLE `requirement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `requirement_name` varchar(200) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

//1-11-2025

CREATE TABLE `bulk_service_orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `service_id` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL,
  `amount` DECIMAL(10,2) NOT NULL,
  `added_datetime` DATE NOT NULL,
  `login_id` INT(11) NOT NULL,
  `user_type_id` INT(11) DEFAULT NULL,
  `district_id` INT(11) DEFAULT NULL,
  `status` VARCHAR(20) DEFAULT NULL,
  `superadmin_amount` DECIMAL(10,2) DEFAULT 0.00,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `login_id` (`login_id`),
  KEY `district_id` (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `bulk_service_usage` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) DEFAULT 0,
  `service_id` INT(11) DEFAULT 0,
  `total` INT(11) DEFAULT 0,
  `used` INT(11) DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table users add nalavariyamwallet decimal(10,2) DEFAULT 0 after wallet;

CREATE TABLE `newenquiry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(500) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=InnoDB;

//6-12-2025

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

//18-12-2025

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

//19-12-2025

alter table rc add engine varchar(15) Default NULL;

//07-01-2026
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

alter table medicalscheme add passportsize_photo varchar(20) Default NULL;
alter table medicalscheme add pin_code varchar(10) Default NULL;
alter table medicalscheme add husband_name text Default NULL;
alter table medicalscheme add father_name text Default NULL;
alter table medicalscheme add marital_status varchar(50) Default NULL;
alter table medicalscheme add aadhaar_no varchar(20) Default NULL;
alter table medicalscheme add smartcard_no varchar(20) Default NULL;
alter table medicalscheme add relationship varchar(50) Default NULL;
alter table medicalscheme add relation varchar(50) DEFAULT NULL;
alter table medicalscheme add member varchar(20) DEFAULT NULL after application_no;
alter table medicalscheme add aadhaar varchar(20) DEFAULT NULL after member;
alter table medicalscheme add aadhaar2 varchar(20) DEFAULT NULL after aadhaar;
alter table medicalscheme add aadhaar3 varchar(20) DEFAULT NULL after aadhaar2;
alter table medicalscheme add aadhaar4 varchar(20) DEFAULT NULL after aadhaar3;
alter table medicalscheme add aadhaar5 varchar(20) DEFAULT NULL after aadhaar4;
alter table medicalscheme add aadhaar6 varchar(20) DEFAULT NULL after aadhaar5;
alter table medicalscheme add photo varchar(20) Default NULL;
alter table medicalscheme add vao_or_income_certificate varchar(20) Default NULL;

alter table voteridpdf_download add api_processing text DEFAULT NULL after certificate;
alter table voteridpdf_download add api_approved text DEFAULT NULL after api_processing;

//13-01-2026

CREATE TABLE `pvc_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `delivery_name` varchar(90) DEFAULT NULL,
  `delivery_mobile` varchar(20) DEFAULT NULL,
  `delivery_address` varchar(500) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
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

CREATE TABLE pvc_details (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pvc_id INT UNSIGNED NOT NULL,
    service_name VARCHAR(100) NOT NULL,
    password VARCHAR(255) DEFAULT NULL,
    document VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX (pvc_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

alter table pvc_details add pvc_rationpdf varchar(255) DEFAULT NULL after document;

22-01-2026

CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `username_type` varchar(50) DEFAULT NULL,
  `user_type_id` varchar(10) DEFAULT NULL,
  `nalavariyam_usertype` int DEFAULT NULL,
  `refferal_id` varchar(10) DEFAULT NULL,
  `verified` int DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `aadhaar_file` varchar(10) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `pan_file` varchar(10) DEFAULT NULL,
  `smartcard` varchar(20) DEFAULT NULL,
  `smartcard_no` varchar(15) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `dist_id` int DEFAULT NULL,
  `taluk_id` int DEFAULT NULL,
  `panchayath_id` int DEFAULT NULL,
  `nalavariyam_dist_id` int DEFAULT NULL,
  `nalavariyam_taluk_id` int DEFAULT NULL,
  `panchayath_name` varchar(50) DEFAULT NULL,
  `can_details` varchar(20) DEFAULT NULL,
  `can_number` varchar(20) DEFAULT NULL,
  `date_of_birth` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `cpassword` varchar(20) DEFAULT NULL,
  `profile` varchar(10) DEFAULT NULL,
  `qr_image` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `wallet` decimal(10,2) DEFAULT '0.00',
  `rawallet` decimal(10,2) DEFAULT '0.00',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_completed` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table aadhaarcard add aadhaar_no varchar(12) DEFAULT NULL;

alter table aadhaarcard add schl_id_card varchar(20) DEFAULT NULL;
alter table aadhaarcard add bank_pass_book varchar(20) DEFAULT NULL;
alter table aadhaarcard add voterid varchar(20) DEFAULT NULL;
alter table aadhaarcard add id_proof varchar(50) DEFAULT NULL;
alter table aadhaarcard add smartcard_onlineprint varchar(20) DEFAULT NULL;
alter table aadhaarcard add relation_name_tamil varchar(100) DEFAULT NULL;
alter table aadhaarcard add relation_name_english varchar(100) DEFAULT NULL;
alter table aadhaarcard add relationship1 varchar(50);

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

13-02-2026

-- Name Showing Column

alter table aadhaarcard add cusname varchar(200) after relationship1;
alter table voterid add cusname varchar(200) after certificate;
alter table voteridpdf_download add cusname varchar(200) after remarks;
alter table can_edit add cusname varchar(200) after certificate;
alter table itr add cusname varchar(200) after remarks;
alter table msme add cusname varchar(200) after remarks;

-- Qr Change Column

alter table users add qrimage varchar(200) after profile;


//28-2-2026//

USE pkrm;

ALTER TABLE aadhaarcard
ADD relation_name_english varchar(100) DEFAULT NULL,
ADD relation_name_tamil varchar(100) DEFAULT NULL,
ADD smartcard_onlineprint varchar(50) DEFAULT NULL,
ADD id_proof varchar(50) DEFAULT NULL,
ADD voterid varchar(50) DEFAULT NULL,
ADD bank_pass_book varchar(50) DEFAULT NULL,
ADD schl_id_card varchar(50) DEFAULT NULL,
ADD relationship1 varchar(100) DEFAULT NULL,
ADD with_proof varchar(50) DEFAULT NULL,
ADD father_hus_aadhaar_no varchar(12) DEFAULT NULL,
ADD father_aadhaar_no varchar(12) DEFAULT NULL,
ADD father_hus_mobile varchar(10) DEFAULT NULL,
ADD father_mobile varchar(10) DEFAULT NULL,
ADD document_type varchar(30) DEFAULT NULL,
ADD applicant_document_type varchar(30) DEFAULT NULL,
ADD parent_mobile varchar(10) DEFAULT NULL,
ADD parent_aadhaar_front varchar(20) DEFAULT NULL,
ADD parent_aadhaar varchar(15) DEFAULT NULL,
ADD parent_name TEXT DEFAULT NULL,
ADD parent_document_type varchar(30) DEFAULT NULL,
ADD relative_address_tamil TEXT DEFAULT NULL,
ADD relative_address_english TEXT DEFAULT NULL,
ADD relation_name TEXT DEFAULT NULL,
ADD relation_aadhaar varchar(15) DEFAULT NULL,
ADD relation_mobile varchar(10) DEFAULT NULL,
ADD marital_status varchar(30) DEFAULT NULL,
ADD birth_certificate varchar(30) DEFAULT NULL,
ADD eid_no varchar(50) DEFAULT NULL,
ADD date varchar(20) DEFAULT NULL,
ADD time varchar(20) DEFAULT NULL;
ALTER TABLE aadhaarcard MODIFY created_at DATETIME NULL;


alter table medicalscheme add aadhaar_card text DEFAULT null;
alter table medicalscheme add relation varchar(100) DEFAULT null;
alter table medicalscheme add api_processing text DEFAULT NULL after certificate;
alter table medicalscheme add api_approved text DEFAULT NULL after api_processing;
alter table medicalscheme add relationship text DEFAULT NULL after certificate;
alter table medicalscheme add smartcard_no text DEFAULT NULL after api_processing;
alter table medicalscheme add aadhaar_no text DEFAULT NULL after api_processing;
alter table medicalscheme add aadhaar_no text DEFAULT NULL after api_processing;
alter table medicalscheme add father_name text DEFAULT NULL after api_processing;
alter table medicalscheme add marital_status text DEFAULT NULL after api_processing;

alter table wallet_topup add order_id varchar(50) DEFAULT NULL after id;
alter table wallet_topup add transaction_id varchar(100) DEFAULT NULL after order_id;
alter table wallet_topup add updated_at varchar(30) DEFAULT NULL after date;

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

alter table users add column member_id varchar(20) default NULL;
alter table nalavariyam_customer add column member_id varchar(20) default NULL;

alter table nalavariyam_customer add photo varchar(20) DEFAULT NULL;
alter table nalavariyam_customer add signature varchar(20) DEFAULT NULL;
alter table nalavariyam_customer add work_type varchar(200) DEFAULT NULL;
alter table nalavariyam_customer add dob varchar(10) DEFAULT NULL;

ALTER TABLE users
MODIFY COLUMN nalavariyam_dist_id TEXT NULL;

alter table aadhaarcard add relationship_tamil varchar(70) DEFAULT NULL;

ALTER TABLE nalavariyam_form
MODIFY COLUMN dist_id TEXT NULL;

17-07-2026


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


alter table family_member add sex varchar(20) DEFAULT NULL after income;
alter table family_member add living_status varchar(100) DEFAULT NULL after sex;

alter table family_member add sex varchar(20) DEFAULT NULL after income;
alter table family_member add living_status varchar(100) DEFAULT NULL after sex;

ALTER TABLE family_member
MODIFY profession varchar(100);

ALTER TABLE family_member ADD COLUMN family_name_tamil VARCHAR(100) NULL;
ALTER TABLE family_member ADD COLUMN family_name_english VARCHAR(100) NULL;
ALTER TABLE family_member ADD COLUMN age TINYINT NULL;
ALTER TABLE family_member ADD COLUMN sex VARCHAR(20) NULL;
ALTER TABLE family_member ADD COLUMN profession VARCHAR(50) NULL;
ALTER TABLE family_member ADD COLUMN family_profession VARCHAR(100) NULL;
ALTER TABLE family_member ADD COLUMN income_source VARCHAR(100) NULL;
ALTER TABLE family_member ADD COLUMN relationship VARCHAR(50) NULL;


ALTER TABLE family_member ADD COLUMN name_tamil VARCHAR(100) NULL;
ALTER TABLE family_member ADD COLUMN name_english VARCHAR(100) NULL;
ALTER TABLE family_member ADD COLUMN age TINYINT NULL;
ALTER TABLE family_member ADD COLUMN sex VARCHAR(20) NULL;
ALTER TABLE family_member ADD COLUMN profession VARCHAR(100) NULL;
ALTER TABLE family_member ADD COLUMN income_source VARCHAR(100) NULL;


ALTER TABLE family_member ADD COLUMN family_profession VARCHAR(100) NULL;
ALTER TABLE family_member ADD COLUMN family_income_source VARCHAR(100) NULL;
ALTER TABLE family_member ADD COLUMN pan_card VARCHAR(20) NULL;
ALTER TABLE family_member ADD COLUMN extra_document VARCHAR(100) NULL;
alter table family_member add father_form varchar(100) DEFAULT NULL after living_status;
alter table family_member add education_document varchar(100) DEFAULT NULL after father_form;

alter table family_member add tamil_name varchar(100) DEFAULT NULL after education_document;
alter table family_member add english_name varchar(100) DEFAULT NULL after tamil_name;


CREATE TABLE `family_member_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `relation` varchar(255) DEFAULT NULL,
  `tamil_name` varchar(255) DEFAULT NULL,
  `english_name` varchar(255) DEFAULT NULL,
  `relation_age` varchar(50) DEFAULT NULL,
  `living_status` varchar(100) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `doc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


alter table family_member_new add family_count varchar(20) DEFAULT NULL after doc;

ALTER TABLE family_member ADD COLUMN pancard VARCHAR(20) NULL;
ALTER TABLE family_member ADD COLUMN family_extra  VARCHAR(60) NULL;
ALTER TABLE family_member ADD COLUMN family_pan  VARCHAR(60) NULL;

ALTER TABLE family_member
ADD applied_service_id INT(11) DEFAULT 0;

alter table tnega_services add employment_card text DEFAULT NULL after nativity_type;   
alter table tnega_services add school_college_name text DEFAULT NULL after employment_card;   
alter table tnega_services add board_university text DEFAULT NULL after school_college_name;   
alter table tnega_services add year_of_birth text DEFAULT NULL after board_university;   
alter table tnega_services add graduation text DEFAULT NULL after year_of_birth;   
alter table tnega_services add qualification text DEFAULT NULL after graduation;   

alter table family_member add salary_slip varchar(20) DEFAULT NULL;
alter table family_member add land_hold varchar(20) DEFAULT NULL;
alter table family_member add tin_number varchar(20) DEFAULT NULL;
alter table family_member add owned_house varchar(20) DEFAULT NULL;

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

alter table family_member add relation_name_english varchar(100) DEFAULT NULL;


CREATE TABLE `nativity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
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
      `status` varchar(20) DEFAULT NULL,
       `remarks` text DEFAULT NULL,
       `application_no` text DEFAULT NULL,
      `certificate` varchar(20) DEFAULT NULL,
      `applied_date` varchar(10) DEFAULT NULL,
       `completed_date` varchar(10) DEFAULT NULL,
      `created_at` varchar(10) DEFAULT NULL,
       PRIMARY KEY (`id`)
     ) ENGINE=InnoDB;

alter table tnega_obc add caste text DEFAULT NULL after name; 
alter table tnega_obc add graduation text DEFAULT NULL after caste; 
alter table tnega_obc add dist_id int(11) DEFAULT 0 after admin_id; 
alter table tnega_obc add taluk_id int(11) DEFAULT 0 after dist_id; 
alter table tnega_obc add selects text after application_no; 
alter table tnega_obc add lects text after selects; 
alter table tnega_obc add application text after lects; 
alter table tnega_obc add acknowledgement  text after application;

alter table income add relationship  varchar(50) DEFAULT NULL; 
alter table income add relation_name_tamil varchar(100) DEFAULT NULL; 
alter table income add relation_name_english varchar(100) DEFAULT NULL; 
alter table income add relation_age varchar(10) DEFAULT NULL; 
alter table income add relation_status varchar(50) DEFAULT NULL; 
alter table income add family_income_source  varchar(50) DEFAULT NULL; 
alter table income add photo varchar(20) DEFAULT NULL; 
alter table income add smart_card varchar(20) DEFAULT NULL; 
alter table income add signature varchar(20) DEFAULT NULL; 
alter table income add aadhaar_card varchar(20) DEFAULT NULL; 

ALTER TABLE nativity
MODIFY door_no TEXT,
MODIFY street_name TEXT,
MODIFY pin_code TEXT,
MODIFY revenue_village TEXT,
MODIFY nativity_taluk TEXT,
MODIFY nativity_district TEXT,
MODIFY from_date TEXT,
MODIFY to_date TEXT;

alter table tnega_obc add photo text DEFAULT NULL after tnega_religion; 
alter table tnega_obc add aadhaar_card text DEFAULT NULL after photo; 
alter table tnega_obc add community text DEFAULT NULL after aadhaar_card; 
alter table tnega_obc add signature text DEFAULT NULL after community; 
alter table tnega_obc add mother_income_proof text DEFAULT NULL after signature; 
alter table tnega_obc add mother_income_proof_file text DEFAULT NULL after mother_income_proof; 
alter table tnega_obc add father_income_proof_file text DEFAULT NULL after mother_income_proof_file; 
alter table tnega_obc add father_income_proof text DEFAULT NULL after father_income_proof_file; 

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
    `photo` varchar(255) DEFAULT NULL,
    `aadhaar_card` varchar(255) DEFAULT NULL,
    `signature` varchar(255) DEFAULT NULL,
    `school_proof` varchar(255) DEFAULT NULL,
    `status` varchar(20) DEFAULT NULL,
    `remarks` text DEFAULT NULL,
    `application_no` text DEFAULT NULL,
    `certificate` varchar(255) DEFAULT NULL,
    `applied_date` varchar(10) DEFAULT NULL,
    `completed_date` varchar(10) DEFAULT NULL,
    `created_at` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table tnega_residence add birth_certificate text DEFAULT NULL after aadhaar_card; 
alter table tnega_residence add nativity_type text DEFAULT NULL after revenue_village; 
alter table tnega_residence add selects text DEFAULT NULL after application_no; 
alter table tnega_residence add address_count text DEFAULT NULL after street_name; 
alter table tnega_residence add lects text DEFAULT NULL after selects; 
alter table tnega_residence add application text DEFAULT NULL after application_no; 
alter table tnega_residence add acknowledgement text DEFAULT NULL after certificate; 
alter table tnega_residence add dist_id int(11) DEFAULT 0 after admin_id; 
alter table tnega_residence add taluk_id int(11) DEFAULT 0 after dist_id; 


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
    `acknowledgement` text DEFAULT NULL,
    `applied_date` varchar(10) DEFAULT NULL,
    `completed_date` varchar(10) DEFAULT NULL,
    `created_at` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

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
    `acknowledgement` text DEFAULT NULL,
    `applied_date` varchar(10) DEFAULT NULL,
    `completed_date` varchar(10) DEFAULT NULL,
    `created_at` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

alter table income add work_tamil varchar(200) DEFAULT NULL; 
alter table income add work_english varchar(200) DEFAULT NULL; 
alter table family_member add work_tamil varchar(200) DEFAULT NULL; 
alter table family_member add work_english varchar(200) DEFAULT NULL; 

CREATE TABLE `tnega_handicap` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `service_id` int(11) DEFAULT 0,
    `user_id` int(11) DEFAULT 0,
    `retailer_id` int(11) DEFAULT 0,
    `distributor_id` int(11) DEFAULT 0,
    `admin_id` int(11) DEFAULT 0,
    `dist_id` int(11) DEFAULT 0,
    `taluk_id` int(11) DEFAULT 0,
    `amount` decimal(10,2) DEFAULT 0.00,
    `category_disability` text DEFAULT NULL,
    `differently_abled_type` text DEFAULT NULL,
    `nidc_disability_type` text DEFAULT NULL,
    `national_idcardno` text DEFAULT NULL,
    `id_card_type` text DEFAULT NULL,
    `temporary_valid_till` text DEFAULT NULL,
    `scheme` text DEFAULT NULL,
    `state_id_card` text DEFAULT NULL,
    `udid_number` text DEFAULT NULL,
    `bank_name` text DEFAULT NULL,  
    `bank_district` text DEFAULT NULL,  
    `branch_name` text DEFAULT NULL,  
    `ifsc_code` text DEFAULT NULL,  
    `account_number` text DEFAULT NULL,  
    `micr_number` text DEFAULT NULL,  
    `percentage` text DEFAULT NULL,
    `photo` text DEFAULT NULL,
    `aadhaar_card` text DEFAULT NULL,
    `parent_guardian_id` text DEFAULT NULL,
    `bank_passbook` text DEFAULT NULL,
    `ration_card` text DEFAULT NULL,
    `disability_certificate` text DEFAULT NULL,
    `parent_photo` text DEFAULT NULL,
    `udid` text DEFAULT NULL,
    `marriage_invitation` text DEFAULT NULL,
    `status` varchar(20) DEFAULT NULL,
    `remarks` text DEFAULT NULL,
    `application_no` text DEFAULT NULL,
    `selects` text DEFAULT NULL,
    `lects` text DEFAULT NULL,
    `application` text DEFAULT NULL,
    `certificate` text DEFAULT NULL,
    `acknowledgement` text DEFAULT NULL,
    `applied_date` varchar(10) DEFAULT NULL,
    `completed_date` varchar(10) DEFAULT NULL,
    `created_at` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;


CREATE TABLE `tnega_widow` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `service_id` int(11) DEFAULT 0,
    `user_id` int(11) DEFAULT 0,
    `retailer_id` int(11) DEFAULT 0,
    `distributor_id` int(11) DEFAULT 0,
    `admin_id` int(11) DEFAULT 0,
    `dist_id` int(11) DEFAULT 0,
    `taluk_id` int(11) DEFAULT 0,
    `amount` decimal(10,2) DEFAULT 0.00,
    `relationship` text DEFAULT NULL,
    `guardian_name` text DEFAULT NULL,
    `guardian_name_tamil` text DEFAULT NULL,
    `spouse_name` text DEFAULT NULL,
    `spouse_name_tamil` text DEFAULT NULL,
    `date_of_marriage` text DEFAULT NULL,
    `date_of_death` text DEFAULT NULL,
    `death_certificate_no` text DEFAULT NULL,
    `photo` text DEFAULT NULL,
    `address_proof` text DEFAULT NULL,
    `death_certificate_husband` text DEFAULT NULL,
    `marriage_proof` text DEFAULT NULL,
    `status` varchar(20) DEFAULT NULL,
    `remarks` text DEFAULT NULL,
    `application_no` text DEFAULT NULL,
    `selects` text DEFAULT NULL,
    `lects` text DEFAULT NULL,
    `application` text DEFAULT NULL,
    `certificate` text DEFAULT NULL,
    `acknowledgement` text DEFAULT NULL,
    `applied_date` varchar(10) DEFAULT NULL,
    `completed_date` varchar(10) DEFAULT NULL,
    `created_at` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `declaration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `declaration_form` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `declaration`(id,declaration_form) VALUES (1,'join declarasion form.pdf');

alter table services add ramjiservice_id int(11) DEFAULT 0 after parent_id;
alter table find_services add ramjiservice_id int(11) DEFAULT 0 after id;
alter table operator add ramjiservice_id int(11) DEFAULT 0;
alter table panservice add ramjiservice_id int(11) DEFAULT 0 after id;
alter table service_payment add ramjiservice_id int(11) DEFAULT 0 after parent_id;
alter table find_payment add ramjiservice_id int(11) DEFAULT 0 after service_id;
alter table recharge_payment add ramjiservice_id int(11) DEFAULT 0 after service_id;
alter table panpayment add ramjiservice_id int(11) DEFAULT 0 after service_id;

ALTER TABLE tnega_services ADD COLUMN relation_name_tamil text NULL;
ALTER TABLE tnega_services ADD COLUMN relation_name_english  text NULL;
ALTER TABLE tnega_services ADD COLUMN relation_age text NULL;
ALTER TABLE tnega_services ADD COLUMN relation_status text NULL;
ALTER TABLE tnega_services ADD COLUMN family_income_source  text NULL;
ALTER TABLE tnega_services ADD COLUMN family_graduation  text NULL;
ALTER TABLE tnega_services ADD COLUMN sibling_graduation  text NULL;

alter table tnega_services add community_certificate text DEFAULT NULL;   
alter table tnega_services add family_count text DEFAULT NULL;   
alter table tnega_services add education_document text DEFAULT NULL;   
alter table tnega_services add applicant_tc text DEFAULT NULL NULL after education_document;   
alter table tnega_services add tamil_name text DEFAULT NULL NULL after applicant_tc;    
alter table tnega_services add english_name text DEFAULT NULL NULL after tamil_name; 

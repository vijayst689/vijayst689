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
  `customer_id` int DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0,
  `service_id` int DEFAULT 0,
  `retailer_id` int DEFAULT 0,
  `distributor_id` int DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
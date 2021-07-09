ALTER TABLE `recruit_job_application` ADD `work_experience_in_months` INT NULL DEFAULT NULL AFTER `work_experience_in_years`;
ALTER TABLE `recruit_job_application` ADD `months_in_current_position` INT NULL DEFAULT NULL AFTER `years_in_current_position`;
ALTER TABLE `recruit_job_application` ADD `work_experience` TEXT NULL DEFAULT NULL AFTER `age_month`;
ALTER TABLE `recruit_education_background` ADD `education_institution` VARCHAR(128) NOT NULL AFTER `education_level_id`;
ALTER TABLE `recruit_job_application` ADD `language_proficiency` VARCHAR(512) NOT NULL AFTER `application_status`;
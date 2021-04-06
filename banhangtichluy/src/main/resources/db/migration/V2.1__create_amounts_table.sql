CREATE TABLE amounts (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(25) NOT NULL,
    `code` VARCHAR(25) NOT NULL,
    `value` INT UNSIGNED NOT NULL,
    `first_name` VARCHAR(25) DEFAULT NULL,
    `last_name` VARCHAR(25) DEFAULT NULL,
    `email` VARCHAR(25) DEFAULT NULL,
    `phone` VARCHAR(25) DEFAULT NULL,
    `note` VARCHAR(150) DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_by` BIGINT NOT NULL,
    `updated_by` BIGINT NOT NULL,
    UNIQUE INDEX `ui_type_code` (`type` ASC, `code` ASC)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;
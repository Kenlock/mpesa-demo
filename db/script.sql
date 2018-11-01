CREATE TABLE b2c
(
  id                                       INT                                     NULL,
  originator_conversation_id               TINYTEXT                                NULL,
  conversation_id                          TINYTEXT                                NULL,
  transaction_id                           TINYTEXT                                NULL,
  amount                                   INT                                     NULL,
  recipient_is_registered_customer         TINYINT                                 NULL,
  b2c_charges_paid_account_available_funds DOUBLE                                  NULL,
  receiver_party_public_name               TINYTEXT                                NULL,
  transaction_completed_time               TIMESTAMP DEFAULT CURRENT_TIMESTAMP     NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  b2c_utility_account_available_funds      DOUBLE                                  NULL,
  b2c_working_account_available_funds      DOUBLE                                  NULL,
  result_description                       TINYTEXT                                NULL,
  response_code                            TINYTEXT                                NULL,
  result_code                              TINYTEXT                                NULL,
  updated_at                               TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  created_at                               TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  queue_timeout_url                        TINYTEXT                                NULL,
  debit_party_charges                      TINYTEXT                                NULL,
  debit_party_affected_account_balance     TINYTEXT                                NULL,
  debit_account_current_balance            TINYTEXT                                NULL,
  initiator_account_current_balance        TINYTEXT                                NULL
)
  ENGINE = InnoDB;

CREATE TABLE c2b
(
  transaction_type     TINYTEXT                                NULL,
  trans_id             TINYTEXT                                NULL,
  trans_time           TIMESTAMP DEFAULT CURRENT_TIMESTAMP     NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  trans_amount         INT                                     NULL,
  business_short_code  TINYTEXT                                NULL,
  bill_ref_number      TINYTEXT                                NULL,
  invoice_number       TINYTEXT                                NULL,
  third_party_trans_id TINYTEXT                                NULL,
  msisdn               TINYTEXT                                NULL,
  first_name           TINYTEXT                                NULL,
  middle_name          TINYTEXT                                NULL,
  last_name            TINYTEXT                                NULL,
  org_account_balance  DOUBLE                                  NULL,
  updated_at           TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  created_at           TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  id                   INT                                     NULL
)
  ENGINE = InnoDB;

CREATE TABLE migrations
(
  id        INT UNSIGNED AUTO_INCREMENT
    PRIMARY KEY,
  migration VARCHAR(255) NOT NULL,
  batch     INT          NOT NULL
)
  ENGINE = InnoDB
  COLLATE = utf8mb4_unicode_ci;

CREATE TABLE stk
(
  id                                  INT UNSIGNED                            NULL,
  created_at                          TIMESTAMP DEFAULT CURRENT_TIMESTAMP     NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  updated_at                          TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  merchant_request_id                 VARCHAR(150)                            NULL,
  checkout_request_id                 VARCHAR(150)                            NULL,
  response_code                       VARCHAR(150)                            NULL,
  result_desc                         VARCHAR(150)                            NULL,
  result_code                         VARCHAR(150)                            NULL,
  amount                              INT UNSIGNED                            NULL,
  mpesa_receipt_number                VARCHAR(150)                            NULL,
  balance                             INT UNSIGNED                            NULL,
  b2c_utility_account_available_funds INT UNSIGNED                            NULL,
  transaction_date                    TIMESTAMP DEFAULT '0000-00-00 00:00:00' NOT NULL,
  phone_number                        VARCHAR(150)                            NULL
)
  COMMENT 'Lipa na Mpesa STK Transactions Table'
  ENGINE = InnoDB;

CREATE TABLE users
(
  id             INT UNSIGNED AUTO_INCREMENT
    PRIMARY KEY,
  name           VARCHAR(255) NOT NULL,
  email          VARCHAR(255) NOT NULL,
  password       VARCHAR(255) NOT NULL,
  remember_token VARCHAR(100) NULL,
  created_at     TIMESTAMP    NULL,
  updated_at     TIMESTAMP    NULL
)
  ENGINE = InnoDB
  COLLATE = utf8mb4_unicode_ci;



CREATE TABLE users (
  user_id   INT AUTO_INCREMENT PRIMARY KEY,
  full_name     VARCHAR(50)  NOT NULL,
  username      VARCHAR(50)  NOT NULL UNIQUE,
  email         VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  date_of_birth DATE NOT NULL,
    CONSTRAINT chk_dob_limits CHECK (
        date_of_birth >= '1900-01-01' 
        AND date_of_birth <= CURRENT_DATE - INTERVAL '13 years'
    )
  is_active     BOOLEAN DEFAULT TRUE,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
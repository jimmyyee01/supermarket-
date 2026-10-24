CREATE TABLE IF NOT EXISTS payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supermarket_id INT NOT NULL,
    code VARCHAR(40) NOT NULL,
    name VARCHAR(100) NOT NULL,
    type ENUM('cash','card','mobile','gateway','transfer','other') DEFAULT 'other',
    gateway VARCHAR(40) NULL,
    is_enabled TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (supermarket_id) REFERENCES supermarkets(id) ON DELETE CASCADE,
    UNIQUE KEY uq_pm (supermarket_id, code)
);

INSERT IGNORE INTO payment_methods (supermarket_id,code,name,type) VALUES
(1,'cash','Cash','cash'),
(1,'card','Card (Visa/Mastercard)','card'),
(1,'mobile_mtn','MTN Mobile Money','mobile'),
(1,'mobile_airtel','Airtel Money','mobile'),
(1,'stripe','Stripe','gateway'),
(1,'bank_transfer','Bank Transfer','transfer');

-- Use a specific database
USE mytb;

-- Drop tables if they exist
DROP TABLE IF EXISTS redemption;
DROP TABLE IF EXISTS voucher;
DROP TABLE IF EXISTS post;
DROP TABLE IF EXISTS tb_user;
DROP TABLE IF EXISTS tb_user_role;

-- Create tb_user_role table
CREATE TABLE tb_user_role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_role VARCHAR(20)
);

INSERT INTO tb_user_role VALUES (1, 'admin');
INSERT INTO tb_user_role VALUES (2, 'user');

-- Create tb_user table
CREATE TABLE tb_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_role_id INT DEFAULT 2,
    username VARCHAR(20) UNIQUE, -- Ensure a UNIQUE index on username
    phone_num BIGINT(20),
    email VARCHAR(50),
    password VARCHAR(50),
    confirm_password VARCHAR(50),
    points INT DEFAULT 0,
    FOREIGN KEY (user_role_id) REFERENCES tb_user_role(id)
);


INSERT INTO tb_user VALUES (NULL, 1, 'admin1', 0123456789, 'admin1@gmail.com', '123456', '123456', 0);
INSERT INTO tb_user VALUES (NULL, 2, 'user1', 0123456789, 'user1@gmail.com', '123456', '123456', 5000);
INSERT INTO tb_user VALUES (NULL, 2, 'user2', 0123456789, 'user2@gmail.com', '123456', '123456', 0);

-- Create post table
CREATE TABLE post (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20),
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(50),
    content VARCHAR(150), -- Corrected data type here
    upvote INT DEFAULT 0,
    downvote INT DEFAULT 0,
    FOREIGN KEY (username) REFERENCES tb_user(username)
);


-- Create voucher table
CREATE TABLE voucher (
    id INT AUTO_INCREMENT PRIMARY KEY,
    voucher_code VARCHAR(20),
    points INT,
    INDEX idx_voucher (voucher_code, points) -- Add an index on the referenced columns
);


INSERT INTO voucher VALUES (1, '$5.00OFF', 500);
INSERT INTO voucher VALUES (2, '$10.00OFF', 1000);
INSERT INTO voucher VALUES (3, '$15.00OFF', 1500);
INSERT INTO voucher VALUES (4, '$20.00OFF', 2000);

-- Create redemption table
CREATE TABLE redemption (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20),
    used_points INT,
    voucher_code VARCHAR(20),
    redemption_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (username) REFERENCES tb_user(username),
    FOREIGN KEY (voucher_code, used_points) REFERENCES voucher(voucher_code, points)
);


-- Add foreign key constraint between redemption and voucher
ALTER TABLE redemption
ADD CONSTRAINT fk_voucher
FOREIGN KEY (voucher_code, used_points)
REFERENCES voucher(voucher_code, points);

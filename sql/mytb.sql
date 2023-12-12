-- Use a specific database
USE mytb;

-- Drop tables if they exist
DROP TABLE IF EXISTS redemption;
DROP TABLE IF EXISTS reward;
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
    username VARCHAR(20) UNIQUE,
    phone_num VARCHAR(20),
    email VARCHAR(50),
    password VARCHAR(50),
    confirm_password VARCHAR(50),
    points INT DEFAULT 0,
    FOREIGN KEY (user_role_id) REFERENCES tb_user_role(id)
);

INSERT INTO tb_user VALUES (NULL, 1, 'admin1', '0123456789', 'admin1@gmail.com', '123456', '123456', 0);
INSERT INTO tb_user VALUES (NULL, 2, 'user1', '0123456789', 'user1@gmail.com', '123456', '123456', 5000);
INSERT INTO tb_user VALUES (NULL, 2, 'user2', '0123456789', 'user2@gmail.com', '123456', '123456', 0);

-- Create post table
CREATE TABLE post (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20),
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(50),
    content TEXT,
    upvote INT DEFAULT 0,
    downvote INT DEFAULT 0,
    FOREIGN KEY (username) REFERENCES tb_user(username)
);

INSERT INTO post (username, date, title, content, upvote, downvote)VALUES ('admin1', CURRENT_TIMESTAMP, 'Notice', 'Hi, welcome to SEF!', 0, 0);

CREATE TABLE reward (
    id INT AUTO_INCREMENT,
    reward_code VARCHAR(20),
    points INT,
    PRIMARY KEY (id, reward_code),
    INDEX idx_reward (reward_code, points)
);


INSERT INTO reward VALUES (1, '$5.00OFF', 500);
INSERT INTO reward VALUES (2, '$10.00OFF', 1000);
INSERT INTO reward VALUES (3, '$15.00OFF', 1500);
INSERT INTO reward VALUES (4, '$20.00OFF', 2000);

-- Create redemption table
CREATE TABLE redemption (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(20),
    used_points INT,
    reward_id INT,
    reward_code VARCHAR(20),
    redemption_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (username) REFERENCES tb_user(username) ON DELETE SET NULL,
    FOREIGN KEY (reward_id, reward_code) REFERENCES reward(id, reward_code)
    
);

INSERT INTO redemption (username, used_points, reward_id, reward_code)
SELECT 'admin1', 1000, reward.id, reward.reward_code
FROM reward
WHERE reward.id = 2;

INSERT INTO redemption (username, used_points, reward_id, reward_code)
SELECT 'admin1', 2000, reward.id, reward.reward_code
FROM reward
WHERE reward.id = 4;

INSERT INTO redemption (username, used_points, reward_id, reward_code)
SELECT 'admin1', 1500, reward.id, reward.reward_code
FROM reward
WHERE reward.id = 3;

INSERT INTO redemption (username, used_points, reward_id, reward_code)
SELECT 'admin1', 500, reward.id, reward.reward_code
FROM reward
WHERE reward.id = 1;

INSERT INTO redemption (username, used_points, reward_id, reward_code)
SELECT 'admin1', 500, reward.id, reward.reward_code
FROM reward
WHERE reward.id = 1;

INSERT INTO redemption (username, used_points, reward_id, reward_code)
SELECT 'user1', 500, reward.id, reward.reward_code
FROM reward
WHERE reward.id = 1;

INSERT INTO redemption (username, used_points, reward_id, reward_code)
SELECT 'user2', 500, reward.id, reward.reward_code
FROM reward
WHERE reward.id = 1;


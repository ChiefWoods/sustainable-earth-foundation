DROP DATABASE IF EXISTS sef;

CREATE DATABASE sef;

CREATE TABLE sef.User (
  user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(64) NOT NULL UNIQUE,
  email VARCHAR(64) NOT NULL UNIQUE,
  phone_number VARCHAR(32),
  password VARCHAR(255) NOT NULL,
  profile_picture TEXT,
  user_points INT,
  is_admin TINYINT(1) NOT NULL
);

CREATE TABLE sef.Post (
  post_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL REFERENCES User(user_id),
  title VARCHAR(128) NOT NULL,
  post_text TEXT NOT NULL,
  date_posted DATE NOT NULL,
  upvotes INT NOT NULL DEFAULT 0,
  downvotes INT NOT NULL DEFAULT 0
);

CREATE TABLE sef.Reward (
  reward_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  reward_name VARCHAR(64) NOT NULL UNIQUE,
  reward_points INT NOT NULL
);

CREATE TABLE sef.Redemption (
  redemption_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL REFERENCES User(user_id),
  reward_id INT NOT NULL REFERENCES Reward(reward_id),
  redemption_code VARCHAR(32) NOT NULL UNIQUE,
  date_redeemed DATE NOT NULL
);

CREATE TABLE sef.Notification (
  notification_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL REFERENCES User(user_id),
  category VARCHAR(32) NOT NULL,
  content TEXT NOT NULL
);

CREATE TABLE sef.Upvote (
  upvote_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL REFERENCES User(user_id),
  post_id INT NOT NULL REFERENCES Post(post_id),
  UNIQUE (user_id, post_id)
);

CREATE TABLE sef.Downvote (
  downvote_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL REFERENCES User(user_id),
  post_id INT NOT NULL REFERENCES Post(post_id),
  UNIQUE (user_id, post_id)
);
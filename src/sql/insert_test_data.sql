INSERT INTO sef.User (user_id, username, email, phone_number, password, profile_picture, user_points, is_admin)
VALUES
(1, 'ryan', 'ryan@gmail.com', '0123456789', 'ryan1111', '../../assets/images/default_profile_picture.png', 0, 1),
(2, 'dan', 'dan@gmail.com', '', 'dan0000', '../../assets/images/default_profile_picture.png', 0, 1),
(3, 'bob', 'bob@gmail.com', '0123456789', 'bob1234', '../../assets/images/default_profile_picture.png', 9000, 0),
(4, 'jack', 'jack@gmail.com', '', 'jack1234', '../../assets/images/default_profile_picture.png', 5000, 0);

INSERT INTO sef.Post (user_id, title, post_text, date_posted)
VALUES
(3, 'title1', 'content1', '2023-12-7'),
(4, 'title2', 'content2', '2023-12-9'),
(3, 'title3', 'content3', '2023-12-10');

INSERT INTO sef.Reward (reward_name, reward_points)
VALUES
('$5.00 OFF', 500),
('$10.00 OFF', 900),
('$15.00 OFF', 1300),
('$20.00 OFF', 1500);

INSERT INTO sef.Redemption (user_id, reward_id, redemption_code, date_redeemed)
VALUES
(3, 1, 'JKL5623', '2023-12-8'),
(4, 2, 'BWB1845', '2023-12-11');

INSERT INTO sef.Notification (user_id, category, content)
VALUES
(3, 'upvote', 'Your post Post A received an upvote.'),
(3, 'reward', '$5.00 OFF redeemed using 500 points.'),
(3, 'points', 'You have collected enough points to redeem $10.00 OFF.');

INSERT INTO sef.Upvote (user_id, post_id)
VALUES
(3, 2),
(4, 1);

INSERT INTO sef.Downvote (user_id, post_id)
VALUES
(4, 3);

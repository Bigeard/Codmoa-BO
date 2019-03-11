CREATE TABLE table_users (
	user_id SERIAL PRIMARY KEY,
    user_firstname VARCHAR(255),
    user_lastname VARCHAR(255),
    user_email VARCHAR(255),
    user_password VARCHAR(255),
    user_image VARCHAR(255) DEFAULT './img/users_img/img_default.svg',
	user_hierarchy VARCHAR(20) DEFAULT 'read'
);

INSERT INTO table_users
(user_firstname, user_lastname, user_email, user_password)
VALUES ('Robin', 'Bigeard', 'robin.bigeard@gmail.com', md5('nuggets');

INSERT INTO table_users
(user_firstname, user_lastname, user_email, user_password)
VALUES ('admin', 'admin', 'admin@admin.com', md5('nuggets');

SELECT * FROM table_users;

UPDATE table_users
SET user_hierarchy = 'read'
WHERE user_lastname = 'Bigeard'; 

UPDATE table_users
SET user_hierarchy = 'write'
WHERE user_lastname = 'Bigeard'; 

UPDATE table_users
SET user_hierarchy = 'admin'
WHERE user_lastname = 'Bigeard'; 
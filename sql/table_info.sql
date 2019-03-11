CREATE TABLE table_info (
	info_id SERIAL PRIMARY KEY,
	info_autor INT NOT NULL REFERENCES table_users(user_id),
	info_title VARCHAR(255),
	info_subtitle VARCHAR(255),
	info_text TEXT
);

INSERT INTO table_info (info_autor, info_title, info_subtitle, info_text) 
VALUES (92, 'Cassandra Crossing, The', 'nulla justo aliquam', 'Vestibulum ac est lacinia nisi venenatis tristique. Fusce congue, diam id ornare imperdiet.');

SELECT * FROM table_info;

;Encrypt=true
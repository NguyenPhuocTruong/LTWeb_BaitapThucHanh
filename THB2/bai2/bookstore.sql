CREATE TABLE bookstore.books (
    book_id INT auto_increment PRIMARY KEY,
    title VARCHAR(200) NOT NULL collate 'utf8_general_ci',
    introduction VARCHAR(1000) collate 'utf8_bin'
);

CREATE Table bookstore.images (
    image_id INT auto_increment PRIMARY KEY,
    book_id INT,
    filename VARCHAR(200) NOT NULL,
    mime_type VARCHAR(50) NOT NULL,
    file_size INT NOT NULL,
    image_data mediumblob NOT NULL,
    Foreign Key (book_id) REFERENCES bookstore.books(book_id) on delete CASCADE
);
CREATE TABLE thb3.members (
    email VARCHAR(100) PRIMARY KEY,
    hoten VARCHAR(50) NOT NULL collate 'utf8mb4_unicode_ci',
    matkhau VARCHAR(255) NOT NULL collate 'utf8mb4_unicode_ci',
    namsinh INT NOT NULL,
    gioitinh VARCHAR(5) NOT NULL
)
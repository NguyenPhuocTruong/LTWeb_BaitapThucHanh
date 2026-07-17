CREATE TABLE sinhvien.sinhvien (
    stt INT auto_increment PRIMARY KEY,
    mssv VARCHAR(10),
    hoten VARCHAR(50) NOT NULL collate 'utf8mb4_unicode_ci'
)
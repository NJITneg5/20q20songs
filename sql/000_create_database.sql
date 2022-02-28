CREATE DATABASE testdb;
CREATE USER 'testUser'@'localhost' IDENTIFIED BY '12345';
GRANT ALL PRIVILEGES ON testdb.* TO 'testUser'@'localhost';

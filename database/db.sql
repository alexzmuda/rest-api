CREATE TABLE conversions (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    status INT DEFAULT 0,
    pid BIGINT(20) DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=INNODB;

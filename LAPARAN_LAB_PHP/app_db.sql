CREATE DATABASE IF NOT EXISTS "app_db";
USE "app_db";
CREATE TABLE users (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    email varchar (100) NOT NULL,
    create_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY ("id"),
    UNIQUE KEY email ("email")
) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;
# DBを作成する
create database blog default character set utf8;

# postテーブルを作成する
CREATE TABLE `post` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR (40),
    `comment` VARCHAR(200),
    `created_at` DATETIME,
    PRIMARY KEY(id)
)ENGINE= INNODB;

# ユーザ作成
CREATE USER 'db_user'@'host_name' IDENTIFIED BY 'pass';

# 権限を与える
GRANT ALL PRIVILEGES ON `online_bbs`.post TO 'db_user'@'host_name';
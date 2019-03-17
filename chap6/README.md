## 一言掲示板を作る

昔ながらのbbs掲示板を作成します。
とってもレガシーPHPなので、決して真似しないで下さい。

### DB作成

まずはmysqlに入って`online_bbs`DBを作成する

```sql
create database online_bbs default character set utf8;
```

### テーブル作成

作るフィールド(カラム)

- id:投稿id
- name:投稿者の名前
- comment:コメント作成する
- created_at:作成日

```sql
CREATE TABLE `post` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `name` VARCHAR (40),
  `comment` VARCHAR(200),
  `created_at` DATETIME,
  PRIMARY KEY(id)
)ENGINE= INNODB; 
```

### ユーザを作成してtableへのアクセス権限を与える

```sql
// ユーザ作成
CREATE USER 'db_user'@'host_name' IDENTIFIED BY 'pass';

//権限を
GRANT ALL PRIVILEGES ON `online_bbs`.post TO 'db_user'@'host_name';
```
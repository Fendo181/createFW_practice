### mini_blogデータベース用のテーブル

### DBを作成する

```sql
create database mini_blog default character set utf8;
```

#### Userテーブル

```sql
CREATE TABLE user(
  id INTEGER AUTO_INCREMENT,
  user_name VARCHAR(20) NOT NULL,
  password VARCHAR(40) NOT NULL,
  created_at DATETIME,
  PRIMARY KEY (id),
  UNIQUE KEY user_name_index(user_name);
)ENGINE = INNODB;
```

### Following

```sql
CREATE TABLE following(
  user_id INTEGER ,
  following_id INTEGER,
  PRIMARY KEY (user_id,following_id),
)ENGINE = INNODB;
```


### Status

```sql
CREATE TABLE status(
  id INTEGER AUTO_INCREMENT,
  user_id INTEGER NOT NULL,
  body VARCHAR(255),
  created_at DATETIME,
  PRIMARY KEY(id),
  INDEX user_id_index(user_id),
)ENGINE = INNODB;
```



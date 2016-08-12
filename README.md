# 英単語プレテスト

英単語を様々なアプローチで暗記することができます

## 想定するPHPバージョン

Version 5.6 の実行環境を想定して開発しています

## Composerのバージョン 及び 実行方法

Composer Version 1.1.3 で

- Twig (テンプレートエンジン)

を管理しています。

このリポジトリのルートディレクトリに composer.phar を設置し、

**php composer.phar update**

でライブラリのアップデートを行います。

## LESS

npmでインストールした Less Compiler [JavaScript] 2.7.1 を使用しています

## jQuery

jQuery 3.1.0 (Compressed) 本体を``views``フォルダに保存して使用しています

## DDL (for MySQL)

```sql
-- Crate database
CREATE DATABASE 任意のDB名  DEFAULT CHARACTER SET utf8;
  
-- Change database
use 作成したDB名
  
-- Create tables
CREATE TABLE words (  
  id int(11) NOT NULL AUTO_INCREMENT,  
  class text,  
  front text,  
  back text,  
  PRIMARY KEY (id)  
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
  
CREATE TABLE ranking_category (  
  id int(11) NOT NULL AUTO_INCREMENT,  
  name text NOT NULL UNIQUE,  
  first int(11) NOT NULL DEFAULT '1',  
  last int(11) NOT NULL DEFAULT '1300',  
  quantity int(11),  
  start datetime,  
  end datetime,  
  PRIMARY KEY (id)  
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
  
CREATE TABLE ranking (  
  id int(11) NOT NULL AUTO_INCREMENT,  
  nickname text NOT NULL DEFAULT '名無しさん',  
  score int(11) NOT NULL DEFAULT '0',  
  category int(11) NOT NULL,  
  PRIMARY KEY (id)  
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8

```

## アプリケーションの実行方法

`config-secret.php`をプロジェクトルートに作成し以下の3つの定数を定義し、利用しているデータベースの情報を指定してください。

- PDO_DSN(DSN)
- DB_USERNAME(DBユーザ名)
- DB_PASSWORD(DBパスワード)

例えば上記の **DDL (for MySQL)** で、DB名を`ep`という名前で作成し、DBユーザ名が`db-user`、パスワードは`db-password`の場合、`config-secret.php`は以下の3行になります。

```php
<?php
define("PDO_DSN", "mysql:dbname=ep;host=127.0.0.1");
define("DB_USERNAME", "db-user");
define("DB_PASSWORD", "db-password");
```

次に、コマンドラインでプロジェクト内の`views`フォルダをカレントディレクトリに設定し  
以下のコンパイルコマンドを用いて`.less`ファイルを`.css`ファイルに変換してください。

```text
lessc less/top.less css/top.css
lessc less/pretest.less css/pretest.css
```

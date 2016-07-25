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

## DDL

CREATE TABLE **words** (  
  **id** int(11) NOT NULL AUTO_INCREMENT,  
  **class** text,  
  **front** text,  
  **back** text,  
  PRIMARY KEY (**id**)  
) ENGINE=InnoDB AUTO_INCREMENT=1201 DEFAULT CHARSET=utf8

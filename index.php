<?php
namespace Pretest;

/**
 * index.php
 * .htaccessのmod_rewrite機能によってURLが書き換えられ、いつもこのファイルが最初に読み込まれる。
 * 定数を定義しているphpファイル2つ(片方はセキュリティー上の理由でgit管理対象外)とオートロードを設定しているphpファイルを読み込み、
 * ディスパッチャを呼び出している。
 */

session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/config-secret.php';
require_once __DIR__ . '/vendor/autoload.php';

$dispatcher = new Dispatcher();
$dispatcher->dispatch();

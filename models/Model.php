<?php
namespace Pretest\Models;

/**
 * Model 抽象クラス
 * コンストラクタでデータベースとの接続処理を実装する
 * @access public
 * @author 0918nobita
 * @package Pretest\Models
 */
abstract class Model
{
    protected $db; // PDOインスタンスが代入される
    /**
     * データベースに接続しPDOインスタンスを生成する
     */
    public function __construct() {
        try {
            $this->db = new \PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}

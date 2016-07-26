<?php
namespace Pretest\Models;

/**
 * PretestModel クラス
 * プレテスト画面で使用する英単語データをデータベースから取得し連想配列に整形してPretestControllerに返す
 * @access public
 * @author 0918nobita
 * @package Pretest\Models
 * @todo データベースから英単語一覧を取得するメソッドが実装できていない
 */
class PretestModel extends Model
{
    public $max;

    public function __construct()
    {
        parent::__construct();
        $stmt = $this->db->query("SELECT MAX(id) as id_max FROM words");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $this->max = $result["id_max"];
    }
}

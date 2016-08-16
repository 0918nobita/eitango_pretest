<?php
namespace Pretest\Models;

class ReviewModel extends Model
{
    public function getSelectedWords($array) {
        if (count($array) == 0) return array();
        try {
            $inClause = substr(str_repeat(',?', count($array)), 1);
            $stmt = $this->db->prepare(sprintf('SELECT * FROM words WHERE id in (%s)', $inClause));
            $stmt->execute($array);
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }
}

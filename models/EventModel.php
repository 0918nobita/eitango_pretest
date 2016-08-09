<?php
namespace Pretest\Models;

class EventModel extends Model
{
    public function getEvents()
    {
        try {
            $stmt = $this->db->query('SELECT * FROM ranking_category');
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $present = array();
            $future = array();
            $past = array();
            date_default_timezone_set('Asia/Tokyo');
            $now = new \DateTime();
            for ($i = 0; $i < count($result); $i++) {
                $start = \DateTime::createFromFormat('Y-m-d H:i:s', $result[$i]["start"]);
                $end = \DateTime::createFromFormat('Y-m-d H:i:s', $result[$i]["end"]);
                if ($now >= $start && $now <= $end) {
                    array_push($present, $result[$i]);
                } elseif ($now < $start) {
                    array_push($future, $result[$i]);
                } else {
                    array_push($past, $result[$i]);
                }
            }
        } catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return array($present, $future, $past);
    }
}

<?php
namespace Pretest\Models;

class EventModel extends Model
{
    public function getEventInfo($id)
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM ranking_category WHERE id = :id');
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if (count($result) == 0) header('Location: ./?controller=error');
            $name = $result[0]['name'];
            $first = $result[0]['first'];
            $last = $result[0]['last'];
            $quantity = $result[0]['quantity'];
            $start = $result[0]['start'];
            $end = $result[0]['end'];
            date_default_timezone_set('Asia/Tokyo');
            $now = new \DateTime();
            $startDate = \DateTime::createFromFormat('Y-m-d H:i:s', $result[0]['start']);
            $endDate = \DateTime::createFromFormat('Y-m-d H:i:s', $result[0]['end']);
            if ($now >= $startDate && $now <= $endDate) {
                $held = 'present';
            } elseif ($now < $startDate) {
                $held = 'future';
            } else {
                $held = 'past';
            }
        } catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return array($name, $first, $last, $quantity, $start, $end, $held);
    }

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

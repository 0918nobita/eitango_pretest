<?php
namespace Pretest\Models;

/**
 * -----注釈-----
 * 「イベント情報」 … イベントの「識別番号」「名前」「開始日時」「終了日時」、出題する問題の「範囲」「個数」
 * 「ランキング情報」 … ランキングテーブルの各レコードの、連番で振られる「ID」、「ニックネーム」「スコア」
 */

/**
 * EventModel クラス
 * 各コントローラから要求されたイベント情報を返し、
 * 各イベントのランキングの更新処理も担当する。
 * @author 0918nobita
 * @package Pretest\Models
 */

class EventModel extends Model
{
    /**
     * 識別番号で指定されたイベントについての情報を返す。
     * @param int $id イベント識別番号
     * @return array イベント情報をまとめた配列
     */
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

            // 「現在開催中」「今後開催予定」「過去に開催」のどれにあたるのか、DateTime型データ(現在とイベントの開始/終了日時)の比較で調べている
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
        return array($id, $name, $first, $last, $quantity, $start, $end, $held);
    }

    /**
     * すべてのイベントの情報を「現在開催中」、「今後開催予定」、「過去に開催」に分けて返す。
     * @return array
     */
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

    /**
     * ランキングにプレテスト結果を掲載する
     * @param string $nickname ニックネーム
     * @param int $score スコア
     * @param int $category イベント識別番号
     * @return void
     */
    public function rank($nickname, $score, $category)
    {
        try {
            // 同じイベントで同じニックネームが使われているか調べ、使われていたらスコアを高い方に更新する
            $stmt = $this->db->prepare('SELECT count(*) as count, score, category FROM ranking WHERE nickname = :nickname');
            $stmt->bindValue(':nickname', $nickname, \PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if (($result[0]['category'] == $category) && ($result[0]["count"] >= 1)) {
                $previousScore = $result[0]["score"];
                if ($score > $previousScore) {
                    $stmt = $this->db->prepare('UPDATE ranking SET score = :score WHERE nickname = :nickname');
                    $stmt->bindValue(':nickname', $nickname, \PDO::PARAM_STR);
                    $stmt->bindValue(':score', $score, \PDO::PARAM_INT);
                    $stmt->execute();
                }
            } else { // そうでなければ新規に掲載する
                $stmt = $this->db->prepare('INSERT INTO ranking(nickname, score, category) VALUES(:nickname, :score, :category)');
                $stmt->bindValue(":nickname", $nickname, \PDO::PARAM_STR);
                $stmt->bindValue(":score", $score, \PDO::PARAM_INT);
                $stmt->bindValue(":category", $category, \PDO::PARAM_INT);
                $stmt->execute();
            }
        } catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    /**
     * 識別番号で指定されたイベントのランキング情報を返す。
     * @param int $category ランキングを取得するイベントの識別番号
     * @return array ランキング情報
     */
    public function raking($category)
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM ranking WHERE category = :category ORDER BY score DESC');
            $stmt->bindValue(':category', $category, \PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
        return $result;
    }
}

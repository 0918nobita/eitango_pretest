<?php
namespace Pretest\Models;

class Session
{
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return $_SESSION[$key];
    }

    public static function destroy() {
        session_destroy();
    }

    public function deleteIncorrectProblems() {
        for ($i = 0;$i < count($_POST['incorrect']); $i++) {
        }
    }

    public function deleteSelectedProblems() {
    }

    public function saveIncorrectProblems() {
        $this->set('incorrect', array_values(array_unique(array_merge(
            json_decode($_POST['incorrect']),
            (isset($_SESSION['incorrect'])) ? $_SESSION['incorrect'] : array()
        ))));
    }

    public function saveSelectedProblems() {
        $this->set('selected', array_values(array_unique(array_merge(
            json_decode($_POST['selected']),
            (isset($_SESSION['selected'])) ? $_SESSION['selected'] : array()
        ))));
    }
}

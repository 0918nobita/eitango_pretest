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

    public function saveIncorrectProblems() {
        $this->set("incorrect", array_merge($_SESSION['incorrect'], json_decode($_POST["incorrect"])));
    }

    public function saveSelectedProblems() {
        $this->set("selected", array_merge($_SESSION['selected'], json_decode($_POST["selected"])));
    }
}

<?php
namespace Pretest\Controllers;

/**
 * Controller 抽象クラス
 * テンプレートエンジンTwigのインスタンスをコンストラクタで生成しておき、
 * displayメソッドでテンプレートファイルへ埋め込むデータを指定し出力する。
 * @author 0918nobita
 * @package Pretest\Controllers
 */

abstract class Controller
{
    protected $model; // モデルクラス(またはそれを継承したクラス)のインスタンスが代入される
    protected $view; // テンプレートファイルの名前
    protected $stylesheetPath = 'top.css'; // スタイルシートファイルの名前
    protected $twig; // Twigインスタンスが代入される
    protected $data = array(); // テンプレートファイルに埋め込むデータ

    /**
     * Twigのインスタンスを生成しtwigフィールドに代入する。
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
        $this->twig = new \Twig_Environment($loader);
    }

    /**
     * デフォルトでディスパッチャに呼び出される出力アクションを示すメソッド。
     * コンストラクタで生成したTwigのインスタンスに対してテンプレートについての設定を行い、
     * 実際に出力する。
     */
    public function display()
    {
        $template = $this->twig->loadTemplate('base.html.twig');
        $this->assign(array(
            'title' => SITE_NAME,
            'site_description' => SITE_DESCRIPTION,
            'content' => $this->view,
            'stylesheet_file_path' => './views/css/' . $this->stylesheetPath
        ));
        echo $template->render($this->data);
    }

    /**
     * テンプレートファイルに埋め込むデータを追加で指定するメソッド。
     * このクラスのdisplayメソッドを呼び出す前なら何度でも呼び出して追加できる。
     */
    public function assign($array) {
        $this->data = array_merge($this->data, $array);
    }
}

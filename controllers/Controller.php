<?php
namespace Pretest\Controllers;

/**
 * Controller 抽象クラス
 * テンプレートエンジンTwigのインスタンスをコンストラクタで生成しておき、
 * displayメソッドでテンプレートファイルへ埋め込むデータを指定し出力する。
 * @access public
 * @author 0918nobita
 * @package Pretest\Controllers
 * @todo スタイルシートファイルの管理方法が定まっていない。
 */
abstract class Controller
{
    protected $model; // モデルクラスのインスタンスが代入される
    protected $view; // テンプレートファイルの名前
    protected $stylesheetPath; // スタイルシートファイルのパス
    protected $twig; // Twigインスタンスが代入される

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
        $data = array(
            'title' => SITE_NAME,
            'site_description' => SITE_DESCRIPTION,
            'content' => $this->view,
            'stylesheet_file_path' => $this->stylesheetPath
        );
        echo $template->render($data);
    }
}

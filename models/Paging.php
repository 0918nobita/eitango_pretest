<?php
namespace Pretest\Models;

/**
 * Paging クラス(トレイト)
 * ページング処理を担当するクラス。
 * @author 0918nobita
 * @package Pretest\Models
 */

trait Paging
{
    private $page; // 現在のページ
    private $offset; // 表示するページの先頭に来るデータのインデックス
    private $total; // 総件数
    private $totalPages; // ページ数の合計
    private $itemsPerPage; // 1ページに表示する件数

    /**
     * ページリンクのHTML文字列を返す。
     * @param $page int 現在のページ
     * @param $total int 総件数
     * @param $itemsPerPage int 1ページに表示する件数
     * @return string ページリンクのHTML文字列
     */
    public function addPageLink($page, $total, $itemsPerPage)
    {
        $this->total = $total;
        $this->itemsPerPage = $itemsPerPage;
        $this->totalPages = ceil($this->total / $this->itemsPerPage);

        if (ctype_digit($page)) {
            $this->page = (int) $page;
        } else if ($page > $this->totalPages) {
            $this->page = 1;
        } else {
            $this->page = 1;
        }
        $this->offset = $this->itemsPerPage * ($this->page - 1);
        $html = "<p>";
        for ($i = 1; $i <= $this->totalPages; $i++) {
            if ($this->page == $i) {
                $html .= "<strong>${i}</strong> ";
            } else {
                $html .= "<a href='" . Url::getUrlQuery(array('page' => $i)) . "'>${i}</a> ";
            }
        }
        $html .= "</p>";
        return $html;
    }

    /**
     * 現在のページに表示する先頭のデータのインデックスを返す。
     * @return int インデックス
     */
    public function getFrom() {
        return $this->offset;
    }

    /**
     * 現在のページに表示する最後のデータのインデックスを返す。
     * @return int インデックス
     */
    public function getTo() {
        return ($this->offset + $this->itemsPerPage) < $this->total ? ($this->offset + $this->itemsPerPage) : $this->total;
    }
}

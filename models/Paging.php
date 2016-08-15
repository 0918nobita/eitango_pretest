<?php
namespace Pretest\Models;

trait Paging
{
    private $page;
    private $offset;
    private $total;
    private $totalPages;
    private $commentsPerPage;

    public function addPageLink($page, $total, $commentsPerPage)
    {
        $this->total = $total;
        $this->commentsPerPage = $commentsPerPage;
        $this->totalPages = ceil($this->total / $this->commentsPerPage);

        if (ctype_digit($page)) {
            $this->page = (int) $page;
        } else if ($page > $this->totalPages) {
            $this->page = 1;
        } else {
            $this->page = 1;
        }
        $this->offset = $this->commentsPerPage * ($this->page - 1);
        $html = "<p>";
        for ($i = 1; $i <= $this->totalPages; $i++) {
            if ($this->page == $i) {
                $html .= "<strong>${i}</strong> ";
            } else {
                $html .= "<a href='?page=${i}'>${i}</a>";
            }
        }
        $html .= "</p>";
        return $html;
    }
}

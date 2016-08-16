<?php
namespace Pretest\Models;

trait Paging
{
    private $page;
    private $offset;
    private $total;
    private $totalPages;
    private $itemsPerPage;

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

    public function getFrom() {
        return $this->offset;
    }

    public function getTo() {
        return ($this->offset + $this->itemsPerPage) < $this->total ? ($this->offset + $this->itemsPerPage) : $this->total;
    }
}

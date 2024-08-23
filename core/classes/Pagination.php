<?php

class Pagination
{
    private $page = 1;
    private $per_page = 1;
    private $total = 1;
    private $count_pages = 1;
    private $current_page = 1;
    private $uri = '';
    private $mid_size = 2;
    private $all_pages = 10;

    public function __construct($page, $per_page, $total)
    {
        $this->page = $page;
        $this->per_page = $per_page;
        $this->total = $total;

        $this->count_pages = $this->getCountPages();
        $this->current_page = $this->getCurrentPage();
        $this->mid_size = $this->getMidSize();
        $this->uri = $this->getParams();
    }

    private function getCountPages()
    {
        return (int) ceil($this->total / $this->per_page) ?: 1;
    }

    private function getCurrentPage()
    {
        if ($this->page < 1) {
            $this->page = 1;
        }
        if ($this->page > $this->count_pages) {
            $this->page = $this->count_pages;
        }
        return $this->page;
    }

    public function getStart()
    {
        return ($this->current_page - 1) * $this->per_page;
    }

    private function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0];
        if (isset($url[1]) && $url[1] !== '') {
            $uri .= '?';
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!str_contains($param, 'page=')) {
                    $uri .= "{$param}&";
                }
            }
        }

        return $uri;
    }

    private function getLink($page)
    {
        if ($page == 1) {
            return rtrim($this->uri, "?&");
        }
 
        if (str_contains($this->uri, '&') || str_contains($this->uri, '?')) {
            return "{$this->uri}page={$page}";
        } else {
            return "{$this->uri}?page={$page}";
        }
    }

    private function getMidSize()
    {
        return $this->count_pages <= $this->all_pages ? $this->count_pages : $this->mid_size;
    }

    public function getHTML()
    {
        $back = '';
        $forward = '';
        $pages_left = '';
        $pages_right = '';

        if ($this->current_page > 1) {
            $back = "<li class = 'pagination__item'>
            <a href='" . $this->getLink($this->current_page - 1) . "' class='button pagination__back'>
            <svg width='25' height='16' viewBox='0 0 26 16' fill='none' xmlns='http://www.w3.org/2000/svg'>
            <path d='M25.707 8.70711C26.0975 8.31658 26.0975 7.68342 25.707 7.2929L19.343 0.928934C18.9525 0.538409 18.3193 0.538409 17.9288 0.928934C17.5383 1.31946 17.5383 1.95262 17.9288 2.34315L23.5857 8L17.9288 13.6569C17.5383 14.0474 17.5383 14.6805 17.9288 15.0711C18.3193 15.4616 18.9525 15.4616 19.343 15.0711L25.707 8.70711ZM-8.74228e-08 9L24.9999 9L24.9999 7L8.74228e-08 7L-8.74228e-08 9Z' />
            </svg>
            </a>
            </li>";
        }

        if ($this->current_page < $this->count_pages) {
            $forward = "<li class = 'pagination__item'>
            <a href='" . $this->getLink($this->current_page + 1) . "' class='button pagination__forward'>
            <svg width='25' height='16' viewBox='0 0 26 16' fill='none' xmlns='http://www.w3.org/2000/svg'>
            <path d='M25.707 8.70711C26.0975 8.31658 26.0975 7.68342 25.707 7.2929L19.343 0.928934C18.9525 0.538409 18.3193 0.538409 17.9288 0.928934C17.5383 1.31946 17.5383 1.95262 17.9288 2.34315L23.5857 8L17.9288 13.6569C17.5383 14.0474 17.5383 14.6805 17.9288 15.0711C18.3193 15.4616 18.9525 15.4616 19.343 15.0711L25.707 8.70711ZM-8.74228e-08 9L24.9999 9L24.9999 7L8.74228e-08 7L-8.74228e-08 9Z' />
            </svg>
            </a>
            </li>";
        }

        for ($i = $this->mid_size; $i > 0; $i--) {
            if ($this->current_page - $i > 0) {
                $pages_left .= "<li class='pagination__item'><a href='" .
                    $this->getLink($this->current_page - $i) . "' class='button pagination__link'>"
                    . ($this->current_page - $i) . "</a></li>";
            }
        }

        for ($i = 1; $i <= $this->mid_size; $i++) {
            if ($this->current_page + $i <= $this->count_pages) {
                $pages_right .= "<li class='pagination__item'><a href='" .
                    $this->getLink($this->current_page + $i) . "' class='button pagination__link'>"
                    . ($this->current_page + $i) . "</a></li>";
            }
        }

        return '<ul class="pagination">' . $back . $pages_left .
            '<li class="pagination__item"><a class="button pagination__link active">'
            . $this->current_page . '</a></li>' . $pages_right . $forward . '</ul>';
    }

    public function __toString()
    {
        return $this->getHTML();
    }

}
<?php

require_once CORE . '/classes/Pagination.php';

$newsModel = new News();

$page = $_GET['page'] ?? 1;
$per_page = 4;
$total = $newsModel->countRow();
$pagination = new Pagination((int) $page, $per_page, $total);
$start = $pagination->getStart();

$news = $newsModel->getNews($start, $per_page);
$latest_news = $newsModel->getLatestNews();

include VIEWS . '/news/news.index.tpl.php';

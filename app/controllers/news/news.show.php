<?php

$newsModel = new News();
$id = $_GET['article_id'] ?? 0;
$full_article = $newsModel->getArticle($id);
if (!$full_article) {
    abort(404);
}
include VIEWS . '/news/news.show.tpl.php';
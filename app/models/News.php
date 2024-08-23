<?php

require_once CORE . '/config/db.php';


class News
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance(
            DB_DRIVER,
            DB_HOST,
            DB_NAME,
            DB_USER,
            DB_PASS,
            DB_CHARSET,
            DB_OPTIONS
        )->getConnection();

    }

    private static function dbCheckError($query)
    {
        $errorInfo = $query->errorInfo();

        if ($errorInfo[0] !== PDO::ERR_NONE) {
            echo $errorInfo[2];
            exit();
        }
        return true;
    }

    public function countRow()
    {
        $count = 'SELECT COUNT(*) FROM news';
        $query = $this->database->prepare($count);
        $query->execute();
        News::dbCheckError($query);
        return $query->fetchColumn();
    }

    public function getNews($start, $per_page)
    {
        $select = "SELECT id, DATE_FORMAT(date, '%d.%m.%Y') as date_formatted, 
        title, announce FROM news ORDER BY date DESC LIMIT $start, $per_page";

        $query = $this->database->prepare($select);
        $query->execute();

        News::dbCheckError($query);

        return $query->fetchAll();

    }

    public function getArticle($id)
    {
        $select = "SELECT title, DATE_FORMAT(date, '%d.%m.%Y') as date_formatted,
        announce, content, image FROM news WHERE id = $id";

        $query = $this->database->prepare($select);
        $query->execute();

        News::dbCheckError($query);

        return $query->fetch();
    }

    public function getLatestNews()
    {
        $select = "SELECT title, announce, image FROM news ORDER BY date DESC";

        $query = $this->database->prepare($select);
        $query->execute();

        News::dbCheckError($query);

        return $query->fetch();

    }

}
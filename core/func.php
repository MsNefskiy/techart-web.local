<?php

function dump($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

function dd($value)
{
    dump($value);
    die();
}

function abort($code = 404)
{
    http_response_code($code);
    echo 'Page not found';
    die();
}

function goBack()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    } else {
        $previous = 'javascript:history.go(-1)';
    }
    echo $previous;
}

function addClassForParagraph($class, $html)
{
    $text = explode('<p>', $html);
    $result = "<p class = '$class'>" . $text[1];
    echo $result;
}
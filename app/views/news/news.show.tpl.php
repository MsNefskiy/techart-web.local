<?php

$title =  $full_article['title'];
ob_start()

    ?>
<div class="container">
    <hr />
    <nav class="breadcrumb">
        <ul class="breadcrumb__list">
            <li><a href="<?php goBack() ?>">Главная</a></li>
            <li class="breadcrumb__active"><a><?php echo $full_article['title'] ?></a></li>
        </ul>
    </nav>
    <h1 class="full-article__title"><?php echo $full_article['title'] ?></h1>
    <section class="full-article">
        <div class="full-article__content">
            <span class="article__data"> <?php echo $full_article['date_formatted'] ?> </span>
            <h2 class="full-article__announce">
                <?php echo $full_article['announce'] ?>
            </h2>
            <?php echo $full_article['content'] ?>
            <a href="<?php goBack() ?>" class="button full-article__button">
                <?php include(VIEWS . "/incs/arrow.php") ?>
                Назад к новостям
            </a>
        </div>
        <img src=" <?php echo 'assets/images/' . $full_article['image'] ?>" alt="<?php echo $full_article['title'] ?>"
            class="full-article__image" />
    </section>
</div>


<?php $content = ob_get_clean();
include VIEWS . '/layout.php';
?>
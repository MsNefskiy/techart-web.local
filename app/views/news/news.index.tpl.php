<?php

$title = 'Галактический вестник';
ob_start()

    ?>

<section class="hero" style="<?php echo 'background-image: url(/public/assets/images/' . $latest_news['image'] ?>">
    <div class="container">
        <div class="hero__inner">
            <h1 class="hero__title">
                <?php echo $latest_news['title'] ?>
            </h1>
            <?php
            addClassForParagraph('hero__announce', $latest_news['announce']);
            ?>
        </div>
    </div>
</section>

<section class="news">
    <div class="container">
        <h1 class="news__header">Новости</h1>
        <ul class="news__list">
            <?php foreach ($news as $full_article): ?>
                <li class="news__article">
                    <span class="article__data">
                        <?php echo $full_article['date_formatted'] ?>
                    </span>
                    <h2 class="article__title"><?php echo $full_article['title'] ?></h2>
                    <p class="article__announce">
                        <?php echo $full_article['announce'] ?>
                    </p>
                    <a href="<?php echo '/article?article_id=' . $full_article['id'] ?>"
                        class="button article__button">Подробнее
                        <?php include(VIEWS . "/incs/arrow.php") ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php echo $pagination ?>


    </div>
</section>


<?php $content = ob_get_clean();
include VIEWS . '/layout.php';
?>
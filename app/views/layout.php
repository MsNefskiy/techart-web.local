<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="/public/assets/css/main.css" />
    <link rel="icon" href="/public/assets/svg/galaxy.svg" />
</head>

<body>

    <?php include(VIEWS . "/incs/header.php") ?>

    <main class="main">
        <?php echo $content; ?>
    </main>

    <?php include(VIEWS . "/incs/footer.php") ?>

</body>

</html>
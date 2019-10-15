<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= $description ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title><?= $title ?></title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">TASKBOOK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=add">Add task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php foreach ($breadcrumbs as $breadcrumb): ?>
                <li class="breadcrumb-item"><a href="<?= $breadcrumb['url'] ?>"><?= $breadcrumb['title'] ?></a></li>
            <?php endforeach; ?>
        </ol>
    </nav>

    <?= $content ?>

</div>

<script src="js/bootstrap.min.js"></script>
</body>

</html>
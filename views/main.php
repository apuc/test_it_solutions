<?php
/**
 * @var string $title
 * @var array $users
 */
?>
<html>
<head>
    <title><?= $title ?></title>
    <link href="/public/css/bootstrap.css" rel="stylesheet">
    <script src="/public/js/bootstrap.js"></script>
    <script src="/public/js/main.js" type="module"></script>
</head>
<body>
<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="/public/transactions.svg" class="m-lg-1" width="30" height="30" alt="">
                <strong>User transactions</strong>
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main>

    <section class="py-5 text-center container">
        <div class="row">
            <div class="mb-4">
                <div class="form-group">
                    <select class="form-select" id="users" required="" data-ajax-url="/api" data-result-box="table-box">
                        <option value="">Загрузка ...</option>
                    </select>
                </div>
                <div id="table-box">

                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>

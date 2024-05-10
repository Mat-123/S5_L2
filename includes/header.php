<?php
include_once __DIR__ . '/dbconnect.php';
include_once __DIR__ . '/sitename.php';
include_once __DIR__ . '/constants.php';

$cookie_expiration = time() + 60 * 60 * 24 * 365 * 10;
if (isset($_GET['changetheme'])) {
    if (!isset($_COOKIE['theme'])) {
        setcookie('theme', 'light', $cookie_expiration);
    } else {
        setcookie('theme', $_COOKIE['theme'] === 'light' ? 'dark' : 'light', $cookie_expiration);
    }
    header("Location: $_SERVER[HTTP_REFERER]");
    exit;
}

if (!isset($_COOKIE['theme'])) {
    setcookie('theme', 'light', $cookie_expiration);
    $isLight = true;
} else {
    $isLight = $_COOKIE['theme'] === 'light' ? true : false;
}

if (!isset($_COOKIE['language'])) {
    setcookie('language', 'it', $cookie_expiration);
    $language = 'it';
} else {
    $language = $_COOKIE['language'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ansia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="assets/<?= $isLight ? 'style.light.css' : 'style.dark.css' ?>" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" <?= $isLight ? '' : 'data-bs-theme="dark"' ?>>
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= SITE_URL ?>"><?= $labels[$language]['site_name'] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= SITE_URL . '/writeanarticle.php' ?>"><?= $labels[$language]['link1'] ?></a>
                    </li>
                </ul>
                <a href="?changetheme" class="text-decoration-none text-reset">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-highlights me-3" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0m-8 5v1H4.5a.5.5 0 0 0-.093.009A7 7 0 0 1 3.1 13zm0-1H2.255a7 7 0 0 1-.581-1H8zm-6.71-2a7 7 0 0 1-.22-1H8v1zM1 8q0-.51.07-1H8v1zm.29-2q.155-.519.384-1H8v1zm.965-2q.377-.54.846-1H8v1zm2.137-2A6.97 6.97 0 0 1 8 1v1z" />
                    </svg>
                </a>
                <form action="<?= SITE_URL . '/change-language.php' ?>" method="get">
                    <select name="language">
                        <option value="it" <?= $language === 'it' ? ' selected' : '' ?>>IT</option>
                        <option value="en" <?= $language === 'en' ? ' selected' : '' ?>>EN</option>
                    </select>
                    <button class="btn <?= $isLight ? 'btn-success"' : 'btn-warning"' ?>><?= $labels[$language]['button'] ?></button>
                </form>
            </div>
    </nav>
    <div class=" container">
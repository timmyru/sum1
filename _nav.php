<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="index.php">Главная</a>
            <a class="nav-item nav-link pl-5" href="manager-login.php"><?= isset($_SESSION['manager.login']) ? 'Список заявок для менеджеров' : 'Вход для менеджеров'; ?></a>
            <a class="nav-item nav-link pl-5" href="admin-login.php"><?= isset($_SESSION['login']) ? 'Админка' : 'Вход для администраторов'; ?></a>
        </div>
    </div>
</nav>
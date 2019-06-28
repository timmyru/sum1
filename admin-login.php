<?php
/**
 * @var $connection PDO
 */

session_start();
if (isset($_SESSION['login'])) {
    header('Location: admin.php');
}

$title = 'Вход в админку';
require_once '_header.php';
require_once '_nav.php';
?>

<div class="container">
    <?php
    if (isset($_SESSION['error'])) :
        ?>
        <div class="mt-3 alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['error']);
    endif;
    ?>
    <h2 class="mt-5 mb-5">Вход для администраторов</h2>
    <div class="row">
        <div class="col-md-6">
            <form class="request-form" method="post" action="admin.php">
                <div class="form-group">
                    <label for="login">Логин</label>
                    <input type="text" class="form-control" name="login" id="login" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Войти">
            </form>
        </div>
    </div>
</div>

<?php
require_once '_footer.php';
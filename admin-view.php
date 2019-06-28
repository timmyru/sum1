<?php
/**
 * @var $connection PDO
 */

session_start();
if (!isset($_SESSION['login']) || !isset($_SESSION['password']) || $_SESSION['login'] != 'admin') {
    header('Location: admin-login.php');
}

if (!isset($_GET['id'])) {
    header('Location: admin.php');
}

$title = 'Просмотр заявки №' . $_GET['id'];
require_once '_header.php';
require_once '_nav.php';

$id = $_GET['id'];
$request = $connection->query("SELECT * FROM request WHERE id='$id'")->fetch();

?>

<div class="container">
    <h2 class="mb-5 mt-5">Просмотр заявки #<?=$request['id']?></h2>
    <div class="row">
        <div class="col-md-6">
            <strong>ФИО: </strong> <span><?=$request['name']?></span><hr>
            <strong>Адрес: </strong> <span><?=$request['address']?></span><hr>
            <strong>Телефон: </strong> <span><?=$request['phone']?></span><hr>
            <strong>Email: </strong> <span><?=$request['email']?></span><hr>
            <strong>Текст заявки: </strong> <span><?=$request['request']?></span><hr>
            <strong>Дата создания: </strong> <span><?=$request['created_at']?></span><hr>
            <a href="admin.php" class="btn btn-success">Назад к списку</a>
            <a href="admin-edit.php?id=<?=$request['id']?>" class="btn btn-primary">Редактировать</a>
        </div>
    </div>
</div>

<?php
require_once '_footer.php';
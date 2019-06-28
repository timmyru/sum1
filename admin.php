<?php
/**
 * @var $connection PDO
 */

session_start();
require_once 'db/db.php';

if (!empty($_POST)) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $query = $connection->query("SELECT * from admin WHERE login='$login' AND password='$password'")->fetch();

    if ($query) {
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
    }
}

if (!isset($_SESSION['login']) || !isset($_SESSION['password']) || $_SESSION['login'] != 'admin') {
    $_SESSION['error'] = 'Неверный логин или пароль';
    header('Location: admin-login.php');
}
$title = 'Админка';
require_once '_header.php';
require_once '_nav.php';

$requests = $connection->query('SELECT * FROM request')->fetchAll();

?>

<div class="container">
    <div class="row">
        <h2 class="mt-5 mb-5">Управление заявками</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ФИО</th>
                <th scope="col">Адрес</th>
                <th scope="col">Телефон</th>
                <th scope="col">Email</th>
                <th scope="col" width="200">Заявка</th>
                <th scope="col">Дата</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            foreach ($requests as $request) : ?>
            <tr>
                <th scope="row"><?=$i ?></th>
                <td><?=$request['name'] ?></td>
                <td><?=$request['address'] ?></td>
                <td><?=$request['phone'] ?></td>
                <td><?=$request['email'] ?></td>
                <td><?=$request['request'] ?></td>
                <td><?=$request['created_at'] ?></td>
                <td>
                    <a href="admin-view.php?id=<?=$request['id']?>"><i class="fa fa-eye fa-fw"></i></a>
                    <a href="admin-edit.php?id=<?=$request['id']?>"><i class="fa fa-pencil fa-fw"></i></a>
                </td>
                <?php $i++ ?>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="actions/admin-logout.php" class="mt-5 btn btn-primary">Выход из админки</a>
</div>

<?php
require_once '_footer.php';
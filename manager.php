<?php
/**
 * @var $connection PDO
 */

session_start();
require_once 'db/db.php';

if (!empty($_POST)) {
    $login = $_POST['manager-login'];
    $password = $_POST['manager-password'];

    $query = $connection->query("SELECT * from manager WHERE login='$login' AND `password`='$password'")->fetch();

    if ($query) {
        $_SESSION['manager.login'] = $login;
        $_SESSION['manager.password'] = $password;
    }
}

if (!isset($_SESSION['manager.login']) || !isset($_SESSION['manager.password'])) {
    $_SESSION['error'] = 'Неверный логин или пароль';
    header('Location: manager-login.php');
}

$title = 'Список заявок';
require_once '_header.php';
require_once '_nav.php';

if (isset($_GET['name']) || isset($_GET['address']) || isset($_GET['phone']) || isset($_GET['email']) || isset($_GET['request'])) {
    $name = trim(htmlspecialchars($_GET['name']));
    $address = trim(htmlspecialchars($_GET['address']));
    $phone = trim(htmlspecialchars($_GET['phone']));
    $email = trim(htmlspecialchars($_GET['email']));
    $request = trim(htmlspecialchars($_GET['request']));
    $requests = $connection->query("SELECT * FROM request 
                                        WHERE `name` LIKE '%$name%'
                                        AND address LIKE '%$address%'
                                        AND phone LIKE '%$phone%'
                                        AND email LIKE '%$email%'
                                        AND request LIKE '%$request%'
")->fetchAll();
} else {
    $requests = $connection->query('SELECT * FROM request')->fetchAll();
}

?>

    <div class="container">
        <div class="row">
            <div class="mb-5 mt-5">
                <h2>Просмотр заявок</h2>
                <small>*для поиска нажмите клавишу Enter</small>
            </div>
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
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <form class="filter-form">
                        <td><input type="text" name="name" class="form-control" value="<?= $_GET['name'] ? : '' ?>"></td>
                        <td><input type="text" name="address" class="form-control" value="<?= $_GET['address'] ? : '' ?>"></td>
                        <td><input type="text" name="phone" class="form-control" value="<?= $_GET['phone'] ? : '' ?>"></td>
                        <td><input type="text" name="email" class="form-control" value="<?= $_GET['email'] ? : '' ?>"></td>
                        <td><input type="text" name="request" class="form-control" value="<?= $_GET['request'] ? : '' ?>"></td>
                    </form>
                    <td></td>
                </tr>
                <?php
                $i = 1;
                foreach ($requests as $request) : ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $request['name'] ?></td>
                        <td><?= $request['address'] ?></td>
                        <td><?= $request['phone'] ?></td>
                        <td><?= $request['email'] ?></td>
                        <td><?= $request['request'] ?></td>
                        <td><?= $request['created_at'] ?></td>
                        <?php $i++ ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <hr>
            <?php if (empty($requests)) : ?>
                <h4>Ничего не найдено</h4>
            <?php endif; ?>
        </div>

        <a href="actions/manager-logout.php" class="mt-5 btn btn-primary">Выход</a>
    </div>

<?php
require_once '_footer.php';
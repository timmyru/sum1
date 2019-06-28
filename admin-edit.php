<?php
/**
 * @var $connection PDO
 */
session_start();
if (!isset($_SESSION['login']) || !isset($_SESSION['password']) || $_SESSION['login'] != 'admin') {
    header('Location: admin-login.php');
}
$title = 'Редактирование заявки №' . $_GET['id'];
require_once '_header.php';
require_once '_nav.php';

$id = $_GET['id'];
$request = $connection->query("SELECT * FROM request WHERE id='$id'")->fetch();

?>

    <div class="container">

        <?php
        if (isset($_SESSION['success'])) :
            ?>
            <div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php unset($_SESSION['success']);
        endif;
        ?>

        <h2 class="mt-5 mb-5">Редактирование заявки #<?=$request['id']?></h2>
        <div class="row">
            <div class="col-md-6">
                <form class="request-form" method="post" action="actions/edit-request.php">
                    <input type="hidden" name="id" value="<?=$request['id']?>">
                    <div class="form-group">
                        <label for="name">Ваше ФИО</label>
                        <input type="text" class="form-control" name="name" id="name"
                               placeholder="Например, Иванов Иван Иванович" required value="<?=$request['name']?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Ваш адрес</label>
                        <input type="text" class="form-control" name="address" id="address"
                               placeholder="Например, улица Ленина, дом 10" required value="<?=$request['address']?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Ваш телефон</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                               placeholder="Например, +7 900 100 2030" required value="<?=$request['phone']?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Ваш email</label>
                        <input type="email" class="form-control" name="email" id="email"
                               placeholder="Например, abc@abc.ru" required value="<?=$request['email']?>">
                    </div>
                    <div class="form-group">
                        <label for="request">Ваша заявка</label>
                        <textarea type="text" class="form-control" name="request" id="request"
                                  placeholder="Текст заявки" required><?=$request['request']?></textarea>
                    </div>
                    <a href="admin.php" class="btn btn-success">Назад к списку</a>
                    <input type="submit" class="btn btn-primary" value="Редактировать заявку">
                </form>
            </div>
        </div>
    </div>

<?php
require_once '_footer.php';
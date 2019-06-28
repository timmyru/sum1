<?php
/**
 * @var $connection PDO
 */
$title = 'Главная страница';
require_once '_header.php';
require_once '_nav.php';

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

        <h2 class="mt-5 mb-5">Оставьте заявку!</h2>
        <div class="row">
            <div class="col-md-6">
                <form class="request-form" method="post" action="actions/new-request.php">
                    <div class="form-group">
                        <label for="name">Ваше ФИО</label>
                        <input type="text" class="form-control" name="name" id="name"
                               placeholder="Например, Иванов Иван Иванович" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Ваш адрес</label>
                        <input type="text" class="form-control" name="address" id="address"
                               placeholder="Например, улица Ленина, дом 10" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Ваш телефон</label>
                        <input type="text" class="form-control" name="phone" id="phone"
                               placeholder="Например, +7 900 100 2030" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Ваш email</label>
                        <input type="email" class="form-control" name="email" id="email"
                               placeholder="Например, abc@abc.ru" required>
                    </div>
                    <div class="form-group">
                        <label for="request">Ваша заявка</label>
                        <textarea type="text" class="form-control" name="request" id="request"
                                  placeholder="Текст вашей заявки" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Отправить заявку">
                </form>
            </div>
        </div>
    </div>

<?php
require_once '_footer.php';
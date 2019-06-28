<?php

/**
 * @var $connection PDO
 */

if (empty($_POST)) {
    header('Location: ../index.php');
    die();
}

session_start();
require_once '../db/db.php';

$name = htmlspecialchars($_POST['name']);
$address = htmlspecialchars($_POST['address']);
$phone = htmlspecialchars($_POST['phone']);
$email = htmlspecialchars($_POST['email']);
$request = htmlspecialchars($_POST['request']);

$query = $connection->prepare("INSERT INTO `request` SET name=:name, address=:address, phone=:phone, email=:email, request=:request");
$queryArray = ['name' => $name, 'address' => $address, 'phone' => $phone, 'email' => $email, 'request' => $request];
$query->execute($queryArray);


$_SESSION['success'] = 'Ваша заявка отправлена! Скоро менеджеры свяжутся с вами';

header('Location: ../index.php');
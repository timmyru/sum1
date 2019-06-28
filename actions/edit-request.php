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

$id = htmlspecialchars($_POST['id']);
$name = htmlspecialchars($_POST['name']);
$address = htmlspecialchars($_POST['address']);
$phone = htmlspecialchars($_POST['phone']);
$email = htmlspecialchars($_POST['email']);
$request = htmlspecialchars($_POST['request']);

$query = $connection->prepare("UPDATE `request` SET name=:name, address=:address, phone=:phone, email=:email, request=:request WHERE id='$id'");
$queryArray = ['name' => $name, 'address' => $address, 'phone' => $phone, 'email' => $email, 'request' => $request];
$query->execute($queryArray);


$_SESSION['success'] = 'Заявка успешно отредактирована';

header('Location: ../admin-edit.php?id=' . $id);
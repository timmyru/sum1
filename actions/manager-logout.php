<?php
session_start();
unset($_SESSION['manager.login']);
unset($_SESSION['manager.password']);
header('Location: ../index.php');
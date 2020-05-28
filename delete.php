<?php
require 'pdo.php';
session_start();

if (isset($_GET['user_id'])) {
    $sql = 'DELETE FROM users WHERE user_id = :zip';
    $pdo->prepare($sql)->execute(array(':zip' => $_GET['user_id']));
    $_SESSION['success'] = 'record deleted';
    header('Location: index.php');
    return;
} elseif (!isset($_GET['user_id'])) {
    $_SESSION['error'] = 'invalid user_id';
    header('Location: index.php');
    return;
}

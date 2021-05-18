<?php

    session_start();

    function cek_token() {
        if (!isset($_GET['csrf_token'])) {
            return false;
        }
        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }
        return ($_GET['csrf_token'] === $_SESSION['csrf_token']);
    }

    include 'functions.php';
    $pdo = pdo_connect();

    if (cek_token()) {
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            header("location:index.php");
        } else {
            die ('No ID specified!');
        }
    } else {
        echo "Request tidak valid. jangan coba di serang.<br>";
        echo "Muhammad Novrizal Ghiffari | III RPLK";
    }

?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/index.css">
    <link rel="stylesheet" href="./asset/thong_tin_ca_nhan.css">
    <title>Thông tin cá nhân</title>
</head>
<body>
    <?php include "menu_bar.php" ?>
    <h1>Thông tin cá nhân</h1><br>
    <div>
        <?php 
        if (isset($_SESSION['email'])){
            echo "
                <div class=\"info_block\"><h3 class=\"label\">Họ tên </h3><p class=\"value\">" . $_SESSION['name'] . "</p></div>
                <div class=\"info_block\"><h3 class=\"label\">Email </h3><p class=\"value\">" . $_SESSION['email'] . "</p></div>
                <div class=\"info_block\"><h3 class=\"label\">Năm sinh </h3><p class=\"value\">" . $_SESSION['birth'] . "</p></div>
                <div class=\"info_block\"><h3 class=\"label\">Giới tính </h3><p class=\"value\">" . $_SESSION['gender'] . "</p></div>
            ";
        } else header("Location: ./dangnhap.php");
    ?>
    </div>
</body>
</html>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/index.css">
    <link rel="stylesheet" href="./asset/dangky.css">
    <link rel="stylesheet" href="./asset/dangxuat.css">
    <title>Đăng xuất</title>
</head>
<body>
    <?php include "menu_bar.php" ?>
    <div class="logout">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h1 style="color: blue;">ĐĂNG XUẤT</h1>
            <h2 style="color: red;">BẠN CÓ CHẮC CHẮN MUỐN ĐĂNG XUẤT ?</h2>
            <input type="submit" value="CÓ" style="font-size: 20px; margin: 10px">
        </form>
        <a href="./thong_tin_ca_nhan.php"><button>KHÔNG</button></a>
    </div>

    <?php 
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            if (session_unset() and session_destroy()) header("Location: ./dangnhap.php");
            else echo "Lỗi trong lúc đăng xuất";
        }
    ?>
</body>
</html>
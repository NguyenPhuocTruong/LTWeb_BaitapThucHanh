<?php session_start() ?>

<?php 
    // kiem tra user da dang nhap chua, neu roi thi chuyen huong qua thong tin ca nhan
    if (isset($_SESSION['email'])) header("Location: ./thong_tin_ca_nhan.php");
?>

<?php 
    require_once("./mysqlConnect.php");
    $mysqli->select_db("thb3");

    // xu ly du lieu nhap vao cua user
    function test_input(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $password = $_POST['password'];
        $email = filter_var(test_input($_POST['email']), FILTER_SANITIZE_EMAIL);
        $stm = $mysqli->prepare("SELECT matkhau FROM thanhvien WHERE email = ?");
        $stm->bind_param("s", $email);
        if ($stm->execute()){
            $result = $stm->get_result();
            if ($result->num_rows == 1){
                if (password_verify($password, $result->fetch_assoc()['matkhau'])){
                    // lay ra thong tin cho session
                    $info = $mysqli->query("SELECT * FROM thanhvien WHERE email = '$email'")->fetch_assoc();
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $info['hoten'];
                    $_SESSION['birth'] = (int)$info['namsinh'];
                    $_SESSION['gender'] = $info['gioitinh'];

                    // chuyen huong den trang thong tin ca nhan
                    header("Location: ./thong_tin_ca_nhan.php");
                } else echo "Sai mật khẩu";
            } else echo "Tài khoản chưa đăng ký";
        } else echo "Lỗi trong lúc truy vấn dữ liệu: " . $stm->error;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/index.css">
    <link rel="stylesheet" href="./asset/dangky.css">
    <title>Đăng nhập</title>
</head>
<body>
    <?php include "menu_bar.php" ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        <h1 style="color: blue;">ĐĂNG NHẬP</h1>
        <div class="info_block">
            <label for="email">Địa chỉ email:</label><input type="email" name="email" required>
        </div>
        <div class="info_block">
            <label for="password">Mật khẩu:</label><input type="password" name="password" required>
        </div>
        <div style="margin-top: 10px;">
            <input type="submit" value="Đăng Nhập"> <input type="reset" value="Xóa Form">
        </div>
    </form>
</body>
</html>
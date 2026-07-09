<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/index.css">
    <link rel="stylesheet" href="./asset/dangky.css">
    <title>Đăng ký thành viên</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        <h1 style="color: blue;">THÔNG TIN ĐĂNG KÝ THÀNH VIÊN</h1>
        <div class="info_block">
            <label for="name">Họ tên:</label><input type="text" name="name" required>
        </div>
        <div class="info_block">
            <label for="email">Địa chỉ email:</label><input type="email" name="email" required>
        </div>
        <div class="info_block">
            <label for="password">Mật khẩu:</label><input type="password" name="password" required>
        </div>
        <div class="info_block">
            <label for="birth">Năm sinh:</label>
            <select name="birth" class="select">
                <?php 
                    // get current year
                    $curr_year = date("Y");

                    for ($i = 1910; $i < $curr_year; $i++){
                        echo "<option>$i</option>";
                    }
                    echo "<option selected>$curr_year</option>";
                ?>
            </select>
        </div>
        <div class="info_block">
            <label for="gender">Giới tính:</label>
            <div class="radio">
                <input type="radio" name="gender" value="nam">Nam
                <input type="radio" name="gender" value="nu" style="margin-left: 20px;">Nữ
            </div>
        </div>
        <div style="margin-top: 10px;">
            <input type="submit" value="Đăng Ký"> <input type="reset" value="Xóa Form">
        </div>
    </form>

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
            if (
                isset($_POST['name']) and 
                isset($_POST['email']) and
                isset($_POST['password']) and 
                isset($_POST['birth']) and 
                isset($_POST['gender'])
            ) {
                $name = test_input($_POST['name']);
                $email = filter_var(test_input($_POST['email']), FILTER_SANITIZE_EMAIL); // xoa moi ky tu bat hop phap
                $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $birth = (int)$_POST['birth'];
                $gender = $_POST['gender'];

                $stm = $mysqli->prepare("INSERT INTO members (email, hoten, matkhau, namsinh, gioitinh) VALUES(?, ?, ?, ?, ?)");
                $stm->bind_param("sssis", $email, $name, $hashed_password, $birth, $gender);
                if ($stm->execute()){
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['birth'] = $birth;
                    $_SESSION['gender'] = $gender;
                    header("Location: ./thong_tin_ca_nhan.php");
                } else echo "Lỗi trong lúc lưu trữ dữ liệu: " . $stm->error;
            } else echo "Vui lòng nhập đầy đủ thông tin";
        }
    ?>
</body>
</html>
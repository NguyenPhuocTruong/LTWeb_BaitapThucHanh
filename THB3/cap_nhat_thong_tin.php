<?php session_start() ?>

<?php 
    // kiem tra user da dang nhap chua, neu chua thi chuyen qua trang dangnhap
    if (!isset($_SESSION['email'])) header("Location: ./dangnhap.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/index.css">
    <link rel="stylesheet" href="./asset/dangky.css">
    <title>Cập nhật thông tin</title>
</head>
<body>
    <?php include "menu_bar.php" ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <h1 style="color: blue;">CẬP NHẬT THÔNG TIN CÁ NHÂN</h1>
        <div class="info_block">
            <label for="name">Họ tên:</label><input type="text" name="name" required value="<?php echo $_SESSION['name'] ?>">
        </div>
        <div class="info_block">
            <label for="birth">Năm sinh:</label>
            <select name="birth" class="select">
                <?php 
                    // get current year
                    $curr_year = date("Y");

                    for ($i = 1910; $i <= $curr_year; $i++){
                        if ($i == $_SESSION['birth']) echo "<option selected>$i</option>";
                        else echo "<option>$i</option>";
                    }
                ?>
            </select>
        </div>
        <div class="info_block">
            <label for="gender">Giới tính:</label>
            <div class="radio">
                <input type="radio" name="gender" value="nam" <?php echo ($_SESSION['gender'] == "nam") ? "checked":"" ?>>Nam
                <input type="radio" name="gender" value="nữ" style="margin-left: 20px;" <?php echo ($_SESSION['gender'] == "nữ") ? "checked":"" ?>>Nữ
            </div>
        </div>
        <div style="margin-top: 10px;">
            <input type="submit" value="Xác Nhận Thay Đổi"> <input type="reset" value="Hủy">
        </div>
    </form>
    <?php 
        require_once("./mysqlConnect.php");
        $mysqli->select_db("thb3");

        // kiem tra du lieu user nhap vao
        function test_input(string $data): string{
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            if (
                $_POST['name'] !== $_SESSION['name'] or 
                $_POST['birth'] !== $_SESSION['birth'] or 
                $_POST['gender'] !== $_SESSION['gender']
            ){
                $email = $_SESSION['email'];
                $new_name = test_input($_POST['name']);
                $new_birth = (int)$_POST['birth'];
                $new_gender = $_POST['gender'];
                $stm = $mysqli->prepare("UPDATE thanhvien SET hoten = ?, namsinh = ?, gioitinh = ? WHERE email = '$email'");
                $stm->bind_param("sis", $new_name, $new_birth, $new_gender);
                if ($stm->execute()) {
                    $_SESSION['name'] = $new_name;
                    $_SESSION['birth'] = $new_birth;
                    $_SESSION['gender'] = $new_gender;
                    header("Location: ./thong_tin_ca_nhan.php");
                }
                else echo "Lỗi trong lúc thay đổi dữ liệu: " . $stm->error;
            } else echo "
                <script>
                    console.log(\"Không có gì để thay đổi !\");
                </script>
            ";
        }
    ?>
</body>
</html>
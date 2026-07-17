<?php require_once("./mysqlConnect.php") ?>

<?php 

    function test_input(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    $mssv = test_input($_REQUEST['mssv']);
    $hoten = test_input($_REQUEST['hoten']);

    // kiem tra ma so sinh vien da ton tai trong csdl chua 
    $stm = $mysqli->prepare("SELECT * FROM sinhvien WHERE mssv = ?");
    $stm->bind_param("s", $mssv);
    if ($stm->execute()){
        if ($stm->get_result()->num_rows > 0){ // neu da ton tai thi khong lam gi ca, chi in ra bang sinh vien hien tai
            include("./hienthi_sinhvien.php");
        }
        else {
            // neu chua ton tai thi them sinh vien vao csdl
            $stm = $mysqli->prepare("INSERT INTO sinhvien(mssv, hoten) VALUES(?, ?)");
            $stm->bind_param("ss", $mssv, $hoten);
            if ($stm->execute()){
                include("./hienthi_sinhvien.php");
            } else echo "Lỗi trong lúc thêm sinh viên: " . $stm->error;
        }
    } else echo "Lỗi trong lúc kiểm tra sinh viên: " . $stm->error;
    $stm->close();
?>
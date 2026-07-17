<?php require_once("./mysqlConnect.php") ?>

<?php 
    if (isset($_REQUEST['mssv'])){
        $mssv = $_REQUEST['mssv'];
        if ($mysqli->query("DELETE FROM sinhvien WHERE mssv='$mssv'")){
            include("./hienthi_sinhvien.php");
        } else echo "Lỗi trong lúc xóa sinh viên: " . $mysqli->error;
    }
?>
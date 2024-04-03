<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['admin_pass']) &&
    isset($_POST['new_pass'])   &&
    isset($_POST['c_new_pass']) &&
    isset($_POST['r_user_id'])) {
    
    include '../../db_conection.php';
    include "../function/registrar_office.php";
    include "../function/admin.php";

    $admin_pass = $_POST['admin_pass'];
    $new_pass = $_POST['new_pass'];
    $c_new_pass = $_POST['c_new_pass'];

    $r_user_id = $_POST['r_user_id'];
    $id = $_SESSION['admin_id'];
    
    $data = 'r_user_id='.$r_user_id.'#change_password';

    if (empty($admin_pass)) {
		$em  = "Cần có mật khẩu quản trị viên";
		header("Location: ../registrar-office-edit.php?perror=$em&$data");
		exit;
	}else if (empty($new_pass)) {
		$em  = "Cần có mật khẩu mới";
		header("Location: ../registrar-office-edit.php?perror=$em&$data");
		exit;
	}else if (empty($c_new_pass)) {
		$em  = "Cần có mật khẩu xác nhận";
		header("Location: ../registrar-office-edit.php?perror=$em&$data");
		exit;
	}else if ($new_pass !== $c_new_pass) {
        $em  = "Mật khẩu mới và mật khẩu xác nhận không khớp";
        header("Location: ../registrar-office-edit.php?perror=$em&$data");
        exit;
    }else if (!adminPasswordVerify($admin_pass, $conn, $id)) {
        $em  = "Mật khẩu quản trị viên không chính xác";
        header("Location: ../registrar-office-edit.php?perror=$em&$data");
        exit;
    }else {
        // hashing the password
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE registrar_office SET
                password = ?
                WHERE r_user_id=?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_pass, $r_user_id]);
        $sm = "Đã đổi mật khẩu thành công!";
        header("Location: ../registrar-office-edit.php?psuccess=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "Đã xảy ra lỗi";
    header("Location: ../registrar-office.php?error=$em&$data");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
	header("Location: ../../logout.php");
	exit;
} 
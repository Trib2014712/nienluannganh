<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['admin_pass']) &&//isset kiểm tra biến có tồn tại hay không
    isset($_POST['new_pass'])   &&
    isset($_POST['c_new_pass']) &&
    isset($_POST['student_id'])) {
    
    include '../../db_conection.php';
    include "../function/admin.php";

    $admin_pass = $_POST['admin_pass'];
    $new_pass = $_POST['new_pass'];
    $c_new_pass = $_POST['c_new_pass'];

    $student_id = $_POST['student_id'];
    $id = $_SESSION['admin_id'];
    
    $data = 'student_id='.$student_id.'#change_password';

    if (empty($admin_pass)) {
		$em  = "Cần có mật khẩu quản trị viên";
		header("Location: ../student-edit.php?perror=$em&$data");
		exit;
	}else if (empty($new_pass)) {
		$em  = "Cần có mật khẩu mới";
		header("Location: ../student-edit.php?perror=$em&$data");
		exit;
	}else if (empty($c_new_pass)) {
		$em  = "Xác nhận lại mật khẩu";
		header("Location: ../student-edit.php?perror=$em&$data");
		exit;
	}else if ($new_pass !== $c_new_pass) {
        $em  = "Mật khẩu mới và mật khẩu xác nhận không khớp";
        header("Location: ../student-edit.php?perror=$em&$data");
        exit;
    }else if (!adminPasswordVerify($admin_pass, $conn, $id)) {
        $em  = "Mật khẩu quản trị viên không chính xác";
        header("Location: ../student-edit.php?perror=$em&$data");
        exit;
    }else {
        // hashing the password
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE students SET
                password = ?
                WHERE student_id=?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_pass, $student_id]);
        $sm = "Đã đổi mật khẩu thành công!";
        header("Location: ../student-edit.php?psuccess=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "Đã xảy ra lỗi";
    header("Location: ../student-edit.php?error=$em&$data");
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
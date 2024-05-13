<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['section'])) {
    
    include '../../db_conection.php';

    $section = $_POST['section'];
    
  if (empty($section)) {
		$em  = "Phần này là bắt buộc";
		header("Location: ../section-add.php?error=$em");
		exit;
	}else {
        $sql  = "INSERT INTO
                 section (section)
                 VALUES(?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$section]);
        $sm = "Phần mới được tạo thành công";
        header("Location: ../section-add.php?success=$sm");
        exit;
	}
    
  }else {
  	$em = "Đã xảy ra lỗi";
    header("Location: ../section-add.php?error=$em");
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
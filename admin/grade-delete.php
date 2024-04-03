<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['grade_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../db_conection.php";
     include "function/grade.php";

     $id = $_GET['grade_id'];
     if (removeGrade($id, $conn)) {
     	$sm = "Đã xóa thành công!";
        header("Location: grade.php?success=$sm");
        exit;
     }else {
        $em = "Xảy ra lỗi không xác định được";
        header("Location: grade.php?error=$em");
        exit;
     }


  }else {
    header("Location: grade.php");
    exit;
  } 
}else {
	header("Location: grade.php");
	exit;
} 
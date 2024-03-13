<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['teacher_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../db_conection.php";
     include "function/teacher.php";

     $id = $_GET['teacher_id'];
     if (removeTeacher($id, $conn)) {
     	$sm = "Đã xóa thành công!";
        header("Location: teacher.php?success=$sm");
        exit;
     }else {
        $em = "Xảy ra lỗi không xác định được";
        header("Location: teacher.php?error=$em");
        exit;
     }


  }else {
    header("Location: teacher.php");
    exit;
  } 
}else {
	header("Location: teacher.php");
	exit;
} 
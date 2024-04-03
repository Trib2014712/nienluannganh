<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['course_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../db_conection.php";
     include "function/course.php";

     $id = $_GET['course_id'];
     if (removeCourse($id, $conn)) {
     	$sm = "Đã xóa thành công!";
        header("Location: course.php?success=$sm");
        exit;
     }else {
        $em = "Xảy ra lỗi không xác định được";
        header("Location: course.php?error=$em");
        exit;
     }


  }else {
    header("Location: course.php");
    exit;
  } 
}else {
	header("Location: course.php");
	exit;
} 
<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['section_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../db_conection.php";
     include "function/section.php";

     $id = $_GET['section_id'];
     if (removeSection($id, $conn)) {
     	$sm = "Đã xóa thành công!";
        header("Location: section.php?success=$sm");
        exit;
     }else {
        $em = "Xảy ra lỗi không xác định được";
        header("Location: section.php?error=$em");
        exit;
     }


  }else {
    header("Location: section.php");
    exit;
  } 
}else {
	header("Location: section.php");
	exit;
} 
<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['r_user_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../db_conection.php";
     include "function/registrar_office.php";

     $id = $_GET['r_user_id'];
     if (removeRUser($id, $conn)) {
     	$sm = "Đã xóa thành công!";
        header("Location: registrar-office.php?success=$sm");
        exit;
     }else {
        $em = "Xảy ra lỗi không xác định được";
        header("Location: registrar-office.php?error=$em");
        exit;
     }


  }else {
    header("Location: registrar-office.php");
    exit;
  } 
}else {
	header("Location: registrar-office.php");
	exit;
}
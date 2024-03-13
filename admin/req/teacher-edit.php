<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['fname'])      &&
    isset($_POST['lname'])      &&
    isset($_POST['username'])   &&
    isset($_POST['teacher_id']) &&
    isset($_POST['subjects'])   &&
    isset($_POST['grades'])) {
    
    include '../../db_conection.php';
    include "../function/teacher.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];

    $teacher_id = $_POST['teacher_id'];
    
    $grades = "";
    foreach ($_POST['grades'] as $grade) {
    	$grades .=$grade;
    }

    $subjects = "";
    foreach ($_POST['subjects'] as $subject) {
    	$subjects .=$subject;
    }

    $data = 'teacher_id='.$teacher_id;

    if (empty($fname)) {
		$em  = "Tên là bắt buộc";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Họ là bắt buộc";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em  = "Tên người dùng là bắt buộc";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn, $teacher_id)) {
		$em  = "Tên người dùng đã được sử dụng! thử cái khác";
		header("Location: ../teacher-edit.php?error=$em&$data");
		exit;
	}else {
        $sql = "UPDATE teachers SET
                username = ?, fname=?, lname=?, subjects=?, grades=?
                WHERE teacher_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname,$fname, $lname, $subjects, $grades, $teacher_id]);
        $sm = "Cập nhật thành công!";
        header("Location: ../teacher-edit.php?success=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "Đã xảy ra lỗi";
    header("Location: ../teacher-edit.php?error=$em");
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
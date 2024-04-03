<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['fname'])      &&
    isset($_POST['lname'])      &&
    isset($_POST['username'])   &&
    isset($_POST['teacher_id']) &&
    isset($_POST['address'])  &&
    isset($_POST['employee_number']) &&
    isset($_POST['phone_number'])  &&
    isset($_POST['qualification']) &&
    isset($_POST['email_address']) &&
    isset($_POST['gender'])        &&
    isset($_POST['date_of_birth']) &&
    isset($_POST['subjects'])   &&
    isset($_POST['classes'])) {
    
    include '../../db_conection.php';
    include "../function/teacher.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];

    $address = $_POST['address'];
    $employee_number = $_POST['employee_number'];
    $phone_number = $_POST['phone_number'];
    $qualification = $_POST['qualification'];
    $email_address = $_POST['email_address'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];

    $teacher_id = $_POST['teacher_id'];
    
    $classes = "";
    foreach ($_POST['classes'] as $class) {
    	$classes .=$class;
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
	  }else if (empty($address)) {
        $em  = "Địa chỉ là bắt buộc";
        header("Location: ../teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($employee_number)) {
        $em  = "Mã số nhân viên là bắt buộc";
        header("Location: ../teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($phone_number)) {
        $em  = "Số điện thoại là bắt buộc";
        header("Location: ../teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($qualification)) {
        $em  = "Cần có trình độ chuyên môn";
        header("Location: ../teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Địa chỉ e-mail là bắt buộc";
        header("Location: ../teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Địa chỉ giới tính là bắt buộc";
        header("Location: ../teacher-edit.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Ngày sinh địa chỉ là bắt buộc";
        header("Location: ../teacher-edit.php?error=$em&$data");
        exit;
    }else {
              $sql = "UPDATE teachers SET
              username = ?,class=?, fname=?, lname=?, subjects=?,
              address = ?, employee_number=?, date_of_birth = ?, phone_number = ?, qualification = ?,gender=?, email_address = ?
              WHERE teacher_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname,  $classes, $fname, $lname, $subjects, $address, $employee_number, $date_of_birth, $phone_number, $qualification, $gender, $email_address,        $teacher_id]);
        $sm = "Cập nhật thành công";
        header("Location: ../teacher-edit.php?success=$sm&$data");
        exit;
        }

        }else {
        $em = "An error occurred";
        header("Location: ../teacher.php?error=$em");
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
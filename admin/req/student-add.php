<?php 
   include '../../db_conection.php';
   include "../function/student.php";
session_start(); //câu lệnh
if (isset($_SESSION['admin_id']) && //kiểm tra xem nó có tồn tại hay chưa
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

      if (isset($_POST['fname']) &&
      isset($_POST['lname']) &&
      isset($_POST['username']) &&
      isset($_POST['pass'])     &&
      isset($_POST['address'])  &&
      isset($_POST['gender'])   &&
      isset($_POST['email_address']) &&
      isset($_POST['date_of_birth']) &&
      isset($_POST['parent_fname'])  &&
      isset($_POST['parent_lname'])  &&
      isset($_POST['parent_phone_number']) &&
      isset($_POST['section']) &&
      isset($_POST['grade'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['username'];
        $pass = $_POST['pass'];
    
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $email_address = $_POST['email_address'];
        $date_of_birth = $_POST['date_of_birth'];
        $parent_fname = $_POST['parent_fname'];
        $parent_lname = $_POST['parent_lname'];
        $parent_phone_number = $_POST['parent_phone_number'];
    
        $grade = $_POST['grade'];
        $section = $_POST['section'];

        $data = 'uname='.$uname.'&fname='.$fname.'&lname='.$lname.'&address='.$address.'&gender='.$email_address.'&pfn='.$parent_fname.'&pln='.$parent_lname.'&ppn='.$parent_phone_number;


    if (empty($fname)) {
		$em  = "Tên là bắt buộc";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Họ là bắt buộc";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em  = "Tên người dùng là bắt buộc";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em  = "Tên người dùng đã được sử dụng! thử cái khác";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($pass)) {
		$em  = "Cần có mật khẩu";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
  }else if (empty($address)) {
    $em  = "Địa chỉ là bắt buộc";
    header("Location: ../student-add.php?error=$em&$data");
    exit;
}else if (empty($gender)) {
    $em  = "Giới tính là bắt buộc";
    header("Location: ../student-add.php?error=$em&$data");
    exit;
}else if (empty($email_address)) {
    $em  = "Địa chỉ e-mail là bắt buộc";
    header("Location: ../student-add.php?error=$em&$data");
    exit;
}else if (empty($date_of_birth)) {
    $em  = "Ngày sinh là bắt buộc";
    header("Location: ../student-add.php?error=$em&$data");
    exit;
}else if (empty($parent_fname)) {
    $em  = "Tên của phụ huynh là bắt buộc";
    header("Location: ../student-add.php?error=$em&$data");
    exit;
}else if (empty($parent_lname)) {
    $em  = "Họ của cha mẹ là bắt buộc";
    header("Location: ../student-add.php?error=$em&$data");
    exit;
}else if (empty($parent_phone_number)) {
    $em  = "Cần có số điện thoại của phụ huynh";
    header("Location: ../student-add.php?error=$em&$data");
    exit;
}else if (empty($section)) {
    $em  = "Phần này là bắt buộc";
    header("Location: ../student-add.php?error=$em&$data");
    exit;
  }else {
    // hashing the password
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql  = "INSERT INTO
             students(username, password, fname, lname, grade, section, address, gender, email_address, date_of_birth, parent_fname, parent_lname, parent_phone_number)
             VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$uname, $pass, $fname, $lname, $grade, $section, $address, $gender, $email_address, $date_of_birth, $parent_fname, $parent_lname, $parent_phone_number]);
    $sm = "Học viên mới đăng ký thành công";
    header("Location: ../student-add.php?success=$sm");
    exit;
}

    }else {
    $em = "Đã xảy ra lỗi";
    header("Location: ../student-add.php?error=$em");
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
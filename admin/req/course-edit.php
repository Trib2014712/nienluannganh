<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['course_name']) &&
    isset($_POST['course_code']) &&
    isset($_POST['grade'])       &&
    isset($_POST['course_id'])) {
    
    include '../../db_conection.php';

    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $grade = $_POST['grade'];
    $course_id = $_POST['course_id'];

    $data = 'course_id='.$course_id;

    if (empty($course_id)) {
        $em  = "id khóa học là bắt buộc";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else if (empty($grade)) {
        $em  = "Cấp là bắt buộc";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else if (empty($course_name)) {
        $em  = "Tên khóa học là bắt buộc";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else if (empty($course_code)) {
        $em  = "Mã khóa học là bắt buộc";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else {
        // check if the class already exists
        $sql_check = "SELECT * FROM subjects
                      WHERE grade=? AND subject_code=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$grade, $course_code]);
        if ($stmt_check->rowCount() > 0) {
              $courses = $stmt_check->fetch();
             if ($courses['subject_id'] == $course_id) {
                $sql  = "UPDATE subjects SET subject=?, sucject_code=?, grade=?
                     WHERE subject_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$course_name, $course_code, $grade, $course_id]);
                $sm = "Khóa học được cập nhật thành công";
                header("Location: ../course-edit.php?success=$sm&$data");
                exit;

             }else {
                 $em  = "Khóa học đã tồn tại";
                 header("Location: ../course-edit.php?error=$em&$data");
                 exit;
            }
           
        }else {

            $sql  = "UPDATE subjects SET sucject=?, subject_code=?, grade=?
                     WHERE subject_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$course_name, $course_code, $grade, $course_id]);
            $sm = "Khóa học được cập nhật thành công";
            header("Location: ../course-edit.php?success=$sm&$data");
            exit;
       }
	}
    
  }else {
  	$em = "Đã xảy ra lỗi";
    header("Location: ../course.php?error=$em");
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
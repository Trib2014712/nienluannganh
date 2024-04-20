<?php 
session_start();
if (isset($_SESSION['student_id']) &&  //req của cái login lấy cái id đi ss đặng đăng nhập vô
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
       include "../db_conection.php";
       include "function/student.php";
       include "function/subject.php";
       include "function/grade.php";
       include "function/section.php";

       $student_id = $_SESSION['student_id'];

       $student = getStudentById($student_id, $conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Student - Home</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "include/navbar.php";
     ?>
     <?php 
        if ($student != 0) {
     ?>
     <div class="container mt-5">
         <div class="card" style="width: 22rem;">
          <img src="../img/student-<?=$student['gender']?>.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center">@<?=$student['username']?></h5>
          </div>
          <ul class="list-group list-group-flush">
          <li class="list-group-item">Tên: <?=$student['fname']?></li>
            <li class="list-group-item">Họ: <?=$student['lname']?></li>
            <li class="list-group-item">Tên tài khoản: <?=$student['username']?></li>
            <li class="list-group-item">Địa chỉ: <?=$student['address']?></li>
            <li class="list-group-item">Ngày sinh: <?=$student['date_of_birth']?></li>
            <li class="list-group-item">Địa chỉ email: <?=$student['email_address']?></li>
            <li class="list-group-item">Giới tính: <?=$student['gender']?></li>
            <li class="list-group-item">Ngày tham gia: <?=$student['date_of_joined']?></li>


            <li class="list-group-item">Cấp: 
                 <?php 
                      $grade = $student['grade'];
                      $g = getGradeById($grade, $conn);
                      echo $g['grade_code'].'-'.$g['grade'];
                  ?>
            </li>
            <li class="list-group-item">Phần: 
                 <?php 
                    $section = $student['section'];
                    $s = getSectioById($section, $conn);
                    echo $s['section'];
                  ?>
            </li>
            <br><br>
            <li class="list-group-item">Tên cha mẹ: <?=$student['parent_fname']?></li>
            <li class="list-group-item">Họ của cha mẹ: <?=$student['parent_lname']?></li>
            <li class="list-group-item">Số điện thoại của phụ huynh: <?=$student['parent_phone_number']?></li>
          </ul>
        </div>
     </div>
     <?php 
        }else {
          header("Location: student.php");
          exit;
        }
     ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
   <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(1) a").addClass('active');
        });
    </script>
</body>
</html>
<?php 

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>
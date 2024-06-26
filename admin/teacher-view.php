<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../db_conection.php";
       include "function/teacher.php";
       include "function/subject.php";
       include "function/grade.php";
       include "function/section.php";
       include "function/class.php";

       if(isset($_GET['teacher_id'])){

       $teacher_id = $_GET['teacher_id'];

       $teacher = getTeacherById($teacher_id,$conn);    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Giáo viên</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        include "include/navbar.php";
        if ($teacher != 0) {
     ?>
     <div class="container mt-5">
         <div class="card" style="width: 22rem;">
          <img src="../img/teacher-<?=$teacher['gender']?>.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center">@<?=$teacher['username']?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Tên : <?=$teacher['fname']?></li>
            <li class="list-group-item">Họ: <?=$teacher['lname']?></li>
            <li class="list-group-item">Tên tài khoản: <?=$teacher['username']?></li>

            <li class="list-group-item">Số nhân viên: <?=$teacher['employee_number']?></li>
            <li class="list-group-item">Địa chỉ: <?=$teacher['address']?></li>
            <li class="list-group-item">Ngày sinh: <?=$teacher['date_of_birth']?></li>
            <li class="list-group-item">Số điện thoại: <?=$teacher['phone_number']?></li>
            <li class="list-group-item">Trình độ chuyên môn: <?=$teacher['qualification']?></li>
            <li class="list-group-item">Địa chỉ email: <?=$teacher['email_address']?></li>
            <li class="list-group-item">Giới tính:<?=$teacher['gender']?></li>
            <li class="list-group-item">Ngày tham gia: <?=$teacher['date_of_joined']?></li>

            <li class="list-group-item">Môn học: 
                <?php 
                   $s = '';
                   $subjects = str_split(trim($teacher['subjects']));
                   foreach ($subjects as $subject) {
                      $s_temp = getSubjectById($subject, $conn);
                      if ($s_temp != 0) 
                        $s .=$s_temp['subject_code'].', ';
                   }
                   echo $s;
                ?>
            </li>
            <li class="list-group-item">Lớp: 
                  <?php 
                     $c = '';
                     $classes = str_split(trim($teacher['class']));

                     foreach ($classes as $class_id) {
                         $class = getClassById($class_id, $conn);

                        $c_temp = getGradeById($class['grade'], $conn);
                        $section = getSectioById($class['section'], $conn);
                        if ($c_temp != 0) 
                          $c .=$c_temp['grade_code'].'-'.
                               $c_temp['grade'].$section['section'].', ';
                     }
                     echo $c;

                  ?>
            </li>
          </ul>
          <div class="card-body">
            <a href="teacher.php" class="card-link">Quay lại</a>
          </div>
        </div>
     </div>
     <?php 
        }else {
          header("Location: teacher.php");
          exit;
        }
     ?>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(2) a").addClass('active');
        });
    </script>

</body>
</html>
<?php 

    }else {
        header("Location: teacher.php");
        exit;
    }

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>
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
    <!-- <link rel="icon" href="../logo.png"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include "include/navbar.php"; ?>
    <?php if ($student != 0) { ?>
        <div class="container mt-5">
            <div class="card" style="width: 22rem;">
                <!-- <img src="../img/student-<?= $student['gender'] ?>.png" class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title text-center">@<?= $student['username'] ?></h5>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Tên:</th>
                            <td><?= $student['fname'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Họ:</th>
                            <td><?= $student['lname'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Tên tài khoản:</th>
                            <td><?= $student['username'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Địa chỉ:</th>
                            <td><?= $student['address'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Ngày sinh:</th>
                            <td><?= $student['date_of_birth'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Địa chỉ email:</th>
                            <td><?= $student['email_address'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Giới tính:</th>
                            <td><?= $student['gender'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Ngày tham gia:</th>
                            <td><?= $student['date_of_joined'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Cấp:</th>
                            <td>
                                <?php 
                                    $grade = $student['grade'];
                                    $g = getGradeById($grade, $conn);
                                    echo $g['grade_code'].'-'.$g['grade'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Phần:</th>
                            <td>
                                <?php 
                                    $section = $student['section'];
                                    $s = getSectioById($section, $conn);
                                    echo $s['section'];
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tên cha mẹ:</th>
                            <td><?= $student['parent_fname'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Họ của cha mẹ:</th>
                            <td><?= $student['parent_lname'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Số điện thoại của phụ huynh:</th>
                            <td><?= $student['parent_phone_number'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <?php header("Location: student.php"); ?>
        <?php exit; ?>
    <?php } ?>

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
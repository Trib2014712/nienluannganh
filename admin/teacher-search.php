<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        if (isset($_GET['searchKey'])) {

            $search_key = $_GET['searchKey'];
       include "../db_conection.php";
       include "function/teacher.php";
       include "function/subject.php";
       include "function/grade.php";
       $teachers = searchTeachers($search_key, $conn);
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
        if ($teachers != 0) {
     ?>
     <div class="container mt-5">
        <a href="teacher-add.php"
           class="btn btn-dark">Thêm giáo viên mới</a>

           <form action="teacher-search.php" 
                 class="mt-3 n-table"
                 method="get">
             <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="searchKey"
                       value="<?=$search_key?>" 
                       placeholder="Search...">
                <button class="btn btn-primary">
                        <i class="fa fa-search" 
                           aria-hidden="true"></i>
                      </button>
             </div>
           </form>

           <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" 
                 role="alert">
              <?=$_GET['error']?>
            </div>
            <?php } ?>

          <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" 
                 role="alert">
              <?=$_GET['success']?>
            </div>
            <?php } ?>

           <div class="table-responsive">
              <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Họ</th>
                    <th scope="col">Tên tài khoản</th>
                    <th scope="col">Môn học</th>
                    <th scope="col">Cấp</th>
                    <th scope="col">Hoạt động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($teachers as $teacher ) { ?>
                  <tr>
                    <th scope="row">1</th>
                    <td><?=$teacher['teacher_id']?></td>
                    <td><a href="teacher-view.php?teacher_id=<?=$teacher['teacher_id']?>">
                         <?=$teacher['fname']?></a></td>
                    <td><?=$teacher['lname']?></td>
                    <td><?=$teacher['username']?></td>
                    <td>
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
                    </td>
                    <td>
                      <?php 
                           $g = '';
                           $grades = str_split(trim($teacher['grades']));
                           foreach ($grades as $grade) {
                              $g_temp = getGradeById($grade, $conn);
                              if ($g_temp != 0) 
                                $g .=$g_temp['grade_code'].'-'.
                                     $g_temp['grade'].', ';
                           }
                           echo $g;
                        ?>
                    </td>
                    <td>
                        <a href="teacher-edit.php?teacher_id=<?=$teacher['teacher_id']?>"
                           class="btn btn-warning">Chỉnh sửa</a>
                        <a href="teacher-delete.php?teacher_id=<?=$teacher['teacher_id']?>"
                           class="btn btn-danger">Xóa</a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
           </div>
         <?php }else{ ?>
             <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                  Trống! 
                  <a href="teacher.php" class="btn btn-dark">Quay lại</a>

              </div>
         <?php } ?>
     </div>
     
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
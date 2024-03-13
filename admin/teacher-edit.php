<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['teacher_id'])) {

    if ($_SESSION['role'] == 'Admin') {
      
       include "../db_conection.php";
       include "function/subject.php";
       include "function/grade.php";
       include "function/teacher.php";
       $subjects = getAllSubjects($conn);
       $grades = getAllGrades($conn);
       
       $teacher_id = $_GET['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);

       if ($teacher == 0) {
         header("Location: teacher.php");
         exit;
       }


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Chỉnh sửa giáo viên</title>
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
     <div class="container mt-5">
        <a href="teacher.php"
           class="btn btn-dark">Quay lại</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/teacher-edit.php">
        <h3>Chỉnh sửa thông tin giáo viên</h3><hr>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
           <?=$_GET['error']?>
          </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
           <?=$_GET['success']?>
          </div>
        <?php } ?>
        <div class="mb-3">
          <label class="form-label">Tên</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$teacher['fname']?>" 
                 name="fname">
        </div>
        <div class="mb-3">
          <label class="form-label">Họ</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$teacher['lname']?>"
                 name="lname">
        </div>
        <div class="mb-3">
          <label class="form-label">Tên tài khoản</label>
          <input type="text" 
                 class="form-control"
                 value="<?=$teacher['username']?>"
                 name="username">
        </div>
        <input type="text"
                value="<?=$teacher['teacher_id']?>"
                name="teacher_id"
                hidden>

        <div class="mb-3">
          <label class="form-label">Môn học</label>
          <div class="row row-cols-5">
            <?php 
            $subject_ids = str_split(trim($teacher['subjects']));
            foreach ($subjects as $subject){ 
              $checked =0;
              foreach ($subject_ids as $subject_id ) {
                if ($subject_id == $subject['subject_id']) {
                   $checked =1;
                }
              }
            ?>
            <div class="col">
              <input type="checkbox"
                     name="subjects[]"
                     <?php if($checked) echo "checked"; ?>
                     value="<?=$subject['subject_id']?>">
                     <?=$subject['subject']?>
            </div>
            <?php } ?>
             
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Cấp</label>
          <div class="row row-cols-5">
            <?php 
            $grade_ids = str_split(trim($teacher['grades']));
            foreach ($grades as $grade){ 
              $checked =0;
              foreach ($grade_ids as $grade_id ) {
                if ($grade_id == $grade['grade_id']) {
                   $checked =1;
                }
              }
            ?>
            <div class="col">
              <input type="checkbox"
                     name="grades[]"
                     <?php if($checked) echo "checked"; ?>
                     value="<?=$grade['grade_id']?>">
                     <?=$grade['grade_code']?>-<?=$grade['grade']?>
            </div>
            <?php } ?>
             
          </div>
        </div>

      <button type="submit" 
              class="btn btn-primary">
              Cập nhật</button>
     </form>

     <form method="post"
              class="shadow p-3 my-5 form-w" 
              action="req/teacher-change.php"
              id="change_password">
        <h3>Đổi mật khẩu</h3><hr>
          <?php if (isset($_GET['perror'])) { ?>
            <div class="alert alert-danger" role="alert">
             <?=$_GET['perror']?>
            </div>
          <?php } ?>
          <?php if (isset($_GET['psuccess'])) { ?>
            <div class="alert alert-success" role="alert">
             <?=$_GET['psuccess']?>
            </div>
          <?php } ?>
<!-- đổi mật khẩu -->
       <div class="mb-3">
            <div class="mb-3">
            <label class="form-label">Mật khẩu admin</label>
                <input type="password" 
                       class="form-control"
                       name="admin_pass"> 
          </div>

            <label class="form-label">Mật khẩu mới </label>
            <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="new_pass"
                       id="passInput">
                <button class="btn btn-secondary"
                        id="gBtn">
                        Ngẩu nhiên</button>
            </div>
            
          </div>
          <input type="text"
                value="<?=$teacher['teacher_id']?>"
                name="teacher_id"
                hidden>

          <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu mới  </label>
                <input type="text" 
                       class="form-control"
                       name="c_new_pass"
                       id="passInput2"> 
          </div>
          <button type="submit" 
              class="btn btn-primary">
              Thay đổi</button>
        </form>
     </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
    <script>
        $(document).ready(function(){
             $("#navLinks li:nth-child(2) a").addClass('active');
        });

        function makePass(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * 
         charactersLength));

           }
           var passInput = document.getElementById('passInput');
           var passInput2 = document.getElementById('passInput2');
           passInput.value = result;
           passInput2.value = result;
        }

        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e){
          e.preventDefault();
          makePass(4);
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
	header("Location: teacher.php");
	exit;
} 

?>
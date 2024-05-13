<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
    	

if (isset($_POST['score-1']) &&
   
    isset($_POST['aoutof-1']) &&
   
    isset($_POST['student_id']) &&
    isset($_POST['subject_id']) &&
    isset($_POST['current_year']) &&
    isset($_POST['current_semester'])
    ) {
    
    include '../../db_conection.php';


    $score_1 = $_POST['score-1'];
    $aoutof_1 = $_POST['aoutof-1'];


    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $current_year = $_POST['current_year'];
    $current_semester = $_POST['current_semester'];
    $teacher_id = $_SESSION['teacher_id'];

    if(empty($score_1)  || empty($aoutof_1) ||  empty($student_id) || empty($subject_id) || empty($current_year) || empty($current_semester)){

       $em  = "All fields are required";
        header("Location: ../student-grade.php?student_id=$student_id&error=$em");
        exit;

    }else {
        $data = '';
        $limit = 0;
        if ($score_1 <= 100 && $aoutof_1 <=100 && $score_1 > 0 && $aoutof_1 > 0 && $score_1 <=  $aoutof_1)  {
            $data .= $score_1." ".$aoutof_1; 
             $limit += $aoutof_1;
        } 
        
        if (empty($data)) {
            $em  = "Đã xảy ra lỗi";
            header("Location: ../student-grade.php?student_id=$student_id&error=$em");
            exit;
        } else if($limit > 100){
            $em  = "Ngoài ranh giới";
            header("Location: ../student-grade.php?student_id=$student_id&error=$em");
            exit;
        } else {
            if (isset($_POST['student_score_id'])) {
                $sql = "UPDATE student_score SET
                        results = ?
                        WHERE  semester=?
                        AND year=? AND student_id=? AND teacher_id=? AND subject_id=?";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$data, $current_semester, $current_year, $student_id, $teacher_id, $subject_id]);
                $sm = "Điểm đã được cập nhật thành công!";
                header("Location: ../student-grade.php?student_id=$student_id&success=$sm");
                exit;
            } else {
                $sql = "INSERT INTO student_score(semester, year, student_id, teacher_id, subject_id, results)VALUES(?,?,?,?,?,?)";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$current_semester, $current_year, $student_id, $teacher_id, $subject_id, $data]);
                $sm = "Điểm đã được tạo thành công!";
                header("Location: ../student-grade.php?student_id=$student_id&success=$sm");
                exit;
            }
        }
    }
    
} else {
    $em = "An error occurred";
    header("Location: ../classes.php?error=$em");
    exit;
}

} else {
    header("Location: ../../logout.php");
    exit;
} 
} else {
    header("Location: ../../logout.php");
    exit;
} 
?>

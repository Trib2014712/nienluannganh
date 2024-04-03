<?php 
// Tất cả các lớp
function getAllGrades($conn){
   $sql = "SELECT * FROM grades";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $grades = $stmt->fetchAll();
     return $grades;
   }else {
    return 0;
   }
}

// Nhận lớp theo ID
function getGradeById($grade_id, $conn){
   $sql = "SELECT * FROM grades
           WHERE grade_id=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$grade_id]);

   if ($stmt->rowCount() == 1) {
     $grade = $stmt->fetch();
     return $grade;
   }else {
    return 0;
   }
}

// Xóa
function removeGrade($id, $conn){
   $sql  = "DELETE FROM grades
           WHERE grade_id=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}
<?php
include('../connection.php');
 //Retrieve Student Information
 $sql = "SELECT assign_teacher.id as id,teachers.teacher_name as teacher_name,courses.course_title as course_title,sections.section_name as section_name,sessions.session_name as session_name FROM assign_teacher INNER JOIN teachers on assign_teacher.teacher=teachers.id INNER JOIN courses on assign_teacher.course=courses.id INNER JOIN sections on assign_teacher.section = sections.id INNER JOIN sessions on assign_teacher.session_id= sessions.id;";
 $result = $conn -> query($sql);
 if($result->num_rows>0){
     $data = array();
     while($row= $result->fetch_assoc()){
         $data[] = $row;
     }
 }
 //Returning JSON Format Data as Response to Ajax Call
 echo json_encode($data);
?>
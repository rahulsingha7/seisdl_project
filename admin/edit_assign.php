<?php
   include ('../connection.php');
   $data = stripslashes(file_get_contents("php://input"));
   $mydata = json_decode($data,true);
   $id= $mydata['sid'];
   //Retrive Specific course Information
    $sql = "SELECT assign_teacher.id as id,teachers.teacher_name as teacher_name,courses.course_title as course_title,sections.section_name as section_name,sessions.session_name as session_name FROM assign_teacher INNER JOIN teachers on assign_teacher.teacher=teachers.id INNER JOIN courses on assign_teacher.course=courses.id INNER JOIN sections on assign_teacher.section = sections.id INNER JOIN sessions on assign_teacher.session_id= sessions.id where assign_teacher.id={$id}";
    $result = $conn ->query($sql);
    $row = $result ->fetch_assoc();
    //Returning Json Format Data as Response to Ajax call
    echo json_encode($row);
   
?>
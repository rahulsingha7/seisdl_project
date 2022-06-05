<?php
   include ('../connection.php');
   $data = stripslashes(file_get_contents("php://input"));
   $mydata = json_decode($data,true);
   $id= $mydata['sid'];
   //Retrive Specific course Information
    $sql = "SELECT * FROM sections WHERE id={$id}";
    $result = $conn ->query($sql);
    $row = $result ->fetch_assoc();
    //Returning Json Format Data as Response to Ajax call
    echo json_encode($row);
   
?>
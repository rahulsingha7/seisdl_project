<?php
include('../connection.php');
 //Retrieve Student Information
 $sql = "SELECT * FROM courses";
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
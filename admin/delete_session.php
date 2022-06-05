<?php
   include ('../connection.php');
   $data = stripslashes(file_get_contents("php://input"));
   $mydata = json_decode($data,true);
   $id= $mydata['sid'];
   //Deleting Student
if(!empty($id)){
    $sql = "DELETE FROM sessions WHERE id={$id}";
    if($conn->query($sql)==TRUE){
        echo 1;
    }
    else{
        echo 0;
    }
}
?>
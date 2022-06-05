<?php include '../connection.php'; ?>

<?php 
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);

    $id= $mydata['sid'];
    $session_name = $mydata['session_name'];

    if(!empty($session_name)){
      
        $sql ="UPDATE sessions SET session_name='$session_name' WHERE id={$id}";
       
        
        if($conn->query($sql)==TRUE){
            echo 1;
        }
        else{
            echo "Section not updated";   
        }
    }
    else{
        echo "All Fields are required";
    }

?>
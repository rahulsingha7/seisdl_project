<?php include '../connection.php'; ?>

<?php 
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);

    $id= $mydata['sid'];
    $section_name = $mydata['section_name'];

    if(!empty($section_name)){
      
        $sql ="UPDATE sections SET section_name='$section_name' WHERE id={$id}";
       
        
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
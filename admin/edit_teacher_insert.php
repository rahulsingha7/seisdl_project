<?php include '../connection.php'; ?>

<?php 
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);

    $id= $mydata['sid'];
    $teacher_name= $mydata['teacher_name'];
    $teacher_email= $mydata['teacher_email'];
    $teacher_phone= $mydata['teacher_phone'];
    

    if(!empty($teacher_name) && !empty($teacher_email) && !empty($teacher_phone)){
       
        $sql ="UPDATE teachers SET teacher_name='$teacher_name',teacher_email='$teacher_email',teacher_phone='$teacher_phone' WHERE id={$id}";
        
        if($conn->query($sql)==TRUE){
            echo 1;
        }
        else{
            echo "Course not added";   
        }
    }
    else{
        echo "All Fields are required";
    }

?>
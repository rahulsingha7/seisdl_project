<?php include '../connection.php'; ?>

<?php 
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);

    $teacher = $mydata['teacher'];
    $course = $mydata['course'];
    $section = $mydata['section'];
    $session = $mydata['session'];
  

    if(!empty($teacher) && !empty($course)&&!empty($section) && !empty($session)){
    
        $sql="INSERT INTO assign_teacher(teacher, course,section,session_id) VALUES($teacher,$course,$section,$session)";
       
        
        if($conn->query($sql)==TRUE){
            echo 1;
        }
        else{
            echo "Something Went Wrong";   
        }
    }
    else{
        echo "All Fields are required";
    }

?>
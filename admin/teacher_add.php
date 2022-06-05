<?php include '../connection.php'; ?>

<?php 
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);

    $teacher_name = $mydata['teacher_name'];
    $teacher_email = $mydata['teacher_email'];
    $teacher_phone = $mydata['teacher_phone'];

    if(!empty($teacher_name) && !empty($teacher_email) && !empty($teacher_phone)){
        $sql1 = "SELECT * FROM teachers where teacher_name='$teacher_name'";
        $sql2 = "SELECT * FROM teachers where teacher_email='$teacher_email'";
        $sql3 = "SELECT * FROM teachers where teacher_phone='$teacher_phone'";
        $sql="INSERT INTO teachers(teacher_name, teacher_email, teacher_phone) VALUES('$teacher_name','$teacher_email','$teacher_phone')";
        $r1 = mysqli_query($conn, $sql1);
        $r2 = mysqli_query($conn, $sql2);
        $r3 = mysqli_query($conn, $sql3);
        if(mysqli_num_rows($r1)>0){
            echo "Teacher name are already exist";
        }
        else if(mysqli_num_rows($r2)>0){
            echo "Teacher email are already exist";
        }
        else if(mysqli_num_rows($r3)>0){
            echo "Teacher phone no are already exist";
        }
        
       else if($conn->query($sql)==TRUE){
            echo 1;
        }
        else{
            echo "Teacher not added";   
        }
    }
    else{
        echo "All Fields are required";
    }

?>
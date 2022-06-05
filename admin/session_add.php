<?php include '../connection.php'; ?>

<?php 
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);

    $session_name = $mydata['session_name'];
    

    if(!empty($session_name)){
        $sql1 = "SELECT * FROM sessions where session_name='$session_name'";
        $sql="INSERT INTO sessions(session_name) VALUES('$session_name')";
        $r1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($r1)>0){
            echo "Session are already exist";
        }
        else if($conn->query($sql)==TRUE){
            echo 1;
        }
        else{
            echo "Session not added";   
        }
    }
    else{
        echo "All Fields are required";
    }

?>
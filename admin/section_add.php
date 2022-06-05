<?php include '../connection.php'; ?>

<?php 
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);

    $section_name = $mydata['section_name'];
    

    if(!empty($section_name)){
        $sql1 = "SELECT * FROM sections where section_name='$section_name'";
        $sql="INSERT INTO sections(section_name) VALUES('$section_name')";
        $r1 = mysqli_query($conn, $sql1);
        if(mysqli_num_rows($r1)>0){
            echo "Section are already exist";
        }
        else if($conn->query($sql)==TRUE){
            echo 1;
        }
        else{
            echo "Section not added";   
        }
    }
    else{
        echo "All Fields are required";
    }

?>
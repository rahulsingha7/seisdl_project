
<?php include '../connection.php'; ?>

<?php 
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);

    $id= $mydata['sid'];
    $student_id= $mydata['student_id'];
    $attendance=$mydata['attendance'];
    $class_test=$mydata['class_test'];
    $assignment=$mydata['assignment'];
    $mid_term=$mydata['mid_term'];
    $final=$mydata['final'];
    $assignteacher_id= $mydata['assignteacher_id'];
    $total= $mydata['total'];
    $grade= $mydata['grade'];
    $cgpa= $mydata['cgpa'];

    // if(!empty($student_id) && !empty($attendance) && !empty($class_test) && !empty($assignment) && !empty($mid_term) && !empty($_final)){      
        $sql ="UPDATE assign_marks SET  student_id='$student_id',attendance=$attendance,class_test=$class_test,assignment=$assignment,mid_term=$mid_term,final=$final,total=$total,grade='$grade',cgpa='$cgpa',assignteacher_id=$assignteacher_id WHERE id={$id}";
        if($conn->query($sql)==TRUE){
            echo 1;
        }
        else{
            echo "Marks not added";   
        }
    // }
    // else{
    //     echo "All Fields are required";
    // }

?>
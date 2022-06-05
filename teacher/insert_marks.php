<?php include '../connection.php'; ?>

<?php 
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);

   
    $student_id = $mydata['student_id'];
    $attendance=$mydata['attendance'];
    $class_test=$mydata['class_test'];
    $assignment=$mydata['assignment'];
    $mid_term=$mydata['mid_term'];
    $final=$mydata['final'];
    $assignteacher_id= $mydata['assignteacher_id'];
    $total= $mydata['total'];
    $grade= $mydata['grade'];
    $cgpa= $mydata['cgpa'];

    if(!empty($student_id) && !empty($attendance)&&!empty($class_test) && !empty($assignment)&& !empty($mid_term)&& !empty($final)){
        $a= "SELECT * FROM assign_marks WHERE student_id = '$student_id' and assignteacher_id = $assignteacher_id";
        $q = mysqli_query($conn,$a);
        $sql="INSERT INTO assign_marks(student_id,attendance,class_test,assignment,mid_term,final,total,grade,cgpa,assignteacher_id) VALUES('$student_id',$attendance,$class_test,$assignment,$mid_term,$final,$total,'$grade','$cgpa',$assignteacher_id)";
       if(mysqli_num_rows($q)>0){
           echo "This student marks already given";
       }
        
       else if($conn->query($sql)==TRUE){
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
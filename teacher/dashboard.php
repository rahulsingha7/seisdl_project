<?php
if(!isset($_SESSION)) { 
    session_start();
   
  } 
  
if ($_SESSION['teacher_login_status'] != "logged in" and isset($_SESSION['teacher_email']))
    header('Location:./dashboard.php');
    $d=  $_SESSION['teacher_email'];
//logout code

if (isset($_GET['sign']) and $_GET['sign'] == "out") {
    $_SESSION['teacher_login_status'] = "logged out";
    unset($_SESSION['teacher_email']);
    header('Location:./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--Bootstrap Cdn link-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"
    />
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
  </head>
  <body>
    <div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<!-- <div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-dark">
	            <span class="sr-only">Toggle Menu</span>
	        </button>
        </div> -->
	  		<h1><a href="./dashboard.php" class="logo">Teacher</a></h1>
        <ul class="list-unstyled components mb-5">
          
          <li>
              <a href="./dashboard.php">Dashboard</a>
          </li>
          <li >
            <a href="?sign=out">LogOut</a>
          </li>
        </ul>

    	</nav>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-10 offset-2">
        
          <div class="">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Teacher Name</th>
                  <th scope="col">Course Code</th>
                  <th scope="col">Course Title</th>
                  <th scope="col">Section</th>
                  <th scope="col">Session</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="tbody">
              <?php
                include('../connection.php');
                $d = $_SESSION['teacher_email'];
               
                $sql = "SELECT * FROM teachers WHERE teacher_email='$d'";
        
                $q=mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($q)){
                     $r= $row['id'];
                    
                }
                //Retrive Specific course Information
                    $sql = "SELECT assign_teacher.id as id, assign_teacher.course as course_id,assign_teacher.teacher as teacher_id,assign_teacher.section as section_id,assign_teacher.session_id as session_id, teachers.teacher_name as teacher_name,courses.course_code as course_code,courses.course_title as course_title,sections.section_name as section_name,sessions.session_name as session_name FROM assign_teacher INNER JOIN teachers on assign_teacher.teacher=teachers.id INNER JOIN courses on assign_teacher.course=courses.id INNER JOIN sections on assign_teacher.section = sections.id INNER JOIN sessions on assign_teacher.session_id= sessions.id where assign_teacher.teacher = $r";
                    $result = mysqli_query($conn,$sql);
                    while($s=mysqli_fetch_array($result)){
                       $name = $s['teacher_name'];
                       $course_code = $s['course_code'];
                       $course_title = $s['course_title'];
                       $section = $s['section_name'];
                       $session = $s['session_name'];
                       $course_id = $s['course_id'];
                       $teacher_id = $s['teacher_id'];
                       $section_id = $s['section_id'];
                       $session_id = $s['session_id'];
                       $id = $s['id'];
                    //    echo $name,$course_code,$course_title,$section,$session,$course_id,$teacher_id,$section_id,$session_id;
                    echo "<tr><td>$name</td>
                     <td>$course_code</td>
                     <td>$course_title</td>
                     <td>$section</td>
                     <td>$session</td>
                     <td><button class='btn btn-primary btn-sm '><a href='generate_marks.php?eid=$id' class='text-white'>Generate Marks</a></button></td>
                    </tr>";
                    }
                    
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    

    <!--Bootstrap Cdn-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <!--Jquery cdn-->
    <!-- <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
  </body>
</html>
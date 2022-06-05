<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 
if ($_SESSION['teacher_login_status'] != "logged in" and !isset($_SESSION['teacher_email']))
    header('Location:./dashboard.php');

//logout code

if (isset($_GET['sign']) and $_GET['sign'] == "out") {
    $_SESSION['teacher_login_status'] = "logged out";
    unset($_SESSION['teacher_email']);
    header('Location:./login.php');
}
?>
<?php 
 include('../connection.php');
 $m= $_REQUEST['eid'];
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
    <!--Navbar-->
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
        <div class="col-md-10">
          <button
            class="btn btn-primary mb-3"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          >
            Assign Marks
          </button>

          <!-- Modal -->
          <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                      Assign Marks
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form action="" id="myform m-2">
                    <div class="form-group mb-3">
                      <label for="">Student Id</label>
                      <input
                        type="text"
                        class="form-control"
                        id="student_id"
                      />
                    </div>
                    <div class="form-group mb-3">
                      <label for="">Attendance</label>
                      <input
                        type="text"
                        class="form-control"
                        id="attendance"
                      />
                    </div>
                    <p id="attendance_check"></p>
                    <div class="form-group mb-3">
                      <label for="">Class Test</label>
                      <input
                        type="text"
                        class="form-control"
                        id="class_test"
                      />
                    </div>
                    <p id="class_test_check"></p>
                    <div class="form-group mb-3">
                      <label for="">Assignment</label>
                      <input
                        type="text"
                        class="form-control"
                        id="assignment"
                      />
                    </div>
                    <p id="assignment_check"></p>
                    <div class="form-group mb-3">
                      <label for="">Mid Term</label>
                      <input
                        type="text"
                        class="form-control"
                        id="mid_term"
                      />
                    </div>
                    <p id="midterm_check"></p>
                    <div class="form-group mb-3">
                      <label for="">Final</label>
                      <input
                        type="text"
                        class="form-control"
                        id="final"
                      />
                    </div>
                    <p id="final_check"></p>
                  </form>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                  <button
                    type="button"
                    class="btn btn-primary"
                    id="add_marks"
                  >
                    Save
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!--Bootstrap Table-->
          <div class="">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Student Id</th>
                  <th scope="col">Attendance</th>
                  <th scope="col">Class Test</th>
                  <th scope="col">Assignment</th>
                  <th scope="col">Mid Term</th>
                  <th scope="col">Final</th>
                  <th scope="col">Total</th>
                  <th scope="col">Grade</th>
                  <th scope="col">CGPA</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="tbody"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="exampleModal2"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Marks</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
          <form action="" id="myform2 m-2">
                    <div class="form-group mb-3">
                      <label for="">Student Id</label>
                      <input
                        type="text"
                        class="form-control"
                        id="student_id_update"
                      />
                    </div>
                    <div class="form-group mb-3">
                      <label for="">Attendance</label>
                      <input
                        type="text"
                        class="form-control"
                        id="attendance_update"
                      />
                    </div>
                    <div class="form-group mb-3">
                      <label for="">Class Test</label>
                      <input
                        type="text"
                        class="form-control"
                        id="class_test_update"
                      />
                    </div>
                    <div class="form-group mb-3">
                      <label for="">Assignment</label>
                      <input
                        type="text"
                        class="form-control"
                        id="assignment_update"
                      />
                    </div>
                    <div class="form-group mb-3">
                      <label for="">Mid Term</label>
                      <input
                        type="text"
                        class="form-control"
                        id="mid_term_update"
                      />
                    </div>
                    <div class="form-group mb-3">
                      <label for="">Final</label>
                      <input
                        type="text"
                        class="form-control"
                        id="final_update"
                      />
                    </div>
                  </form>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary" id="update_marks">
              Save
            </button>
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
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="//code.jquery.com/jquery.min.js"></script>
	<script src="jquery.numbervalidation.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <script>
       
 function showdata() {
  output = "";
  $.ajax({
    url: "show_marks.php",
    method: "GET",
    dataType: "json",
    success: function (data) {
      console.log(data);
      if (data) {
        x = data;
      } else {
        x = "";
      }
      for (i = 0; i < x.length; i++) {
        output +=
          "<tr><td>" +
          x[i].id +
          "</td><td>" +
          x[i].student_id +
          "</td><td>" +
          x[i].attendance +
          "</td><td>" +
          x[i].class_test +
          "</td><td>" +
          x[i].assignment +
          "</td><td>" +
          x[i].mid_term +
          "</td><td>" +
          x[i].final +
          "</td><td>" +
          x[i].total +
          "</td><td>" +
          x[i].grade +
          "</td><td>" +
          x[i].cgpa +
          "</td><td> <button class='btn btn-warning btn-sm m-2 btn-edit' data-sid=" +
          x[i].id +
          " data-bs-toggle='modal'data-bs-target='#exampleModal2'>Edit</button><button class='btn btn-danger btn-sm btn-del' data-sid=" +
          x[i].id +
          ">Delete</button></td></tr>";
      }

      $("#tbody").html(output);
    },
  });
}
showdata();
$(document).ready(function () {
  //Insert data
  var t= <?php echo json_encode($m);?>;
  var parse_t= parseInt(t);

  $("#add_marks").click(function (e) {
    e.preventDefault();
    var student_id= $("#student_id").val();
    var atd = $("#attendance").val();
    var attendance = parseInt(atd);
    var ct = $("#class_test").val();
    var class_test = parseInt(ct);
    var as = $("#assignment").val();
    var assignment = parseInt(as);
    var mt = $("#mid_term").val();
    var mid_term = parseInt(mt);
    var finalexam = $("#final").val();
    var final = parseInt(finalexam);
    var total = (attendance+class_test+assignment+mid_term+final);
    if(total >=80 && total<=100){
        var grade ="A+";
        var cgpa = "4";
    }
   else if(total >=75 && total<80){
        var grade ="A";
        var cgpa = "3.75"
    }
   else if(total >=70 && total<75){
        var grade ="A-";
        var cgpa= "3.50";
    }
   else if(total >=65 && total<70){
        var grade ="B+";
        var cgpa= "3.25";
    }
   else if(total >=60 && total<65){
        var grade ="B";
        var cgpa= "3.00";
    }
   else if(total >=55 && total<60){
        var grade ="B-";
        var cgpa= "2.75";
    }
   else if(total >=50 && total<55){
        var grade ="C+";
        var cgpa= "2.50";
    }
   else if(total >=45 && total<50){
        var grade ="C";
        var cgpa= "2.25";
    }
   else if(total >=40 && total<45){
        var grade ="D";
        var cgpa= "2.00";
    }
   else if (total>=0 && total<40){
    var grade ="F";
    var cgpa= "0.00";
   }

    var marks_data = { student_id: student_id,attendance:attendance,class_test:class_test,assignment:assignment,mid_term:mid_term,final:final,assignteacher_id:parse_t,total:total,grade:grade,cgpa:cgpa};
    console.log(marks_data);
    $.ajax({
      url: "insert_marks.php",
      method: "POST",
      data: JSON.stringify(marks_data),
      success: function (data) {
          console.log(data);
        showdata();
        if (data == 1) {
          $("#exampleModal").modal("hide");
          alertify.set("notifier", "position", "top-right");
          alertify.success("marks added successfully");
          $("#myform")[0].reset();
          showdata();
        } else {
          alertify.set("notifier", "position", "top-right");
          alertify.success(data);
        }
      },
    });
  });

  //Ajax  Request for Deleting Data
  $("tbody").on("click", ".btn-del", function () {
    console.log("Delete Button Clicked");
    let id = $(this).attr("data-sid");
    // console.log(id);
    mydata = { sid: id };
    mythis = this;
    $.ajax({
      url: "delete_marks.php",
      method: "POST",
      data: JSON.stringify(mydata),
      success: function (data) {
        // console.log(data);
        if (data == 1) {
          alertify.set("notifier", "position", "top-right");
          alertify.success("Session deleted successfully");
          $(mythis).closest("tr").fadeOut();
        } else if (data == 0) {
          alertify.set("notifier", "position", "top-right");
          alertify.success("Session not deleted");
        }
        showdata();
      },
    });
  });

  $("tbody").on("click", ".btn-edit", function () {
    console.log("marks edit Button Clicked");
    var id = $(this).attr("data-sid");
    console.log(id);
    // console.log(id);
    mydata = { sid: id };
    $.ajax({
      url: "edit_marks.php",
      method: "POST",
      dataType: "json",
      data: JSON.stringify(mydata),
      success: function (data) {
        console.log(data.student_id);
        $("#student_id_update").val(data.student_id);
        $("#attendance_update").val(data.attendance);
        $("#class_test_update").val(data.class_test);
        $("#assignment_update").val(data.assignment);
        $("#mid_term_update").val(data.mid_term);
        $("#final_update").val(data.final);
      },
    });

    //update section
    $("#update_marks").click(function (e) {
      e.preventDefault();
      console.log("update");
     var student_id= $("#student_id_update").val();
     var atd = $("#attendance_update").val();
     var attendance = parseInt(atd);
     var ct = $("#class_test_update").val();
     var class_test = parseInt(ct);
     var as = $("#assignment_update").val();
     var assignment = parseInt(as);
     var mt = $("#mid_term_update").val();
     var mid_term = parseInt(mt);
     var finalexam = $("#final_update").val();
     var final = parseInt(finalexam);
     var total = (attendance+class_test+assignment+mid_term+final);
    if(total >=80 && total<=100){
        var grade ="A+";
        var cgpa = "4";
    }
   else if(total >=75 && total<80){
        var grade ="A";
        var cgpa = "3.75"
    }
   else if(total >=70 && total<75){
        var grade ="A-";
        var cgpa= "3.50";
    }
   else if(total >=65 && total<70){
        var grade ="B+";
        var cgpa= "3.25";
    }
   else if(total >=60 && total<65){
        var grade ="B";
        var cgpa= "3.00";
    }
   else if(total >=55 && total<60){
        var grade ="B-";
        var cgpa= "2.75";
    }
   else if(total >=50 && total<55){
        var grade ="C+";
        var cgpa= "2.50";
    }
   else if(total >=45 && total<50){
        var grade ="C";
        var cgpa= "2.25";
    }
   else if(total >=40 && total<45){
        var grade ="D";
        var cgpa= "2.00";
    }
   else if (total>=0 && total<40){
    var grade ="F";
    var cgpa= "0.00";
   }

     var marks_data = {sid: id, student_id: student_id,attendance:attendance,class_test:class_test,assignment:assignment,mid_term:mid_term,final:final,assignteacher_id:parse_t,total:total,grade:grade,cgpa:cgpa};
    console.log(marks_data);
      
      $.ajax({
        url: "edit_marks_insert.php",
        method: "POST",
        data: JSON.stringify(marks_data),
        success: function (data) {
          console.log(data);
            // showdata();
          if (data == 1) {
            $("#exampleModal2").modal("hide");
            alertify.set("notifier", "position", "top-right");
            alertify.success("Marks updated successfully");
            // $("#myform2")[0].reset();
            showdata();
          } else {
            alertify.set("notifier", "position", "top-right");
            alertify.success(data);
          }
        },
      });
    });
  });

  // update course
});
  
    </script>
    	<script type="text/javascript">
      $("#attendance").masknumber({
	  rules:{
	    type:'integer',
	    required:true,
	    minvalue:0,

	    maxvalue:10
	  },
	  messages:{
	    type:"The value is not integer",
	    required:"The value is required",
	    minvalue:"The value is less than 0",
	    maxvalue:"The value is greater than 10"
	  },
	});
    </script>
  </body>
</html>
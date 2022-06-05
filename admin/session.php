<?php
if (isset($_GET['sign']) and $_GET['sign'] == "out") {
    $_SESSION['admin_login_status'] = "logged out";
    unset($_SESSION['id']);
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
	  		<h1><a href="./teacher.php" class="logo">Admin</a></h1>
        <ul class="list-unstyled components mb-5">
          
          <li>
              <a href="./teacher.php">Teacher</a>
          </li>
          <li >
            <a href="./course.php">Course</a>
          </li>
          <li >
            <a href="./section.php">Section</a>
          </li>
          <li >
            <a href="./session.php">Session</a>
          </li>
          <li >
            <a href="./assign.php">Assign Teacher</a>
          </li>
          <li >
            <a href="?sign=out">LogOut</a>
          </li>
        </ul>

    	</nav>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-8 offset-2">
          <button
            class="btn btn-primary mb-3"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          >
            Add Session
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
                    Session Add
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
                      <label for="">Session Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="session_name"
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
                  <button
                    type="button"
                    class="btn btn-primary"
                    id="session_add"
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
                  <th scope="col">Session Name</th>
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
            <h5 class="modal-title" id="exampleModalLabel">Update Session</h5>
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
                <label for="">Session Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="session_name_update"
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
            <button type="button" class="btn btn-primary" id="update_session">
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
    <!-- <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script> -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./session.js"></script>
  </body>
</html>
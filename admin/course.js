function showdata() {
    output = "";
    $.ajax({
      url: "retrieve.php",
      method: "GET",
      dataType: "json",
      success: function (data) {
        // console.log(data);
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
            x[i].course_code +
            "</td><td>" +
            x[i].course_title +
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
  
    $("#add_course").click(function (e) {
      e.preventDefault();
      var course_code = $("#course_code").val();
      var course_title = $("#course_title").val();
      console.log(course_code, course_title);
  
      var course_data = { course_code: course_code, course_title: course_title };
      $.ajax({
        url: "insert.php",
        method: "POST",
        data: JSON.stringify(course_data),
        success: function (data) {
            showdata();
          if (data == 1) {
            $("#exampleModal").modal("hide");
            alertify.set("notifier", "position", "top-right");
            alertify.success("Course added successfully");
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
        url: "delete_course.php",
        method: "POST",
        data: JSON.stringify(mydata),
        success: function (data) {
          // console.log(data);
          if (data == 1) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Course deleted successfully");
            $(mythis).closest("tr").fadeOut();
          } else if (data == 0) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Course not deleted");
          }
          showdata();
        },
      });
    });
    $("tbody").on("click", ".btn-edit", function () {
      console.log("Edit Button Clicked");
      var id = $(this).attr("data-sid");
      console.log(id);
      // console.log(id);
      mydata = { sid: id };
      $.ajax({
        url: "edit_course.php",
        method: "POST",
        dataType: "json",
        data: JSON.stringify(mydata),
        success: function (data) {
          console.log(data);
  
          $("#course_code_update").val(data.course_code);
          $("#course_title_update").val(data.course_title);
        },
      });
  
      //update course
      $("#update_course").click(function (e) {
        e.preventDefault();
        console.log("update");
  
        console.log(id);
        var course_code = $("#course_code_update").val();
        var course_title = $("#course_title_update").val();
        console.log(course_code, course_title);
  
        var course_data = {
          sid: id,
          course_code: course_code,
          course_title: course_title,
        };
        $.ajax({
          url: "edit_insert.php",
          method: "POST",
          data: JSON.stringify(course_data),
          success: function (data) {
            console.log(data);
            //   showdata();
            if (data == 1) {
              $("#exampleModal2").modal("hide");
              alertify.set("notifier", "position", "top-right");
              alertify.success("Course updated successfully");
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
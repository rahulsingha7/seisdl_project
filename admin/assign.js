function showdata() {
    output = "";
    $.ajax({
      url: "show_assign.php",
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
            x[i].teacher_name +
            "</td><td>" +
            x[i].course_title +
            "</td><td>" +
            x[i].section_name +
            "</td><td>" +
            x[i].session_name +
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
  
    $("#add_assign").click(function (e) {
        // console.log("button clicked");
      e.preventDefault();
      var teacher_add = $("#select_teacher").val();
      var teacher = parseInt(teacher_add);
      var course_Add = $("#select_course").val();
      var course = parseInt(course_Add);
      var section_add = $("#select_section").val();
      var section = parseInt(section_add);
      var session_Add = $("#select_session").val();
      var session = parseInt(session_Add);
    //   console.log(teacher,course,section,session);
      var assign_data = {teacher: teacher,course:course,section:section,session:session}; 
      $.ajax({
        url: "assign_insert.php",
        method: "POST",
        data: JSON.stringify(assign_data),
        success: function (data) {
            showdata();
            console.log(data);
          if (data == 1) {
            $("#exampleModal").modal("hide");
            alertify.set("notifier", "position", "top-right");
            alertify.success("Teacher assigned successfully");
            $("#myform")[0].reset();
            showdata();
          } else {
            alertify.set("notifier", "position", "top-right");
            alertify.success(data);
          }
        },
      });
    });
  
    // Ajax  Request for Deleting Data
    $("tbody").on("click", ".btn-del", function () {
      console.log("Delete Button Clicked");
      let id = $(this).attr("data-sid");
      // console.log(id);
      mydata = { sid: id };
      mythis = this;
      $.ajax({
        url: "delete_assign.php",
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
      mydata = { sid: id };
      $.ajax({
        url: "edit_assign.php",
        method: "POST",
        dataType: "json",
        data: JSON.stringify(mydata),
        success: function (data) {
          console.log(data);
  
          // $("#teacher_update").val(data.teacher);
          // $("#course_update").val(data.course);
          // $("#section_update").val(data.section);
          // $("#session_update").val(data.session);
        },
      });
  
      //update assign
      $("#update_assign").click(function (e) {
        e.preventDefault();
        console.log("update");
  
        console.log(id);
        var teacher_update = $("#teacher_update").val();
        var teacher = parseInt(teacher_update);
        var course_update = $("#course_update").val();
        var course = parseInt(course_update);
        var section_update = $("#section_update").val();
        var section = parseInt(section_update);
        var session_update = $("#session_update").val();
        var session = parseInt(session_update);
        console.log(teacher,course,section,session);
  
        var assign_data = {
          sid: id,
          teacher: teacher,
          course: course,
          section: section,
          session: session,
        };
        $.ajax({
          url: "edit_assign.php",
          method: "POST",
          data: JSON.stringify(assign_data),
          success: function (data) {
            console.log(data);
            //   showdata();
            if (data == 1) {
              $("#exampleModal2").modal("hide");
              alertify.set("notifier", "position", "top-right");
              alertify.success("Assign Teacher updated successfully");
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
  
    // update assign
  });
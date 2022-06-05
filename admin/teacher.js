function showdata() {
    output = "";
    $.ajax({
      url: "show_teacher.php",
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
            x[i].teacher_name +
            "</td><td>" +
            x[i].teacher_email +
            "</td><td>" +
            x[i].teacher_phone +
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
  
    $("#add_teacher").click(function (e) {
      e.preventDefault();
      var teacher_name = $("#teacher_name").val();
      var teacher_email = $("#teacher_email").val();
      var teacher_phone = $("#teacher_phone").val();
      console.log(teacher_name, teacher_email, teacher_phone);
  
      var teacher_data = {
        teacher_name: teacher_name,
        teacher_email: teacher_email,
        teacher_phone: teacher_phone,
      };
      $.ajax({
        url: "teacher_add.php",
        method: "POST",
        data: JSON.stringify(teacher_data),
        success: function (data) {
          showdata();
          if (data == 1) {
            $("#exampleModal").modal("hide");
            alertify.set("notifier", "position", "top-right");
            alertify.success("Teacher added successfully");
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
        url: "delete_teacher.php",
        method: "POST",
        data: JSON.stringify(mydata),
        success: function (data) {
          // console.log(data);
          if (data == 1) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Teacher deleted successfully");
            $(mythis).closest("tr").fadeOut();
          } else if (data == 0) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Teacher not deleted");
          }
          showdata();
        },
      });
    });
    $("tbody").on("click", ".btn-edit", function () {
      console.log("Edit teacher Button Clicked");
      var id = $(this).attr("data-sid");
      console.log(id);
      // console.log(id);
      mydata = { sid: id };
      $.ajax({
        url: "edit_teacher.php",
        method: "POST",
        dataType: "json",
        data: JSON.stringify(mydata),
        success: function (data) {
          console.log(data);
  
          $("#teacher_name_update").val(data.teacher_name);
          $("#teacher_email_update").val(data.teacher_email);
          $("#teacher_phone_update").val(data.teacher_phone);
        },
      });
  
      //update course
      $("#update_teacher").click(function (e) {
        e.preventDefault();
        console.log("update teacher");
  
        console.log(id);
        var teacher_name = $("#teacher_name_update").val();
        var teacher_email = $("#teacher_email_update").val();
        var teacher_phone = $("#teacher_phone_update").val();
  
        console.log(teacher_name, teacher_email, teacher_phone);
  
        var teacher_data = {
          sid: id,
          teacher_name: teacher_name,
          teacher_email: teacher_email,
          teacher_phone: teacher_phone,
        };
        $.ajax({
          url: "edit_teacher_insert.php",
          method: "POST",
          data: JSON.stringify(teacher_data),
          success: function (data) {
            console.log(data);
            //   showdata();
            if (data == 1) {
              $("#exampleModal2").modal("hide");
              alertify.set("notifier", "position", "top-right");
              alertify.success("Teacher updated successfully");
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
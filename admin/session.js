function showdata() {
    output = "";
    $.ajax({
      url: "show_session.php",
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
  
    $("#session_add").click(function (e) {
      e.preventDefault();
      var session_name = $("#session_name").val();
  
      console.log(session_name);
  
      var session_data = { session_name: session_name };
      $.ajax({
        url: "session_add.php",
        method: "POST",
        data: JSON.stringify(session_data),
        success: function (data) {
          showdata();
          if (data == 1) {
            $("#exampleModal").modal("hide");
            alertify.set("notifier", "position", "top-right");
            alertify.success("Session added successfully");
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
        url: "delete_session.php",
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
      console.log(" session edit Button Clicked");
      var id = $(this).attr("data-sid");
      console.log(id);
      // console.log(id);
      mydata = { sid: id };
      $.ajax({
        url: "edit_session.php",
        method: "POST",
        dataType: "json",
        data: JSON.stringify(mydata),
        success: function (data) {
          console.log(data);
          $("#session_name_update").val(data.session_name);
        },
      });
  
      //update section
      $("#update_session").click(function (e) {
        e.preventDefault();
        console.log("update");
  
        console.log(id);
        var session_name = $("#session_name_update").val();
  
        console.log(session_name);
  
        var session_data = {
          sid: id,
          session_name: session_name,
        };
        $.ajax({
          url: "edit_session_insert.php",
          method: "POST",
          data: JSON.stringify(session_data),
          success: function (data) {
            console.log(data);
            //   showdata();
            if (data == 1) {
              $("#exampleModal2").modal("hide");
              alertify.set("notifier", "position", "top-right");
              alertify.success("Session updated successfully");
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
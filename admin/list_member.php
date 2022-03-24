<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Project</title>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <!-- font awsome cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- datatable css -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <!-- custome css -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
<style>
    .content 
    {
        padding: 50px;
    }

</style>
<div class="content">
<div class="container">
    <!-- Update Project     -->
  <table class="table table-striped">
    <h1 style="font-weight: bold;">LIST STAFF</h1>
    <hr>
  <thead>
    <tr>
      <th scope="col">ID User</th>
      <th scope="col">Username</th>
      <th scope="col">Full Name</th>
      <th scope="col">Level Account</th>
      <th scope="col">Select Level</th>
      <th scope="col" style="padding-left: 4.5em;">ACTION</th>
    </tr>
  </thead>
  <?php 
    include_once('./dbh.php');
    $query = "SELECT * FROM user";
    $result_member = $conn -> query($query);
    if($result_member -> num_rows > 0){
      while($row = $result_member -> fetch_assoc()){
        $uid = $row['id_user'];
        echo 
        "<form method='GET' action='./updateLevel.php' id='formUpdateLevel'>
          <tr>
            <td name='uid'>".$row['id_user']."</td>
            <td name='username'>".$row['username']."</td>
            <td name='fullname'>".$row['fullname']."</td>

            <td name='level'>".$row['level']."</td>
            <td>
              <select class='form-select' name='level'>
                "."<option hidden>".'Select'."</option>."."
                "."<option name='ad' value='1'> Admin </option>."."
                "."<option name='man' value='2'> Manager </option>."."
                "."<option name='mem' value='3'> Member </option>."."
              </select>"
            ."</td>
            <td>
            <button type='submit' class='btn btn-success' name='updateLevel' >
              UPDATE
            </button>

            <button class='btn btn-primary' type='submit'>
              <a href='./member_detail.php?id=$row[id_user]' style='color:white; text-decoration:none'>VIEW DETAIL</a>
            </button>
            </td>
          </tr>
        </form>";
      }
      echo "</table>";
    }
    else{
      echo "0 result";
    }
  ?>
  </tbody> 
</table>
<div style="text-align: center">
  <button class="btn btn-danger">
   <a href="./index002.php" style="text-decoration: none; color: white;"> CLOSE </a>
  </button>
</div>
</div>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- database js -->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
<!-- Triggering data table -->
</body>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Create Task</title>

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
  .content {
  padding: 50px;
  }
</style>
<div class="content">
<div class="container">
    <form action="./insert_task.php" method="POST" class="content">
      <h1 style="text-align: center; font-weight: bold;">CREATE TASK</h1>
        <div class="row align-items-center">
          <div class="mb-3">
            <label for="task_name" class="form-label" style="font-weight: bold;">Task Name</label>
            <input type="text" name="task_name" class="form-control" id="task_name">
          </div>

          <div class="modal-body">
          <label for="task_name" class="form-label" style="font-weight: bold;">Task Description</label>
              <textarea class="form-control" name="task_des" id="task_des"  rows="10" cols="55" >Description</textarea>
          </div>

          <div class="mb-3">
            <label for="task_pri" class="form-label" style="font-weight: bold;">Priority (0: important, 1: not important)</label>
            <select name="task_pri" class= "form-select form-select-lg mb-3">
              <option>0</option>
              <option>1</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="task_project" class="form-label" style="font-weight: bold;">Project</label>
            <select name="task_project" class= "form-select form-select-lg mb-3">
              <?php
                require_once('./dbh.php');
                $result_project = $conn->query("SELECT * FROM project");
                while($row=$result_project->fetch_assoc())
                {
                  echo "<option value=".$row['id_project'].">".$row['project_name']."</option>";
                }  
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="task_user" class="form-label" style="font-weight: bold;">Member Assign</label>
            <select name="task_user" class= "form-select form-select-lg mb-3">
              <?php
                require_once('./dbh.php');
                $result_user = $conn->query("SELECT * FROM user");
                while($row=$result_user->fetch_assoc())
                {
                  echo "<option value=".$row['id_user'].">".$row['username']." | ".$row['fullname']."</option>";
                }  
              ?>
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Confirm</button>
          </div>
          <div >
            <a href="./index002.php">CLOSE</a>
          </div>
          
    </form>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- database js -->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
<!-- Triggering data table -->
</body>
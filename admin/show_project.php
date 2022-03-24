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
    <form class="content" id="formUpdateProject" action="updateProject.php" method="POST"> 
    
    <?php
            require_once('./dbh.php');
            $id_project = $_REQUEST['pro_id'];
            $name_project = $_REQUEST['pro_name'];
            $result_project = $conn->query("SELECT * FROM project WHERE id_project='$id_project'");
            $row_project = $result_project->fetch_assoc();
                $name_project = $row_project['project_name'];
                $project_des = $row_project['project_des'];
    ?>

    <h1 style="text-align: center;"><?php echo $name_project?></h1>
        <div class="row align-items-center">
            <div class="mb-3">
                <input hidden type="text" name="id_project" readonly value="<?=$id_project?>">
                <label for="name_project" class="form-label">Name:</label>
                <input type="text" name="name_project" class="form-control" value="<?=$name_project?>">
            </div>

            <div class="modal-body">
                <label for="des_project" class="form-label">Description:</label>
                <textarea class="form-control" name="des_project" rows="10" cols="55"><?=$project_des?></textarea>
            </div>
          <a href="index002.php" style="text-decoration: none;">CLOSE</a> 
        </div>
    <button type="submit" form="formUpdateProject" class="btn btn-success" name="updateProject" style="float: right;">
        UPDATE
    </button>
    <button class="btn btn-danger" style="float: right;">
        <a href="deleteProject.php?id=<?php echo $id_project ?>" style="text-decoration: none; color: white">DELETE</a>
    </button>
    </form>
    <!-- Update Project     -->

</div>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- database js -->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
<!-- Triggering data table -->
</body>




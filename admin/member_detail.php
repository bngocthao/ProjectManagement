<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="./style.css">
<?php include_once "./header.php"; ?>
    <title>member detail</title>
</head>
<body>

<h1 style="font-weight: bold;">STAFF INFOMATION</h1>
        <hr>
<div class="container">
  <div class="row">
    <div class="col-4">
      <?php
        include_once 'dbh.php';
        $mem_id_user = $_REQUEST['id'];
        $user_info = $conn -> query("SELECT * FROM user where id_user = '$mem_id_user'");
        // $user_task = $conn -> query("");
        if($user_info -> num_rows >0):
            while($row = $user_info->fetch_assoc()):
                $fullname = $row['fullname'];
                $phone = $row['phone'];
                $level = $row['level'];
                $username = $row['username'];
                $email = $row['email'];
                $birthday = $row['birthday'];
                $address = $row['address'];
                $gender = $row['gender'];
                ?>
                <p>Name: <?=$fullname?> <br>
                Username: <?=$username?> <br>
                Gender: <?=$gender?> <br>
                Phone number: <?=$phone?> <br>
                role: <?php if($level == 1){
                        echo 'Admin';
                        }elseif($level == 2){
                        echo 'Manager';
                        }else{ echo 'Member';}?><br>
                Email: <?=$email?> <br>
                Birthday: <?=$birthday?> <br>
                Address: <?=$address?> <br> </p>
            <?php endwhile;?>
        <?php endif;
      ?>
    </div>
    <div class="col-8">
        <table class="table table-hover">
        <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">Task Name</th>
    <th scope="col">Project Belong</th>
    <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    $result_task_info = $conn -> query("SELECT task.task_name, task.completed, project.project_name,task.id_task
                                        FROM task
                                        JOIN project
                                        ON task.id_project = project.id_project
                                        WHERE task.id_user = '$mem_id_user';");
    // $result_task = $conn->query("SELECT task_name from task where id_user = '$mem_id_user'");      
    // $result_project = $conn->query("SELECT project_name from project where  = '$mem_id_user'");
    if($result_task_info -> num_rows >0):
      while($row = $result_task_info->fetch_assoc()):
        echo '<tr>';
        echo '<th scope="row">'.$i.'</th>';
        $i++;
        echo '<td>' .$row["task_name"]. '</td>';
        echo '<td>' .$row["project_name"]. '</td>';
        echo '<td>'; 
          if($level == 0){
          echo 'Not Completed';
          }else{
          echo 'Completed';}
        echo '</td>';
        echo '</tr>';
      endwhile;
      endif;
          ?>
    </table> 
    </div>
  </div>
</div>
  <?php include_once "./footer.php"; ?>
</body>
</html>



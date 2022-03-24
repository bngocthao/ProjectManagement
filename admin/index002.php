<?php
  if(!isset($_COOKIE['login_user']))
  {
      header('Location: ./login.php');
  }
  require_once('./dbh.php');

  $id_user = $_COOKIE['login_user'];
  $result_login = $conn->query("SELECT * FROM user WHERE id_user = '$id_user'");

  $row = $result_login->fetch_assoc();
  $hoten = $row['fullname'];
  $level = $row['level'];
  $username = $row['username'];
  $email = $row['email'];
  $phone = $row['phone'];
  $address = $row['address'];
  $brithday = $row['birthday'];
  $gender = $row['gender'];

  if(isset($_COOKIE['register_noti']))
  {
    alert($_COOKIE['register_noti']);
  }
  

?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Manager page</title>
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

<div class="container-fluid py-2">
  <div class="row justify-content-between">
      <!-- SLIDEBAR -->
      <div class="col-xl-2 openSideMenu" id="sidemenu" style="background-color: white; height: 485px;">
        <h3 class="text-center fw-bolder" 
            style="font-family: 'pacifico', cursive; letter-spacing: 2px; margin-top: 27px;"> 
            Welcome
        </h3>
        <hr>
      <!-- CREATE NEW PROJECT -->
      <?php if($level == 1):?>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#project" style="margin-top: 15px;">
        <i class="fas fa-plus"></i>
            Create New Project 
        </button>
      <?php endif;?>
      
  <!-- MODAL CREATE NEW PROJECT -->
  <form action="addProject.php" method="post">
      <div class="modal fade" id="project" tabindex="-1" aria-labelledby="projectLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="projectLabel">New Project</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="mb-3">
                    <label for="nProject" class="form-label">Project name</label>
                    <input type="text" name="project_name" class="form-control" id="nProject" aria-describedby="projectName">
                  </div>
                  <label for="nProject" class="form-label">Project Description</label>
                  <div class="input-group mb-3">
                    <textarea class="form-control" name="project_des" aria-label="With textarea" placeholder="Description"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="nDeadline" class="form-label">Deadline</label>
                    <input type="date" name="deadline_project" class="form-control" id="deadline_project">
                  </div>

                  <label for="selectLeader">Leader</label>
                    <select name="leader_project" id="leader_project" required>
                      <?php
                        $result_level = $conn->query("SELECT * FROM user WHERE level<>1");
                        while($row=$result_level->fetch_assoc())
                        {
                          echo "<option value=".$row['id_user'].">".$row['fullname']."</option>";
                        }  
                      ?>
                    </select>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Add Project</button>
              </div>
          </div>
        </div>
      </div>
  </form>
    <!-- END MODAL CREATE NEW PROJECT -->

        <!-- PROJECT LIST -->
        <div class="container-fluid.p-0">
          <h5 class="fw-bold" style="margin-top: 20px;">Project List</h5>
          <hr style="height: 5px; margin-top: 0px;">
          <ul class="project_list p-0" style="height: 15rem;">

          <?php
            if($level == 1){
              $project_list = $conn->query("SELECT * FROM project");
            }else if($level == 2){
              $project_list = $conn->query("SELECT * 
                                            FROM project
                                            WHERE leader='$id_user'");
            }else{
              $project_list = $conn->query("SELECT a.* 
                                            FROM project as a
                                            LEFT JOIN task as b ON a.id_project=b.id_project
                                            WHERE b.id_user='$id_user'");
            }
            
            while($row=$project_list->fetch_assoc()):
              // if($level == 1){    
          ?>       
              <!-- <li><a href="javascript:void()" onclick="show_detailProject(<?=$row['id_project']?>, <?=$level?>)"><?=$row['project_name']?> &nbsp;</a>                       
                <a href="./show_project.php?pro_id=<?=$row['id_project']?>&pro_name=<?=$row['project_name']?>">
                <?php if($level == 1):?> 
                <i class="fa fa-edit"></i>
                </a>
                <?php endif;?>
              </a></li> -->
              
              <li><a href="javascript:void()" onclick="show_detailProject(<?=$row['id_project']?>, <?=$level?>)"><?=$row['project_name']?> &nbsp;
                <a href="./show_project.php?pro_id=<?=$row['id_project']?>&pro_name=<?=$row['project_name']?>">
                <?php if($level == 1):?>
                  <i class="fa fa-edit"></i>
                </a>
                <?php endif; ?>
                <a href="./show_process.php?pro_id=<?=$row['id_project']?>">
                <?php if($level == 1):?>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                  </svg>
                </a>
                <?php endif;?>
              </a></li>

          <?php
              // }
            endwhile; 
          ?>
          <script>
            function show_detailProject(id_project, level){
              $.ajax({
                  type: "post",
                  url: './showDetailProject_ajax.php',
                  data:{
                      id_project: id_project,
                      level: level,
                      showtask: true,
                  },
                  success: function(result){
                      $('#show_task_project').html(result);
                  }
              });
          }
          </script>
          </ul> 
        </div>
          <!-- END PROJECT LIST -->

      <!-- CREATE ACCOUNT -->
        <?php if($level == 1):?>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#promote">
            <i class="fas fa-user"></i>
              Member
          </button>
        <?php endif;?>
              
      <div class="container-fluid.p-0">  
          <!-- Doc Modal -->
        <div class="modal fade"  id="promote" tabindex="-1" aria-labelledby="promoteLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" style="width:100%">
            <div class="modal-content" style="width: 365px; justify-content: center; margin-left: 300px;">
              <div class="modal-header">
                <h5 class="modal-title" id="promoteLabel" style="font-weight: bold; color: darkcyan;">ADD ACCOUNT USER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
                <form action="./insert-user.php" method="post" id="resigter_form" onsubmit="return checkSubmitRegister()">
                  <!-- SELECT LEVEL ACCOUNT -->
                  <div>
                    <label for="selectLevel" style="font-weight: bold;">Full Name</label>
                    <input type="text" style="border-radius: 10px; height: 40px; display: block; margin-bottom: 10px; text-align: center; width: 100%;" name="fullname" required placeholder="Enter Full Name">
                  </div>

                  <div>
                    <label for="selectLevel" style="font-weight: bold;">Username</label>
                    <input type="text" 
                      style="border-radius: 10px; height: 40px; display: block; margin-bottom: 10px; text-align: center; width: 100%;" name="username" 
                        required placeholder="Enter Username">
                  </div>

                  <div>
                    <label for="selectLevel" style="font-weight: bold;">Password</label>
                    <input type="password" 
                      style="border-radius: 10px; height: 40px; display: block; margin-bottom: 10px; text-align: center; width: 100%;" name="password" id="pass"
                        required placeholder="Enter Password">
                  </div>

                  <div>
                    <label for="selectLevel" style="font-weight: bold;">Re-Password</label>
                    <input type="password" 
                      style="border-radius: 10px; height: 40px; display: block; margin-bottom: 10px; text-align: center; width: 100% " name="re_pass" id="re_pass" 
                        required placeholder="Confirm Password">
                  </div>

                  <label for="selectLevel" style="font-weight: bold;">Level Account</label>
                  <select name="level" id="level" class="form-select" required>
                    <?php
                      $result_level = $conn->query("SELECT * FROM level");
                      while($row=$result_level->fetch_assoc())
                      {
                        echo "<option value=".$row['id_level'].">".$row['level_name']."</option>";
                      }  
                    ?>
                  </select>
                  <p id="err_pass" style="color: red"></p>
                </form>
              </div>

              <!-- MODLA MEMBER IN TASK --> 
                <div class="modal-footer">
                  <a href="list_member.php">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">List Member</button>
                  </a>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  <button type="submit" form="resigter_form" class="btn btn-success">Add</button>
                </div>
              <!-- END MODLA MEMBER IN TASK --> 
              <!-- END CREATE ACCOUNT -->  
            </div>
          </div>
        </div>
  </div>
  </div>
  
      <!-- main -->
      <div class="col-xl-10" id="main">
        <div class="row py-3 mb-2 m-0 rounded-3" style="background-color: white;">
          <div class="col-sm-1 d-flex justfy-content-center my-2">
            <!-- hamburger-->
            <button id="hamburger"><i class="fas fa-bars"></i></button>
          </div>
          <div class="col-sm-9 d-flex justify-content-center my-2">
            <!-- Project title -->
            <h2 class="m-0">Daily tasks</h2>
          </div>

          <div class="col-sm-2 d-flex justfy-content-center my-2">

            <a href="javascript:void();"id="user_login"><i class="fa fa-user"></i> <?=$hoten?></a>
            <div class="user_dropdown">
                <ul>
                  <a href="javascript:void();" data-bs-toggle="modal" data-bs-target="#editProfile">
                    <li>Profile</li>
                  </a>
                  <a href="./logout.php">
                    <li>Log out</li>
                  </a>
                </ul>          
            </div>
          </div>
        </div>
        <div class="dashboad p-4" style="background-color: white;">

  <!-- TABLE TASK LIST -->
  
  <h2 style="margin-top: 20px;"> <i class="fas fa-clipboard" style="color: darkred;"></i> ROLE DESCRIPTION </h2><hr>
  
  <!-- PRIORITY ABD PROCESS NOTE -->
  <div class="showProject_header" style="display: flex">
    <p>Priority: <br> 
      <i class="fas fa-check" style="color: green;"></i> Important: 1 <br> 
      <i class="fas fa-times" style="color: red;"></i>  Not important: 0 <br> 
      Process: <br> 
      <i class="fas fa-check" style="color: green"></i> Complete: 1 <br> 
      <i class="fas fa-times" style="color: red"></i> Not complete: 0
    </p>
    <div id="show_info_project" style="margin:auto">
        <p style="font-weight: bold;">ID: <span style="font-weight: 100;">??????</span></p>
        <p style="font-weight: bold;">Project Name: <span style="font-weight: 100;">??????</span></p>
        <p style="font-weight: bold;">Description: <span style="font-weight: 100;">??????</span></p>
        <p style="font-weight: bold;">Leader: <span style="font-weight: 100;">??????</span></p>
        <p style="font-weight: bold;">Deadline: <span style="font-weight: 100;">??????</span></p>
        <p style="font-weight: bold;">Created at: <span style="font-weight: 100;">??????</span></p>
    </div>

  </div>
  <!-- END PRIORITY ABD PROCESS NOTE -->
      <!-- CREATE TASK -->
      <?php if($level == 1 || $level == 2):?>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <i class="fas fa-plus-square me-2"></i>
          <a href="./create_task.php" style="text-decoration: none; color: white;">Create task</a>
        </button>
    <?php endif;?>
    <!-- END CREATE TASK -->
      <table class="table table-borderless my-4" id="mytable">
       
        <thead>
          <tr class="table-success">
            <th scope="col">Task ID</th>
            <th scope="col" style="padding-left: 8em">Task Name</th>
            <!-- <th scope="col">Project Name</th> -->
            <th scope="col">Task Description</th>
            <th scope="col">Staff</th>
            <th scope="col">Priority</th>
            <?php if($level == 3):?>
            <th scope="col">Completed</th>
            <?php endif; ?>
            <?php if($level == 1):?>
            <th scope="col" style="padding-left: 1.5em;">Action</th>
            <?php endif;?>
          </tr>
        </thead>
        <tbody id="show_task_project">
            <tr>
                <td colspan="6" style="text-align:center"><h5>Hãy chọn Project để xem công việc!</h5> </td>
            </tr>
        </tbody>
      </table>           

<!-- Modal profile -->
<div class="modal fade"  id="editProfile" tabindex="-1" aria-labelledby="promoteLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:100%">
    <div class="modal-content" style="width: 365px; justify-content: center; margin-left: 300px;">
      <div class="modal-header">
        <h5 class="modal-title" id="promoteLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="./edit_profile.php" method="post" id="edit_form" onsubmit="return checkSubmitEditProfile()">
          <?php
            $result_profile = $conn->query("SELECT a.*, b.level_name
                                            FROM user as a
                                            LEFT JOIN level as b ON a.level=b.id_level
                                            WHERE id_user='$id_user'");
            $row_profile = $result_profile->fetch_assoc();
            $level_profile = $row_profile['level_name'];
          ?>
          <!-- SHOW PROFILE -->

          <div hidden>
            <label for = "levelAccount"> ID User </label>
            <input type="text" name="id_user"
              style="border-radius: 10px; height: 40px; display: block; width: 100%; margin-bottom: 10px; text-align: center;" 
                readonly value="<?=$id_user?>">
          </div>             
        
          <div>
            <label for = "levelAccount"> Role </label>
            <input type="text" 
              style="border-radius: 10px; height: 40px; display: block; width: 100%; margin-bottom: 10px; text-align: center;" 
                readonly value="<?=$level?>">
          </div>

          <div>
            <label for = "userAccount"> Username </label>
            <input type="text" name="username"
              style="border-radius: 10px; height: 40px; display: block; width: 100%; margin-bottom: 10px; text-align: center;" 
                readonly value="<?=$username?>">
            
          </div>

          <div>
            <label for = "userFullName"> Full Name </label>
            <input type="text" name="hoten"
              style="border-radius: 10px; height: 40px; display: block; width: 100%; margin-bottom: 10px; text-align: center;" 
                readonly value="<?=$hoten?>">
          </div>
          
          <div>
            <label for = "userBirthday"> Brithday </label>
            <input type="date" name="birthday"
              style="border-radius: 10px; height: 40px; display: block; width: 100%; margin-bottom: 10px; text-align: center;" 
                value="<?=$brithday?>">
          </div>

          <div>
            <label for = "userAddress"> Address </label>
            <input type="text" name="address"
              style="border-radius: 10px; height: 40px; display: block; width: 100%; margin-bottom: 10px; text-align: center;" 
                value="<?=$address?>">
          </div>

          <div>
            <label for = "userGender"> Gender </label>
            <input type="text" name="gender"
              style="border-radius: 10px; height: 40px; display: block; width: 100%; margin-bottom: 10px; text-align: center;" 
                value="<?=$gender?>">
          </div>

          <div>
            <label for = "userPhone"> Phone </label>
            <input type="text" name="phone"
              style="border-radius: 10px; height: 40px; display: block; width: 100%; margin-bottom: 10px; text-align: center;"
               value="<?=$phone?>">
          </div>

          <div>
            <label for = "userEmail"> Email </label>
            <input type="email" name="email"
              style="border-radius: 10px; height: 40px; display: block; width: 100%; margin-bottom: 10px; text-align: center;" 
                value="<?=$email?>">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name ="updatePF" form="edit_form" class="btn btn-primary">Update Profile</button>
          </div>             
        </form>
      </div>
  </div>
  </div>
</div>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- database js -->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">

<script src="./js/custom.js"></script>
</body>
</html>
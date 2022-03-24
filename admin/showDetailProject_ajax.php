<?php
    require_once('./dbh.php');

    $id_project = $_POST['id_project'];
    
    //Show task của project
    if(isset($_POST['showtask'])){
        $level = $_POST['level'];
        $result_task = $conn->query("SELECT a.*, b.fullname 
                                    FROM task as a
                                    LEFT JOIN user as b ON a.id_user=b.id_user
                                    WHERE id_project='$id_project'");
        
        if($result_task->num_rows >0):
            while($row = $result_task->fetch_assoc()):
                $task = $row['id_task'];
                // $task_project = $row['project_name'];
                $task_name = $row['task_name'];
                $task_des = $row['task_des'];
                $task_staff = $row['fullname'];
                $task_pri = $row['task_pri'];
                ?>
                <tr>
                    <td><?=$task?></td>
                    <td><?=$task_name?></td>
                    <td><?=$task_des?></td>
                    <td><?=$task_staff?></td>
                    <td style="padding-left: 2em;"><?=$task_pri?></td> 
                    <?php if($level == 3):?>
                    <td>
                        <div class="form-check" style="padding-left: 4em;"> 
                            <input class="form-check-input" id="done" type="checkbox" value="<?php echo $task ?>" onclick="save_checkbox(<?php echo $task ?>);">
                        </div>
                    </td>
                    <?php endif;?>
                    <?php if($level == 1):?>
                    <td>
                    <a href="./edit_task.php?idtask=<?=$row['id_task']?>">      
                    <button class="btn btn-info test-align">
                        <i class="fas fa-pen-alt"></i>
                    </button>
                    </a>                  
                    <a href="./delete_task.php?idtask=<?=$row['id_task']?>">
                    <button type="submit" class="btn btn-danger text-light" name="removeTS">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </a>
                </td>
                <?php endif;?>
                </tr>
            <?php endwhile;?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center"><h5>Chưa có công việc nào được thêm!</h5> </td>
            </tr>
        <?php endif; ?>
        <input type="hidden" id="id_project_ajax" value="<?=$id_project?>">
        <script>
            var id_project = $('#id_project_ajax').val();
            $.ajax({
                type: "post",
                url: './showDetailProject_ajax.php',
                data:{
                    id_project: id_project,
                    showinfoProject: true,
                },
                success: function(result){
                    $('#show_info_project').html(result);
                }
            });

        function save_checkbox( record_id) {
            $.post( 'showDetailProject_ajax.php' , { r_id : record_id });
        }

        </script>
        <?php
    }

    //Show thông tin project
    if(isset($_POST['showinfoProject'])){
        $result = $conn->query("SELECT a.*, b.fullname 
                                FROM project as a
                                LEFT JOIN user as b ON a.leader=b.id_user
                                WHERE a.id_project='$id_project'");
        $row = $result->fetch_assoc();
        $deadline = date("d-m-Y", strtotime($row['deadline']))." at ".date("h:m A", strtotime($row['deadline']));
        $created = date("d-m-Y", strtotime($row['created_at']))." at ".date("h:m A", strtotime($row['created_at']));
        ?>
        <p style="font-weight: bold;">ID: <span style="font-weight: 100;"><?=$row['id_project']?></span></p>
        <p style="font-weight: bold;">Project Name: <span style="font-weight: 100;"><?=$row['project_name']?></span></p>
        <p style="font-weight: bold;">Description: <span style="font-weight: 100;"><?=$row['project_des']?></span></p>
        <p style="font-weight: bold;">Leader: <span style="font-weight: 100;"><?=$row['fullname']?></span></p>
        <p style="font-weight: bold;">Deadline: <span style="font-weight: 100;"><?=$deadline?></span></p>
        <p style="font-weight: bold;">Created at: <span style="font-weight: 100;"><?=$created?></span></p>
        <?php
    }

    if(isset($_POST["r_id"]))  
    {  
        $query = "UPDATE task set completed = 1 where id_task = ('".$_POST["r_id"]."')";  
        $result = mysqli_query($conn, $query);  
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

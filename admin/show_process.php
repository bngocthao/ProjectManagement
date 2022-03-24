<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once("dbh.php");
    include_once('./header.php');
    ?>
</head>
<body>
    <style>
        body{
            text-align: center; 
        }
    </style>
    <!-- chọn hết tất cả task sao cho task được chọn thuộc project yêu cầu
    Nếu complete của tất cả task == 1 trả về completed
    nếu không thì tính trung bình số task r in ra phần trăm lượng task đã hoàn thành -->
    <div>
    <?php
    
            $id_project = $_REQUEST['pro_id'];
            $result_complete = $conn->query("SELECT CASE
                                                WHEN NOT EXISTS(SELECT *
                                                                FROM   task
                                                                WHERE id_project='$id_project'
                                                                AND  completed <> 1) THEN 'Y'
                                                ELSE 'N'
                                                end as completed");
            $result_not_complete = $conn->query("SELECT COUNT(id_task) as id_nc FROM `task` WHERE completed <> 1;");
            $result_task = $conn->query("SELECT COUNT(id_task) as id_t FROM `task` WHERE id_project='$id_project';");
            if($result_complete -> num_rows > 0){
                while($row = $result_complete->fetch_assoc()){
                    $r_completed = $row['completed'];
                    if($r_completed === 'Y'){
                        echo "COMPLETED!";
                        echo '<div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width:100%" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>';
                    }elseif($r_completed === 'N')
                        {
                            $num_nc = $result_not_complete ->fetch_assoc();
                            $num_t = $result_task -> fetch_assoc();
                            // chuyển 2 cái mảng trên thành số
                            // Tỷ số phần trăm của A = A/(A+B)*100(%).
                            $num_not_complete = $num_nc['id_nc'];
                            $num_task = $num_t['id_t'];
                            $per = $num_not_complete/$num_task * 100;
                            echo "PROCESS " .$per . "%";
                            ?>
                            <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width:<?php $per ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <?php
                        }
                    else{
                        echo "ERROR!";
                    }               
                }
            }
            else{
                echo "Can not acces table completed!";
            };
    ?>

    </div>
    <?php
    include_once('./footer.php');
    ?>
</body>
</html>
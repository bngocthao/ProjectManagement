// document.getElementById('resigter_form').style.display='none';
// my js
function checkSubmitRegister()
{
    var pass = $('#pass').val();
    var re_pass = $('#re_pass').val();
    // fullname
    // 
    if(pass != re_pass)
    {
        $('#err_pass').html('Mật khẩu xác nhận không đúng');
        return false;
    }else{
        return true;
    }
}

$('#user_login').on('click', function(){
    $('.user_dropdown').toggle('show');
});

// function show_detailProject(id_project){
//     // alert("yo");
//     $.ajax({
//         type: "post",
//         url: './showDetailProject_ajax.php',
//         data:{
//             id_project: id_project,
            
//         },
//         success: function(result){
//             $('#show_task_project').html(result);
//         }
//     });
// }
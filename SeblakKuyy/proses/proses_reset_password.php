<?php 
include "connect.php";
$message = "";
$id =  (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
if(!empty($_POST['input_user_valid'])){
    $query = mysqli_query($conn, "UPDATE tb_user SET password=md5('password') WHERE id = '$id'");
    if($query){
        $message = '<script>alert("Password Berhasil Direset");
        window.location="../user"</script>
        </script>';
    }else{
        $message = '<script>alert("Password Gagal Direset")</script>';
    }
}echo $message;
?>
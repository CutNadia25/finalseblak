<?php 
include "connect.php";
$message = "";
$id =  (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
if(!empty($_POST['input_user_valid'])){
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id = '$id'");
    if($query){
        $message = '<script>alert("Data Berhasil Dihapus");
        window.location="../user"</script>';
    }else{
        $message = '<script>alert("Data Gagal Dihapus")</script>';
    }
}echo $message;
?>
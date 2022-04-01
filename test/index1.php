<?php
if(!empty($_POST['paswd'])){
    $pass = "123";
    if($_POST['paswd']==$pass){
        session_start();
        $_SESSION['access']=true;
        header("Location: page2.php") ;
    }
    else {
        header("Location: error.php") ;
    }
}
else
{
    ?>
    <form method="POST">
        <input type="text" name="paswd">
        <input type="submit">
    </form>
    <?php
}
?>
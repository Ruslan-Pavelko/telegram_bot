<?php
if(!empty($_POST['paswd'])){
    $pass = "123"; // здесь мы храним пароль, с которым должен совпасть введенный пользователем(этого никто не увидит, т.к. это РНР, а сервер отправит пользователю чистый html, беспокоится не стоит
    if($_POST['paswd']==$pass){ // Если пользователь ввел верно, значит для него создается сессия и он  перенаправляется на вторую страницу
        session_start();
        $_SESSION['access']=true;
        header("Location: page2.php") ;
    }
    else {
        header("Location: error.php") ;// если нет то на страницу с ошибкой
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
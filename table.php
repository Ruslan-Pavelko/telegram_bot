<?php

/*
$conn = new mysqli("localhost", "root", "mysql");
if($conn->connect_error){
    die("Ошибкка: " . $conn->connect_error);
}
// Создаем базу данных testdb2
$sql = "CREATE DATABASE infodb";
if($conn->query($sql)){
    echo "База данных успешно создана";
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();

$conn = new mysqli("localhost", "root", "mysql", "infodb");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "CREATE TABLE infotable (id INTEGER AUTO_INCREMENT PRIMARY KEY, title VARCHAR(60), description TEXT, detailtext TEXT);";
if($conn->query($sql)){
    echo "Таблица новостей успешно создана";
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();
*/


session_start();

if (!isset($_SESSION['access']) || $_SESSION['access'] != true) {
    header("location:index.php");
} else {


?>
<!DOCTYPE html>
<html>
<head>
    <title>Taras news</title>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex, nofollow">
</head>
<body>
<h2 align="center">Список новостей</h2>
<style type="text/css">
    .table-wrap{
        overflow-x:auto;
    }
    table.table-1 {
        border-collapse: collapse;
        border-spacing: 0;
        width: 98%;
    }
    table.table-1 tr {
        background-color: #f8f8f8;
    }
    table.table-1 th, table.table-1 td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
    }

    table.table-1 th{
        font-weight: bold;
    }
</style>
<?php
$conn = new mysqli("localhost", "root", "mysql", "news");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM newone";
if($result = $conn->query($sql)){
?> <div class="table-wrap">
    <table class="table-1"><?
        echo "<tr><th>id користувача</th><th>Імя</th><th>Текст</th></tr>";
        foreach($result as $row){
            echo "<tr>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["detailtext"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";

            echo "<td><form action='send.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' value='Отправить'> 
                </form></td>";
            echo "<td><a href='update.php?id=" . $row["id"] . "'>Изменить</a></td>";
            echo "<td><form action='delete.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' value='Удалить'> 
                </form></td>";
            echo "</tr>";
        }
        echo "</table></div>";
        $result->free();
        } else{
            echo "Ошибка: " . $conn->error;
        }
        $conn->close();
        ?>
</body>
</html>
<?php } ?>
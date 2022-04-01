<?php
/*

$conn = new mysqli("localhost", "root", "mysql");
if($conn->connect_error){
    die("Ошибкка: " . $conn->connect_error);
}
// Создаем базу данных testdb2
$sql = "CREATE DATABASE news";
if($conn->query($sql)){
    echo "База данных успешно создана";
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();

$conn = new mysqli("localhost", "root", "mysql", "news");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "CREATE TABLE newone (id INTEGER AUTO_INCREMENT PRIMARY KEY, title VARCHAR(60), description TEXT, detailtext TEXT);";
if($conn->query($sql)){
    echo "Таблица новостей успешно создана";
} else{
    echo "Ошибка: " . $conn->error;
}
$conn->close();



$conn = mysqli_connect("localhost", "root", "mysql", "news");
if (!$conn) {
  die("Ошибка: " . mysqli_connect_error());
}
$sql = "INSERT INTO newone (title, description, detailtext) VALUES
            ('Новость 1', 'Короткое описание новости', 'Новость России пипец'),
            ('Новость про Украину', 'Еще одно описание', 'Триндец кацапам Триндец кацапам Триндец кацапам Триндец кацапам Триндец кацапам Триндец кацапам '),
            ('Новость про войну', 'Описание для новости','my news')";
if(mysqli_query($conn, $sql)){
    echo "Данные успешно добавлены";
} else{
    echo "Ошибка: " . mysqli_error($conn);
}
mysqli_close($conn);
*/
?>
<!DOCTYPE html>
<html>
<head>
    <title>Taras news</title>
    <meta charset="utf-8" />
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
$conn = new mysqli("localhost", "root", "mysql", "infodb");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM infotable";
if($result = $conn->query($sql)){
?> <div class="table-wrap">
    <table class="table-1"><?
        echo "<tr><th>Номер повідомлення</th><th>id користувача</th><th>Повідомлення</th><th>Імя</th></tr>";
        foreach($result as $row){
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["title"] . "</td>";
            echo "<td>" . $row["description"] . "</td>";
            echo "<td>" . $row["detailtext"] . "</td>";
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
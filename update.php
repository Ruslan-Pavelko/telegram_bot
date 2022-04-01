<?php
$conn = mysqli_connect("localhost", "root", "mysql", "news");
if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
}
?>
<html>
<head>
    <title>Taras news</title>
    <meta charset="utf-8" />
</head>
<body>
<?php
// если запрос GET
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]))
{
    $userid = $conn->real_escape_string($_GET["id"]);
    $sql = "SELECT * FROM newone WHERE id = '$userid'";
    if($result = $conn->query($sql)){
        if($result->num_rows > 0){
            foreach($result as $row){

                $title = $row["title"];
                $description = $row["description"];
                $detailtext = $row["detailtext"];
            }
            echo "<h3>Обновление Новости</h3>
                <form method='post'>
                    <input type='hidden' name='id' value='$userid' />
                    <p>id користувача:
                    <input type='text' name='title' value='$title' /></p>
                    <p>Імя:
                    <input type='textarea' name='detailtext' value='$detailtext' /></p>
                     <p>Текст:
                    <input type='text' name='description' value='$description' /></p>

                    
                    <input type='submit' value='Сохранить'>
            </form>";
        }
        else{
            echo "<div>Новость не найдена</div>";
        }
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
    }
}
elseif (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["detailtext"])) {

    $userid = $conn->real_escape_string($_POST["id"]);
    $title = $conn->real_escape_string($_POST["title"]);
    $description = $conn->real_escape_string($_POST["description"]);
    $detailtext = $conn->real_escape_string($_POST["detailtext"]);
    $sql = "UPDATE newone SET title = '$title', description = '$description', detailtext= '$detailtext' WHERE id = '$userid'";
    if($result = $conn->query($sql)){

        header("Location: index.php");
    } else{
        echo "Ошибка: " . $conn->error;
    }
}
else{
    echo "Некорректные данные";
}
$conn->close();
?>
</body>
</html>
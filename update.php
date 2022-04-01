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
<style>
    textarea {
        color: initial;
        display: inline-block;
        background-color: white;
        cursor: text;
        white-space: pre-wrap;
        overflow-wrap: break-word;
        font: 400 13.3333px Arial;
        border-width: 1px;
        border-style: solid;
        border-color: rgb(169, 169, 169);
        padding: 2px;
    }
</style>
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
            echo "
<form method='post' class='decor'>
    <div class='form-left-decoration'></div>
    <div class='form-right-decoration'></div>
    <div class='circle'></div>
    <div class='form-inner'>
        <h3>Редактирование новости</h3>
        <input type='hidden' name='id' value='$userid' />
         <label for='detailtext'>ID користувача:</label>
        <input id='title' type='text' name='title' value='$title'>
         <label for='detailtext'>Імя:</label>
        <input id='detailtext' type='text' name='detailtext' value='$detailtext'>
        <label for='description'>Текст:</label>
        
        <textarea id='description' name='description' rows='3' cols='50'>$description</textarea>
        <input type='submit' value='Сохранить'>
    </div>
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

<style>
    * {
        box-sizing: border-box;
    }
    body {
        background: #f69a73;
    }
    .decor {
        position: relative;
        max-width: 600px;
        margin: 50px auto 0;
        background: white;
        border-radius: 30px;
    }
    .form-left-decoration, .form-right-decoration {
        content: "";
        position: absolute;
        width: 50px;
        height: 20px;
        background: #f69a73;
        border-radius: 20px;
    }
    .form-left-decoration {
        bottom: 60px;
        left: -30px;
    }
    .form-right-decoration {
        top: 60px;
        right: -30px;
    }
    .form-left-decoration:before, .form-left-decoration:after, .form-right-decoration:before, .form-right-decoration:after {
        content: "";
        position: absolute;
        width: 50px;
        height: 20px;
        border-radius: 30px;
        background: white;
    }
    .form-left-decoration:before {
        top: -20px;
    }
    .form-left-decoration:after {
        top: 20px;
        left: 10px;
    }
    .form-right-decoration:before {
        top: -20px;
        right: 0;
    }
    .form-right-decoration:after {
        top: 20px;
        right: 10px;
    }
    .circle {
        position: absolute;
        bottom: 80px;
        left: -55px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: white;
    }
    .form-inner {
        padding: 50px;
    }
    .form-inner input, .form-inner textarea {
        display: block;
        width: 100%;
        padding: 0 20px;
        margin-bottom: 10px;
        background: #E9EFF6;
        line-height: 40px;
        border-width: 0;
        border-radius: 20px;
        font-family: 'Roboto', sans-serif;
    }
    .form-inner input[type="submit"] {
        margin-top: 30px;
        background: #f69a73;
        border-bottom: 4px solid #d87d56;
        color: white;
        font-size: 14px;
    }
    .form-inner textarea {
        resize: none;
    }
    .form-inner h3 {
        margin-top: 0;
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
        font-size: 24px;
        color: #707981;
    }
</style>

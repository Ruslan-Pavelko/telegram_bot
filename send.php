<?php

include '/telegram_bot-master1/lib/telegram_bot.php';
if(isset($_POST["id"]))
{
    $conn = new mysqli("localhost", "root", "mysql", "news");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $userid = $conn->real_escape_string($_POST["id"]);
    $sql = "SELECT * FROM newone WHERE id = '$userid'";
    if($result = $conn->query($sql)){
        foreach($result as $row){
            $title = $row["description"];
        }
        $token = "5245759628:AAEVpSjWbdXwKmVxMCxVeD4cF2WhNRu5WZQ";
        $conn1 = new mysqli("localhost", "root", "mysql", "chat");
        $sql1 = "SELECT * FROM chat_id";
        if($result1 = $conn1->query($sql1)){
            foreach($result1 as $row){
                $chat_id = $row["chat_id"];
            }
        }

        $chatid = "-1001764501259"; //ИД чата telegrm
        $mess =  $title;
        $tbot = file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chatid."&text=".urlencode($mess));
        header("Location: index.php");
    }
    else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>
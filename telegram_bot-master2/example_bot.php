<?php

require_once("lib/telegram_bot.php");

class TestBot extends TelegramBot{
    protected $token = "5245759628:AAEVpSjWbdXwKmVxMCxVeD4cF2WhNRu5WZQ";
    protected $bot_name = "@Yak_tu_bot";
    //public $proxy = "tcp://88.99.181.138:8080";


    /**
     * Предустановленные варианты команд
     * команда => метод для обработки команды
     */

    protected $commands = [
        "/start" => "cmd_start",
        "/help" => "cmd_help",
        "Проєкт" => "cmd_aboutproject",
        "Мої_історії" => "cmd_istorii",
        "Як" => "cmd_howwork",
        "Правила" => "cmd_pravila",
        "Читати" => "cmd_readhistory",
        "Поділитися" => "cmd_podilutus"
    ];

    /**
     * Предустановленные клавиатуры
     *
     * Справка по клавитурам: https://core.telegram.org/bots/api#replykeyboardmarkup
     *
     */

    public $keyboards = [
        'default' => [
            'keyboard' => [
                ["Проєкт", "Мої_історії"], // Две кнопки в ряд
                ["Як це працює?","Правила"],
                //["Музыка", "Подкаст"],
                ["Читати історії","Поділитися історією"] // Кнопка на всю ширину
            ]
        ],
        'inline1' => [
            // Две кнопки в ряд
            [
                // вызовет метод callback_act1(),
                [
                    'text' => "ℹ️ Відправити",
                    'callback_data'=> "act1"
                ],
                [
                    'text' => "🔗 Редагувати",
                    'callback_data'=> "act2 param1 param2"
                ],


                // вызовет метод callback_act2(),
                // дополнительные параметры будут доступны в переменной $this->result['callback_query']["data"]

            ],
            [
                ['text' => "🚪 Повернутись", 'callback_data'=> "logout"],
            ]


        ],

        'inline' => [
            // Две кнопки в ряд
            [
                // вызовет метод callback_act1(),
                [
                    'text' => "ℹ️ Поділитися історією",
                    'callback_data'=> "act1"
                ],
                [
                    'text' => "🚪 Закрыть", 'callback_data'=> "logout"
                ]

                // вызовет метод callback_act2(),
                // дополнительные параметры будут доступны в переменной $this->result['callback_query']["data"]
               /* [
                    'text' => "🔗 C параметрами",
                    'callback_data'=> "act2 param1 param2"
                ]*/
            ],
            /*[
                ['text' => "🌎 Действие 3", 'callback_data'=> "act3"],
                ['text' => "📚 Действие 4", 'callback_data'=> "act4"]
            ],*/
            // Кнопка на всю ширину
            /*[
                ['text' => "🚪 Закрыть", 'callback_data'=> "logout"],
            ]*/
        ],
        'back' =>[[['text' => "↩ Назад", 'callback_data'=> "back"]]],
        'close' =>[[['text' => "🚪 Закрыть", 'callback_data'=> "logout"]]],
    ];

    /**
     * Обработка ввода команды "/start"
     */
    function cmd_start(){
        $this->api->sendMessage([
            'text' => "Привіт!
Так, зараз війна. І кожен з нас вже має свій власний досвід життя під час війни.
Цей бот збирає історії українців.
Історії про біль та сльози, про усвідомлення та мрії, про втрати та знахідки, про любов та надію.
Розкажи, що тобі довелось пережити, чому тебе навчила війна, який епізод вразив найбільше. Або просто розкажи як ти.

Наші історії - це наша пам’ять, наша підтримка. Це сила, яка нас поєднує та запевняє, що ми вистоїмо попри все.


Переглянути історії  🌎 https://t.me/Yak_ty",
            'reply_markup' => json_encode($this->keyboards['default'])
        ]);

    }

    /**
     * Обработка ввода команды "Про проект"
     */
    function cmd_aboutproject()
    {
        $this->api->sendMessage([
            'text' => "«Як ти?» – питання, яке стало особливим під час війни. Під час, коли кожен українець отримує страшний досвід. Але цей досвід відкриває в нас сили, про які ми ніколи не знали.
            
Кожен з нас вже має свою історію цієї війни: про відчай та героїзм, про розпач та надію, про страхи та виклики. Розкажіть історію вашої сили, поділіться своїм досвідом: через що ви змогли пройти? На що ви виявились спроможним? Від чого болить саме зараз?

Ваша розповідь – це історія вашої сили, це доказ того, що українці здатні вистояти попри все. І перемогти!

І пам’ятайте, не існує маленьких або неважливих історій. Кожна розповідь формує скарбницю української мужності.

Переглянути історії  🌎 https://t.me/Yak_ty",
            'reply_markup' => json_encode($this->keyboards['default'])
        ]);
    }

    /**
     * Обработка ввода команды "Історії"
     */
    function cmd_istorii(){

        $conn = new mysqli("localhost", "root", "mysql", "news");
        if($conn->connect_error){
            die("Ошибка: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM newone";
        if($result = $conn->query($sql)){
            foreach($result as $row){
                $text = $row["description"];
            }
            foreach($result as $row){
                $chat_idd = $row["title"];
            }

        } else{
            echo "Ошибка: " . $conn->error;
        }
        $conn->close();
        if ($chat_idd == $this->result["message"]["from"]["id"]){
            $this->api->sendMessage( $text);
        }else{
            $this->api->sendMessage( "У Вас немає історій");
        }
    }

    /**
     * Обработка ввода команды "як це працює"
     */
    function cmd_howwork(){
        $this->api->sendMessage( "Напишіть свою історію та відправте нашому боту. Після модерації ваша історія буде опублікована тут @Yak_ty від імені каналу.
Не забудьте підписатися на канал, щоб не пропустити інші історії." );
    }

    /**
     * Обработка ввода команды "Новости" отправляет сообщение со списком новостей из RSS-ленты
     */
    function cmd_pravila(){
        $this->api->sendMessage( "🔷  Розповідайте без думки, що ваша історія “замаленька” чи “неважлива”. Важлива кожна історія, де б ви і ким не були.
🔶  Не вважайте ваш досвід “не таким страшним, як в інших”. Ми не порівнюємо історії, ми поважаємо кожну подію, емоцію чи думку. Для кожного “тяжкий досвід” - це щось своє.
🔷  Не соромтесь своїх почуттів. Ви маєте на них право.
🔶  Додайте за бажанням (!) в історію своє ім'я, вік та населений пункт. Ми не збираємо ніяких персональних даних, але таке уточнення допоможе читачеві краще зрозуміти вас. 
🔷  Уникайте критики наших захисників, волонтерів, влади. Зараз ми єдині та підтримуємо одне одного.
🔶  Ми залишаємо за собою право використовувати ваш текст у різних соціальних мережах та проєктах (у тому вигляді, в якому він опублікований на каналі).

" );
    }

    /**
     * Читати історії
     */
    function cmd_readhistory(){
        $this->api->sendMessage( "https://t.me/Yak_ty" );
    }

    /**
     *
     */
    function cmd_podilutus(){
        $this->api->sendMessage( "Я Вас уважно слухаю, поділіться своєю історією" );
    }

    /**
     * Ответ на ввод, не распознанный как команда
     */
     function cmd_default(){
         $chat_idd = $this->result["message"]["from"]["id"];
         $text = $this->result["message"]["text"];
         $name = $this->result["message"]["from"]["first_name"];

         if( stripos( $text, "" ) !== true ){
             $this->api->sendMessage([
                 'text'=>"Ви також даєте згоду на обробку персональних даних?",
                 'reply_markup' => json_encode( [
                     'inline_keyboard'=> $this->keyboards['inline1']
                 ] )
             ]);

             $conn1 = mysqli_connect("localhost", "root", "mysql", "infodb");
             $sql1 = "INSERT INTO infotable (title,description,detailtext) VALUES
            ('$chat_idd','$text','$name')";
             mysqli_query($conn1, $sql1);
         }else {


         }
    }

    /**
     * Обработка ввода команды "Инлайн" отправляет сообщение с клавиатурой, прикрепелнной к сообщению.
     */
    function cmd_inlinemenu(){
        $this->api->sendMessage([
            'text'=>"Напишіть нам свою історію.",
        ]);
    }

    // Простой ответ на нажатие кнопки
    // с изменением текущего сообщения и клавиатуры под ним
    public function callback_act1($query)
    {
        $this->api->sendMessage([
            'text'=>"Дякуємо, ваша історія після модерації з'явиться в нашій групі https://t.me/Yak_ty"
            ] );


$conn = new mysqli("localhost", "root", "mysql", "infodb");
if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}
$sql = "SELECT * FROM infotable";
if($result = $conn->query($sql)){
        foreach($result as $row){
            $text = $row["detailtext"];
        }
        foreach($result as $row){
        $chat_idd = $row["title"];
        }
        foreach($result as $row){
            $name = $row["description"];
        }
        } else{
            echo "Ошибка: " . $conn->error;
        }
        $conn->close();
        $conn = mysqli_connect("localhost", "root", "mysql", "news");
        $sql = "INSERT INTO newone (detailtext, title, description) VALUES
            ('$text', '$chat_idd', '$name')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }



    // Ответ на нажатие кнопки с обработкой дополнительных параметров
    function callback_act2( $query ){
        $text = "Виправте повідомлення, та відправте ще раз до бота";
        $this->callbackAnswer( $text, $this->keyboards['close'] );
    }


    // Ответ на нажатие кнопки всплывающим окном
    function callback_act3( $query ){
        $this->api->answerCallbackQuery( [
            'callback_query_id' => $this->result['callback_query']["id"],
            'text' => "Вы нажали кнопку \"Действие 3\"",
            'show_alert' => true
        ] );
    }

    // Ответ на кнопку "Назад" выводит начальную клавиатуру
    function callback_back(){
        $text = "Виберіть дію";
        $this->callbackAnswer( $text, $this->keyboards['inline'] );
    }

    // Ответ на кнопку "Закрыть"
    function callback_logout(){
        $this->api->answerCallbackQuery( $this->result['callback_query']["id"] );
        $this->api->deleteMessage( $this->result['callback_query']['message']['message_id'] );
    }

}

?>

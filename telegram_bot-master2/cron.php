<?php

/**
 * Use this if you want to send messages to users
 * 
 */

require_once("example_bot.php");

$bot = new TestBot();

$users = [];
$text = "Hello world!";

$bot->mailing( $text, $users );


?>
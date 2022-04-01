<?php
include('vendor/autoload.php');

$token = "5102391624:AAExCkriWiuKTk8exloSdfPGhAqvq0Rhmhc";
use Telegram\Bot\Api;

$telegram = new Api($token);
$result = $telegram->getWebhookUpdates();

$chat_id = -517371153;

$r = "Hello user!";

$telegram->sendMessage(['chat_id' => $chat_id, 'text' => $r]);
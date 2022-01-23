<?php

require_once("config.php");
$json = file_get_contents('php://input');
$tg = Telegram::getInstance($json);
$cr = Core::getInstance();

$chatId = $tg->getChatId();

if ($tg->isChannelPost() === false && $tg->isEditChannelPost() === false) {

    if ($tg->getMessageText() == "/start") {
        $cr->setStartFunction($chatId);
    }

    $cr->setShowMessage($chatId, $json);
}

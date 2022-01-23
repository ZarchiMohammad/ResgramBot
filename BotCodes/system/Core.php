<?php

class Core
{

    private static $cr;
    private static $db;
    private static $tg;

    public static function getInstance()
    {
        if (self::$cr == null) {
            self::$cr = new Core();
        }
        return self::$cr;
    }

    public function __construct()
    {
        self::$db = Database::getInstance();
        self::$tg = Telegram::getInstance();
    }

    public function sendUserEntrance($chatId, $entrance, $function)
    {
        $message = "User: <code>" . $chatId . "</code>\n";
        $message .= "Name: <code>" . self::$tg->getFirstName() . " " . self::$tg->getLastName() . "</code>\n";
        $message .= "Profile: <a href='tg://user?id=" . $chatId . "'>Click To Go</a>" . "\n";
        $message .= "Entrace: <code>" . $entrance . "</code>" . "\n";
        $message .= "Function: <code>" . $function . "</code>" . "\n";
        $time = $this->getTimeStamp(true);
        $message .= "TimeStamp: <code>" . $time . "</code>\n";
        self::$tg->sendMessage(_REPORT_CHANNEL, $message);
    }

    public function setStartFunction($chatId)
    {
        self::$tg->setChatAction($chatId);
        $this->sendUserEntrance($chatId, "Start Bot", __FUNCTION__);
        self::$db->insertUserData($chatId);
    }

    public function setShowMessage($chatId, $json)
    {
        self::$tg->setChatAction($chatId);
        $this->sendUserEntrance($chatId, "Jason Data", __FUNCTION__);
        $data = json_decode($json);
        $message = json_encode($data, JSON_PRETTY_PRINT);
        self::$tg->sendMessage($chatId, $message);
    }

    /*     * * * * * * * * * * * * * * * * * * * * * *
     * ╔═╗╔═╗  ╔╗╔╗             ╔╗╔╗      ╔╗      *
     * ║║╚╝║║ ╔╝╚╣║            ╔╝╚╣║      ║║      *
     * ║╔╗╔╗╠═╩╗╔╣╚═╦══╦═╗ ╔╗╔╦═╩╗╔╣╚═╦══╦═╝╠══╗  *
     * ║║║║║║╔╗║║║╔╗║║═╣╔╝ ║╚╝║║═╣║║╔╗║╔╗║╔╗║══╣  *
     * ║║║║║║╚╝║╚╣║║║║═╣║  ║║║║║═╣╚╣║║║╚╝║╚╝╠══║  *
     * ╚╝╚╝╚╩══╩═╩╝╚╩══╩╝  ╚╩╩╩══╩═╩╝╚╩══╩══╩══╝  *
     * * * * * * * * * * * * * * * * * * * * * * */


    public function getTimeStamp($report = false)
    {
        $data = explode(" ", microtime());
        if ($report)
            $mic = str_replace("0.", "", number_format($data[0], 6));
        else
            $mic = str_replace("0.", "", number_format($data[0], 4));
        return time() . $mic;
    }
}

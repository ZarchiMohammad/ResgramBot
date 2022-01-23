<?php

require_once("system/Telegram.php");
require_once("system/Database.php");
require_once("system/Core.php");

const _TOKEN = "--BotToken--";
const _ADMIN = "--ChatId--";

const _PROJECTS_CHANNEL = "--ChatIdChannel--";
const _REPORT_CHANNEL = "--ChatIdChannel--";

global $config;
$config['host'] = "localhost";
$config['user'] = "--username--";
$config['pass'] = "--password--";
$config['name'] = "--DatabaseName-";

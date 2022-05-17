<?php
require 'config.php';

$name = trim($_REQUEST["name"]); // Имя
$phone = trim($_REQUEST["phone"]); // Телефон
$color = trim($_REQUEST["color"]); // Цвет
$city = trim($_REQUEST["city"]); // Цвет
$departament = trim($_REQUEST["departament"]); // Цвет


$message = "Цвет: $color \n
            Имя: $name \n
            Телефон: $phone \n
            Город: $city \n
            Отделение: $departament \n";


$api = 'https://api.telegram.org/bot' . $tg_token; // URL API

$url_telegram_bot = $api . "/sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($message) . "&parse_mode=HTML";

function curl_get_contents($url) { //Отправка GET запроса
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
}


curl_get_contents($url_telegram_bot);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Спасибо. Ваш заказ принят!</title>
  <style type="text/css">
  * {
    font-family: Arial;
  }
</style>
</head>
<body>
  <table width='90%' height='300' align='center'>
  <tr style='font-size: 22px'>
  <td class='warning_table' width='220' align='center' valign='middle'>
  <div align='center'>Спасибо. Данные приняты!</div>
  <p align='center'><a href='/'>Вернуться на сайт</a></div></p>
  </td>
  </tr>
  <tr><td></td></tr>
  </table>
</body>
</html>
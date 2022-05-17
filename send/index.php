<?php
require 'config.php';

$name = trim($_REQUEST["name"]); // Имя
$phone = trim($_REQUEST["phone"]); // Телефон
$color = trim($_REQUEST["color"]); // Цвет
$utm = $_REQUEST['utm']; //UTM метка
$site = $_REQUEST['site']; //UTM метка

$api = 'https://api.telegram.org/bot' . $tg_token; // URL API

$subj = "Лид " . $item;
$message = "Заявка " . $item . "\n
            Цвет: $color \n
            Имя: $name \n
            Телефон: $phone \n
            UTM: $utm";

$url_google_script = "https://script.google.com/macros/s/"
                   . $scriptid
                   . "/exec?name=" . urlencode($name)
                   . "&phone=" . urlencode($phone)
                   . "&sheetid=" . urlencode($sheetid)
                   . "&sheetname=" . urlencode($sheetname)
                   . "&item=". urlencode($color)
                   . "&utm=" . urlencode($utm)
                   . "&site=" . urlencode($site)
                   . "&price=" . urlencode($price);

//echo $url_google_script;
$url_telegram_bot = $api . "/sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($message) . "&parse_mode=HTML";

function curl_get_contents($url) { //Отправка GET запроса
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  curl_close($ch);
}


$mail = mail($email, $subj, $message);

if ($mail) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Спасибо. Ваш заказ принят!</title>
</head>
<body>
  <table width='90%' height='300' align='center'>
  <tr style='font-size: 22px'>
  <td class='warning_table' width='220' align='center' valign='middle'>
  <div align='center'>Спасибо. Ваш заказ принят!</div>
  <div align='center'>Мы позвоним Вам по номеру <b><?php echo $phone ?></b> в ближайшее время для уточнения деталей. Держите телефон рядом.</div>
  <br>
  <div align='center'>Доставка осуществляется Новой Почтой. Укажите, пожалуйста город и номер отделения куда нужно будет доставить.</div>
  <form action="np.php">
<input style="width: 80%; height: 30px; margin: 10px 0" type="text" name="city" placeholder="Город">
<input style="width: 80%; height: 30px" type="text" name="departament" placeholder="Номер отделения Новой Почты">
<input style="width: 80%; height: 40px; margin: 10px 0; border: none; background: green; color: #fff" type="submit" name="submit">
<input type="hidden" name="name" value="<?php echo $name ?>">
<input type="hidden" name="phone" value="<?php echo $phone ?>">
<input type="hidden" name="color" value="<?php echo $color ?>">
  </form>
  <p align='center'><a href='/'>Вернуться на сайт</a></div></p>
  </td>
  </tr>
  </table>
</body>
</html>

<?php
}

//Отправка в таблицу
curl_get_contents($url_google_script);

//Отправка в Telegram
curl_get_contents($url_telegram_bot);

?>

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '<?php echo $pixelid ?>');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=<?php echo $pixelid ?>&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<script>
  fbq('track', 'Lead');
</script>

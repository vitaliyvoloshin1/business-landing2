<?php
require 'config.php';

$datetime = date("y.d.m H:i:s");
$referer = $_SERVER['HTTP_REFERER'];
$site = $_SERVER['SERVER_NAME'];
$utm = urldecode($_REQUEST['utm']);

// Защита
$adlover = strpos($referer,"adlover.ru");
$publer = strpos($referer,"publer.pro");
$adheart = strpos($referer,"adheart.ru");

if ($adlover or $publer or $adheart) {
	echo "Задолженность за услуги хоcтинга 173$";
	exit();
}

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
	<noscript>
		<img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=<?php echo $pixelid?>&ev=PageView&noscript=1"
		/>
	</noscript>
	<!-- End Facebook Pixel Code -->



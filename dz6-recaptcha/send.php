<?php
require __DIR__."/../../vendor/autoload.php";
$remoteIp = $_SERVER['REMOTE_ADDR'];
$gRecaptchaResponse = $_REQUEST['g-recaptcha-response'];
$recaptcha = new \ReCaptcha\ReCaptcha("6Ler9joUAAAAABxje00XHiKBGTS8Dw50WBZX-SZP");
$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
if ($resp->isSuccess()) {
    echo "Успех, капча пройдена";
} else {
    echo "Поражен вашей неудачей, сударь";
}
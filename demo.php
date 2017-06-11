<?php 

namespace Gdali\BaiduVoice;

require __DIR__.'/vendor/autoload.php';

//百度语音配置
$appID = "";
$appKey = "";
//设备唯一识别码
$cuid ="111111";

//临时文件夹
$tmp = "./tmp/";

$token = new BaiduToken();
$access_token = $token->getAccessToken($appID,$appKey,$tmp);

/********语音识别 START********/

//音频文件
$file = $tmp.'test.pcm';

$vop =new BaiduVOP();
$text = $vop->getText($file,$cuid,$access_token);

var_dump($text);

/********语音识别 END********/

/********语音合成 START********/

//文本信息
$text = "广州天气预报'";

$voice = new BaiduTTS();
$mp3 = $voice->getVoice($text,$cuid,$access_token,$tmp);

var_dump($mp3);

/********语音合成 END********/

?>
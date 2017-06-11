<?php

/*
 *    百度语音SDK for PHP
 *
 *    version: 1.0
 *
 *    https://github.com/gdali/baiduyuyin-sdk
 *
 *    update: 2017-06-11 
 */

namespace Gdali\BaiduVoice;

class BaiduTTS
{
    
    public function getVoice($text,$cuid,$token,$tmpPath){
        
        $text = urlencode($text);
		$cuid = md5($cuid);

		//ctp=1为普通女音
        $text = "tex=".$text."&lan=zh&cuid=".$cuid."&ctp=1&tok=".$token;

        $url = "http://tsn.baidu.com/text2audio?$text";        
        
        //文件名,时间戳+三位随机数
		$filename = time().rand(100,999).".mp3";
		
        ob_start();
        readfile($url);
        $voice = ob_get_contents();
        ob_end_clean();
		
		//生成mp3文件
        $file = @fopen($tmpPath.$filename,"a");
        fwrite($file,$voice);
        fclose($file);
		
        return $filename;
		
    }
      
}
?>
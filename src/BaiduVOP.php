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

class BaiduVOP
{
	
	public function getText($file,$cuid,$token){
		
		$cuid = md5($cuid);
		
		$url = "http://vop.baidu.com/server_api?cuid=".$cuid."&token=".$token;
		$audio = file_get_contents($file);
		$content_len = "Content-Length: ".strlen($audio);
		$header = array ($content_len,'Content-Type: audio/pcm; rate=8000',);
		
		$result = $this->post($url,$header,$audio);
		
		return $result;
		
	}
	
	private function post($url,$header,$audio){
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $audio);
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
		
	}
	
}
?>
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

class BaiduToken
{
    
    public function getAccessToken($appid,$appkey,$tmpPath) {

        $data = json_decode($this->get_php_file($tmpPath."baidu_token.php"));
		
        if ($data->expire_time< time()) {
			
            $url = "https://openapi.baidu.com/oauth/2.0/token?grant_type=client_credentials&client_id=$appid&client_secret=$appkey";		
            $res = json_decode($this->get($url));
            $access_token = $res->access_token;
			
            if ($access_token) {
				
                $data->expire_time = time() + 36000;
                $data->access_token = $access_token;
                $this->set_php_file($tmpPath."baidu_token.php", json_encode($data));
				
            }
			
        }else{
			
            $access_token = $data->access_token;
			
        }
		
        return $access_token;
		
    }

    private function get($url) {
		
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_URL, $url);
        $result = curl_exec($curl);
        curl_close($curl);
		
        return $result;
		
    }
       
    private function get_php_file($filename) { 
	
        return trim(substr(file_get_contents($filename), 15));
		
    }
           
    private function set_php_file($filename, $content) { 
	
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
		
    }

}
?>
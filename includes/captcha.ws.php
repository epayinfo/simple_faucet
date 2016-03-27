<?php
class captcha_ws {
	private function do_post_request($url, $data){
		foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result);
	}
	public function verify($adcopy_response,$adcopy_challenge,$adcopy_key){
		$res=$this->do_post_request('http://verify.captcha.ws/verify.php',array (
			'adcopy_response'=>$adcopy_response,'adcopy_challenge'=>$adcopy_challenge,'adcopy_key'=>$adcopy_key) 
			);
		return $res->status;
	}
}
?>
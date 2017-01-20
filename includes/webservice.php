<?php
class ePay {
	private $api_key;
	private $webservice = "https://api.epay.info/v1/";
	private $disable_curl = true;
	private $force_ipv4 = false;
	private $verify_peer = true;
	private $local_cafile = false;	
	public function __construct( $api_key ) {
		$this->api_key = $api_key;
	}

	public function __execPHP( $url, $params = array() ) {  
		$params = array_merge( $params, array( "api" => $this->api_key ) );
		$fp = fopen( $url.'?'.http_build_query( $params ), 'rb', null);
		$response = stream_get_contents( $fp );
		fclose( $fp );
		return $response;
	}

	public function __exec( $method, $params = array() ) {
		$url = $this->webservice . $method;
		if ( $disable_curl ) {
			$response = $this->__execPHP( $url, $params );
		} else {
			$response = $this->__execCURL( $url, $params );
		}
		return $response;
	}


	private function __execCURL( $url, $params = array() ) {
		$params = array_merge( $params, array( "api" => $this->api_key ) );
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 5 );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, $this->verify_peer );
		if ( $this->force_ipv4 ) { curl_setopt( $ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 ); }
		if ( $this->local_cafile ) { curl_setopt( $ch, CURLOPT_CAINFO, dirname( __FILE__ ) . '/cacert.pem' );}
		if ( count( $params ) > 0 ) {
			$query = http_build_query( $params );
			curl_setopt( $ch, CURLOPT_URL, "$url?$query" );
		} else {
			curl_setopt( $ch, CURLOPT_URL, $url );
		}
		$response = curl_exec( $ch );	
		curl_close( $ch );
		if ( !$response ) {
			$response = $this->__execPHP( $url, $params );
		}		
		return $response;
	}

	public function send( $to, $amount, $note = NULL,$userip=NULL ) {		
		if ( $note )
			$return = $this->__exec( "send", array( "to" => $to, "amount" => $amount, "note" => $note,'user_ip'=>$userip,'type'=>2 ) );
		else
			$return = $this->__exec( "send", array( "to" => $to, "amount" => $amount,'user_ip'=>$userip ) );
		
		$return = get_object_vars(  json_decode($return) );
		
		return $return ;
	}

	public function getBalance() {
		return $this->__exec( "balance" );
	}
}
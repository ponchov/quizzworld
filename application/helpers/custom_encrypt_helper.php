<?php  
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	
	function encrypt($sData, $secretKey="skysoftbd321")
	{
		$sData=trim($sData);
		$sResult = '';
		for($i=0;$i<25;$i++){
			$sChar    = substr($sData, $i, 1);
			$sKeyChar = substr($secretKey, ($i % strlen($secretKey)) - 1, 1);
			$sChar    = chr(ord($sChar) + ord($sKeyChar));
			$sResult .= $sChar;
	
		}
		return encode_base64($sResult);
		//echo $sResult;
	} 
	function encode_base64($sData)
	{
		$sBase64 = base64_encode($sData);
		return str_replace('=', '', strtr($sBase64, '+/', '-_'));
	}
	
	function decrypt($sData, $secretKey="skysoftbd321")
	{
		$sResult = '';
		$sData   = decode_base64($sData);
		for($i=0;$i<strlen($sData);$i++){
			$sChar    = substr($sData, $i, 1);
			$sKeyChar = substr($secretKey, ($i % strlen($secretKey)) - 1, 1);
			$sChar    = chr(ord($sChar) - ord($sKeyChar));
			$sResult .= $sChar;
		}
		return trim($sResult);
	}
	
	function decode_base64($sData)
	{
		$sBase64 = strtr($sData, '-_', '+/');
		return base64_decode($sBase64.'==');
	}


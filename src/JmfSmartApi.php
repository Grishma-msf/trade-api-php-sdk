<?php
namespace Jmf\TradeApiPhpSdk; 
session_start();
require_once("includes/JmfConfigurationManage.php");	


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class JmfSmartApi
{	
	public function __construct($api_key='',$accessToken='', $refreshToken='')
	{	
		if(!empty($api_key)){
			$_SESSION['api_key'] = $api_key;
			setcookie('api_key', $api_key);			
		}
		if (!empty($accessToken)) {
			
			$_SESSION['accessToken']	=	$accessToken;
			setcookie('accessToken', $accessToken);
		}			
	}

	public static function userLogin($mobileNumber, $password, $userId)
	{
		//get url from config file
		$UrlData = JmfConfigurationManage::JmfConfigrationData();
		$url = $UrlData['root'].$UrlData['user_login'];

		$api_key = '';
		$getApiKey 	=	self::getApiKey();
		if($getApiKey['status']){
			$api_key = $getApiKey['api_key'];
		}

		$api_parameter = ['mobileNumber'=>$mobileNumber,'password'=>$password,'userId'=>$userId];

	  	// Common function to call smart api	
		$response_data	=	self::CurlOperation($url, $api_parameter,'','POST', $api_key);

		//save $accessToken in session
		$res = json_decode($response_data,true);		
		$accessToken = $res['response_data']['data']['accessToken'];

		$_SESSION['accessToken']		=	$accessToken;
		setcookie('accessToken', $accessToken);	
		
		return $response_data;
	}

	public static function PlaceOrder($paramArray)
	{
		extract($paramArray);
		$api_key = '';
		$getApiKey 	=	self::getApiKey();
		if($getApiKey['status']){
			$api_key = $getApiKey['api_key'];
		}

		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData 	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['order_place'];

			$api_parameter	=	array(
									'symbol'		=>	"$symbol",
									'exc'			=>	"$exc",
									'ordAction'		=>	"$ordAction",
									'ordValidity' 	=>	"$ordValidity",
									'ordType'		=>	"$ordType",
									'prdType'		=>	"$prdType",
									'qty'			=>	"$qty",
									'disQty'		=>	"$disQty",
									'lotSize'		=>	"$lotSize",
									'triggerPrice'  =>	isset($triggerPrice)?"$triggerPrice":"",
									'instrument'	=>	"$instrument",
									'limitPrice'	=>	"$limitPrice",
									'amo'			=>  "$amo",
									'build'			=>	"$build",
									'excToken'		=>	"$excToken",
									'boStpLoss'		=>	"$boStpLoss",
									'boTgtPrice'	=>	"$boTgtPrice",
									'trailingSL'	=>	"$trailingSL"
								);

			
			// Common function to call smart api
			$response_data 	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function ModifyOrder($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData 	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['order_modify'];
			
			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}
			
			$api_parameter	=	array(
									'triggerPrice'		=>	"$triggerPrice",
									'ordType'			=>	"$ordType",
									'prdType'			=>	"$prdType",
									'instrument'		=>	"$instrument",
									'exc'				=>	"$exc",
									'qty'				=>	"$qty",
									'lotSize'			=>	"$lotSize",
									'symbol'			=>	"$symbol",
									'ordId'				=>	"$ordId",
									'ordAction'			=>	"$ordAction",
									'limitPrice'		=>	isset($limitPrice)?"$limitPrice":"",
									'disQty'			=>	"$disQty",
									'ordValidity'		=>	"$ordValidity",
									'tradedQty'			=>  "$tradedQty",
									'ordValidityDays' 	=>  "$ordValidityDays",
									'exchangeToken'		=>  "$exchangeToken",
									'amo'				=>  "$amo"
								);
			// Common function to call smart api
			$response_data 	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function CancelOrder($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['order_cancel'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'symbol'	=>	$symbol,
									'exc'		=>	$exc,
									'ordId'		=>	$ordId
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function Holdings()
	{
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['holdings'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, '', $accessToken, 'GET', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function OrderBook($paramArray)
	{
		extract($paramArray);
		
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['order_book'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, '', $accessToken, 'GET', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function TradeDetails($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['trade_details'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'ordId'		=>	$ordId
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function OrderHistory($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['order_history'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'ordId'		=>	$ordId,
									'instrument'=>	$instrument
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function OrderDetails($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['order_details'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'ordId'		=>	$ordId
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function Brokerage($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['brokerage'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'symbol'		=>	$symbol,
									'orderAction'	=>	$orderAction,
									'excToken'		=>	$excToken,
									'exc'			=>	$exc,
									'qty'			=>	$qty,
									'price'			=>	$price,
									'product'		=>	$product,
									'triggerPrice'	=>	$triggerPrice,
									'instrument'	=>	$instrument,
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function IntradayCandleData($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['intraday_candle_data'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'data'		=>	$data,
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function ProfitLossReport($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['profit_loss_report'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'data'		=>	$data
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function GetProfile($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
		
			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}
			
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['get_profile'];

			$api_parameter	=	array(
									'data'		=>	array(
										'appID'		=> $appID
									),
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST',$api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function GetFunds()
	{
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['get_funds'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, '', $accessToken, 'GET', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function GetOhlc($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['get_ohlc'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'data'		=>	$data
								);

			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function Quote($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['quote'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'data'		=>	$data,
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function TradeBook()
	{
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['trade_book'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, '', $accessToken, 'GET', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function OrderExit($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['order_exit'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'symbol'		=> $symbol,
									'exc'			=> $exc,
									'prdType'		=> $prdType,
									'boOrdStatus'	=> $boOrdStatus,
									'ordId'			=> $ordId,
									'parOrdId'		=> $parOrdId
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function ConvertPosition($paramArray)
	{
		extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['convert_position'];

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			$api_parameter	=	array(
									'type'			=> $type,
									'ordAction'		=> $ordAction,
									'prdType'		=> $prdType,
									'toPrdType'		=> $toPrdType,
									'qty'			=> $qty,
									'symbol'		=> $symbol,
									'excToken'		=> $excToken,
									'exc'			=> $exc,
									'lotSize'		=> $lotSize,
									'instrument'	=> $instrument
								);
			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, $api_parameter, $accessToken, 'POST', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function PositionBook($paramArray)
	{
		//extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['position_book'].'?'.$paramArray;

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, '', $accessToken, 'GET', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function HistoricalCandleData($paramArray)
	{
		//extract($paramArray);
		$token 	=	self::getToken();
		if ($token['status']) {
			$accessToken	=	$token['accessToken'];
			$UrlData	=	JmfConfigurationManage::JmfConfigrationData();
			$url 		=	$UrlData['root'].$UrlData['historical_candle_data'].'?'.$paramArray;

			$api_key = '';
			$getApiKey 	=	self::getApiKey();
			if($getApiKey['status']){
				$api_key = $getApiKey['api_key'];
			}

			// Common function to call smart api
			$response_data	=	self::CurlOperation($url, '', $accessToken, 'GET', $api_key);
		}
		else{
			$response_data['status'] = 'fail';
			$response_data['error'] = 'The token is invalid';
			$response_data	=	json_encode($response_data);
		}
		
		return $response_data;
	}

	public static function getToken()
	{
		$accessToken = '';
		$api_key = '';

		if (isset($_SESSION['accessToken']) && !empty($_SESSION['accessToken'])) {
			$accessToken	=	$_SESSION['accessToken'];
		}
		else if (isset($_COOKIE['accessToken']) && !empty($_COOKIE['accessToken'])) {
			$accessToken	=	$_COOKIE['accessToken'];
		}

		if (isset($_SESSION['api_key']) && !empty($_SESSION['api_key'])) {
			$api_key	=	$_SESSION['api_key'];
		}
		else if (isset($_COOKIE['api_key']) && !empty($_COOKIE['api_key'])) {
			$api_key	=	$_COOKIE['api_key'];
		}

		$output = array('accessToken'=>$accessToken,
						'api_key' => $api_key,
						'status'=>true);
		if ($accessToken=='') {
			$output['status'] = false;
		}		

		return $output;
	}

	public static function getApiKey()
	{
		$api_key = '';

		if (isset($_SESSION['api_key']) && !empty($_SESSION['api_key'])) {
			$api_key	=	$_SESSION['api_key'];
		}
		else if (isset($_COOKIE['api_key']) && !empty($_COOKIE['api_key'])) {
			$api_key	=	$_COOKIE['api_key'];
		}

		$output = array('api_key' => $api_key,
						'status'=>true);
		if ($api_key=='') {
			$output['status'] = false;
		}		

		return $output;
	}

	public static function CurlOperation($url, $api_parameter='', $accessToken='', $method, $api_key)
	{

		// Common function start

		$headers = [
                "Content-Type: application/json",
                "X-Content-Type-Options:nosniff",
                "Accept:application/json",
                "X-UserType: USER",
                "X-SourceID: WEB",
                "X-ClientLocalIP: 192.168.168.168",
                "X-ClientPublicIP: 106.193.147.98",
                "X-MACAddress: fe80::216e:6507:4b90:3719",
                "api-key: ".$api_key,
                //"authorization: Bearer $accessToken"
            ];
        
		if ($accessToken!='') {
           	array_push($headers, "authorization: Bearer $accessToken");
        }


      	$ch = curl_init();
		  
		// Receive server response ...
		curl_setopt($ch, CURLOPT_URL, $url); 
	
		// Return Page contents. 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		curl_setopt($ch,CURLOPT_ENCODING, "");
        curl_setopt($ch,CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch,CURLOPT_TIMEOUT, 0);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "$method");
        if ($api_parameter!='') {
        	curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($api_parameter)); 
        }
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		

		$result = curl_exec($ch); 
		$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($result === false || $result==null)
		{
			$response_data['status'] = 'fail';
			$response_data['error'] = curl_error($ch);
		}
		else
		{
		    $response_data['status'] = 'success';
		}

		curl_close($ch); 

		$jsonArrayResponse = json_decode($result);

		$response_data['http_code'] = $response;
		$response_data['http_error']	=	self::getErrorMessage($response);
		$response_data['response_data'] = $jsonArrayResponse;

		

		return json_encode($response_data);

		// Common function end
	}

	public static function getErrorMessage($http_code)
	{
		
		switch ($http_code) {
			case '400':
				$message = "Invalid parameters";
				break;
			case '405':
				$message = "Method not allowed";
				break;
			case '500':
				$message = "Syntax error or empty or invalid parameter pass";
				break;
			default:
				$message = '';
				break;
		}
		return $message;
	}

}

?>

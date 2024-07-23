<?php

require_once '../vendor/autoload.php';

$api_key = API_KEY;
$accessToken = ACCESS_TOKEN;
$jmf_smart_api  = new Jmf\TradeApiPhpSdk\JmfSmartApi($api_key,$accessToken);
	
//Login API
// $login = $jmf_smart_api->userLogin("MOBILE_NUMBER","PASSWORD","USER_ID");
// echo "Login Response: ". $login;

//Place Holder 
// $placeOrderParams = array(
//                "symbol"=> "NATIONALUM-EQ",
//                "excToken"=> "6364",
//                "ordAction"=> "Buy",
//                "ordValidity"=> "DAY",
//                "ordType"=> "LIMIT",
//                "prdType"=> "NORMAL",
//                "qty"=> 5,
//                "triggerPrice"=> 0,
//                "limitPrice"=> 192.55,
//                "disQty"=> 0,
//                "instrument"=> "STK",
//                "exc"=> "NSE",
//                "lotSize"=> 0,
//                "amo"=> false,
//                "build"=> "MOB",
//                "boStpLoss"=> 0,
//                "boTgtPrice"=> 0,
//                "trailingSL"=> 0
//             );

//$place_order = $jmf_smart_api->PlaceOrder($placeOrderParams);
//echo "<br/> Place Order Response:". $place_order;

//Order Book
// $orderBookParams = array(
//    "ordId" => "240712000000057"
// );

// $orderBook = $jmf_smart_api->OrderBook($orderBookParams);
// echo "<br/> Order Book Response:". $orderBook;

//Modify Order
// $modifyOrderParams = array(
//       "triggerPrice" => 0,
//       "ordType" => "LIMIT",
//       "prdType" => "CASH",
//       "instrument" => "STK",
//       "exc" => "NSE",
//       "qty" => 10,
//       "lotSize" => 0,
//       "symbol" => "NATIONALUM-EQ",
//       "ordId" => "240712000000057",
//       "ordAction" => "BUY",
//       "limitPrice" => 192.55,
//       "disQty" => 0,
//       "ordValidity" => "DAY",
//       "tradedQty" => 0,
//       "ordValidityDays" => 0,
//       "exchangeToken" => "13528",
//       "amo" => true
// );

// $modify_order = $jmf_smart_api->ModifyOrder($modifyOrderParams);
// echo "<br/> Modify Order Response:". $modify_order;

//Cancel Order
// $cancelOrderParams = array(
//       "symbol" => "HDFCBANK-EQ",
//       "exc" => "NSE",
//       "ordId" => "240712000000057"
// );

// $cancel_order = $jmf_smart_api->CancelOrder($cancelOrderParams);
// echo "<br/> Cancel Order Response:". $cancel_order;


//Order History
// $OrderHistoryParams = array(
//       "instrument" => "STK",
//       "ordId" => "240712000000057"
// );

// $order_history = $jmf_smart_api->OrderHistory($OrderHistoryParams);
// echo "<br/> Order History Response:". $order_history;


// Get Profile
// $getProfileParams = array(
//    "appID" => "1"
// );

// $getProfile = $jmf_smart_api->GetProfile($getProfileParams);
// echo "<br/> Get Profile Response:". $getProfile;


// Quote

// $data = array(
//    "instruments" => [(object)[
//         "exchange"=> "NSE",
//         "exchangeInstrumentID"=> "22"
//    ]
//    ],
//    "appID" => 1
// );

// $quoteParams = array("data" => $data);

// $quote = $jmf_smart_api->Quote($quoteParams);
// echo "<br/> Quote Response:". $quote;

// Get Funds
// $getFunds = $jmf_smart_api->GetFunds();
// echo "<br/> Get Funds Response:". $getFunds;


// Holding
// $holdings = $jmf_smart_api->Holdings();
// echo "<br/> Holdings Response:". $holdings;

// Brokerage
// $brokerageParams = array(
//         "symbol" => "ACC-EQ",
//         "exc" => "NSE",
//         "product" => "NRML",
//         "triggerPrice" => "",
//         "price" => "3000",
//         "qty" => "100",
//         "instrument" => "",
//         "orderAction" => "BUY",
//         "excToken" => "25"
// );

// $brokerage = $jmf_smart_api->Brokerage($brokerageParams);
// echo "<br/> Brokerage Response:". $brokerage;


// Order Details
// $orderDetailsParams = array(
//         "ordId" => "240715000000002"
// );

// $orderDetails = $jmf_smart_api->OrderDetails($orderDetailsParams);
// echo "<br/> Order Details Response:". $orderDetails;

// Get Ohlc
// $data = array(
//    "instruments" => [(object)[
//         "exchange"=> "NSE",
//         "exchangeInstrumentID"=> "6364"
//    ]]
// );

// $getOhlcParams = array("data" => $data);

// $getOhlc = $jmf_smart_api->GetOhlc($getOhlcParams);
// echo "<br/> get Ohlc Response:". $getOhlc;

// Intraday 
// $data = array(
//     "exchangeInstrumentID" => "22",
//     "exchange"  => "NSE",
//     "startTime" => "Mar 14 2024 150000",
//     "endTime"   => "Mar 14 2024 161500"
// );

// $intradayCandleDataParams = array(
//     "data" => $data
// );

// $intradayCandleData = $jmf_smart_api->intradayCandleData($intradayCandleDataParams);
// echo "<br/> Intraday Candle Data Response:". $intradayCandleData;

// Profit or Loss 
// $data = array(
//     "fromDate" => "",
//     "months"  => "10",
//     "fy" => "",
//     "segment"   => "equity",
//     "toDate"    => "",
//     "days"  => ""
// );

// $profitLossReportParams = array(
//     "data" => $data
// );

// $profitLossReport = $jmf_smart_api->ProfitLossReport($profitLossReportParams);
// echo "<br/> Profit Loss Report Response:". $profitLossReport;

// Historical Candle Data
// $HistoricalCandleDataParams = 'symbol=NATIONALUM&resolution=1D&from=785244&to=9777&countback=200&exc=NSE&streamSymbol=6364';

// $historicalCandleData = $jmf_smart_api->HistoricalCandleData($HistoricalCandleDataParams);
// echo "<br/> Historical Candle Data Response:". $historicalCandleData;

// Trade Book
// $TradeBook = $jmf_smart_api->TradeBook();
// echo "<br/>Trade Book Response:". $TradeBook;


// Convert Position
// $convertPositionParams = array(    
//         "type" => "DAY1",
//         "ordAction" => "buy",
//         "toPrdType" => "NRML",
//         "prdType" => "CNC",
//         "qty" => "30",
//         "exc" => "NSE",
//         "instrument" => "STK",
//         "symbol" => "ADANIENT-EQ",
//         "lotSize" => "1",
//         "excToken" => "25"
// );

// $convertPosition = $jmf_smart_api->ConvertPosition($convertPositionParams);
// echo "<br/> Convert Position Response:". $convertPosition;

// Position Book
// $PositionBookParams = 'type=net';

// $PositionBook = $jmf_smart_api->PositionBook($PositionBookParams);
// echo "<br/> Position Book Response:". $PositionBook;


// Trade Details
// $tradeDetailsParams = array(
//     "ordId" => "240723000000018"
// );

// $tradeDetails = $jmf_smart_api->TradeDetails($tradeDetailsParams);
// echo "<br/> Trade Details Response:". $tradeDetails;

?>

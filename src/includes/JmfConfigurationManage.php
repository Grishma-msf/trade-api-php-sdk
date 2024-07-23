<?php
namespace Jmf\TradeApiPhpSdk;

class JmfConfigurationManage
{
	public static function JmfConfigrationData()
	{		
            
        $Configration = 
            [
                "root"                  => "https://uapix.blinkx.in",
                "debug"                 => false,
                "timeout"               => 60000,
                "user_login"            => "/auth-services/api/auth/v1/login",
                "order_place"           => "/wrapper-order-service/api/order/v1/place-order",
                "order_modify"          => "/wrapper-order-service/api/order/v1/modify-order",
                "order_cancel"          => "/wrapper-order-service/api/order/v1/cancel-order",
                "holdings"              => "/wrapper-details-service/api/portfolio/v1/holdings",
                "order_book"            => "/wrapper-details-service/api/order/v1/order-book",
                "trade_details"         => "/wrapper-details-service/api/order/v1/trade-details",
                "order_history"         => "/wrapper-details-service/api/order/v1/order-history",
                "order_details"         => "/wrapper-details-service/api/order/v1/order-details",
                "brokerage"             => "/wrapper-details-service/api/trade/v1/brokerage",
                "intraday_candle_data"  => "/wrapper-details-service/api/chart/v1/intraday-candle-data",
                "profit_loss_report"    => "/wrapper-details-service/api/trade/v1/profit-loss-report",
                "get_profile"           => "/wrapper-details-service/api/user/v1/get-profile",
                "get_funds"             => "/wrapper-details-service/api/funds/v1/get-funds",
                "get_ohlc"              => "/wrapper-details-service/api/quote/v1/get-ohlc",
                "quote"                 => "/wrapper-details-service/api/market/v1/quote",
                "trade_book"            => "/wrapper-details-service/api/order/v1/trade-book",
                "order_exit"            => "/wrapper-order-service/api/order/v1/exit-order",
                "convert_position"      => "/wrapper-order-service/api/portfolio/v1/convert-positions",
                "position_book"         => "/wrapper-details-service/api/portfolio/v1/position-book",
                "historical_candle_data"=> "/wrapper-details-service/api/chart/v1/historical-candle-data",
            ];

        return $Configration;	
	}		
}		
?>

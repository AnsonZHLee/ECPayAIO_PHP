<?php
/**
*    WebATM產生訂單範例
*/
    
    //載入SDK(路徑可依系統規劃自行調整)
    include('ECPay.Payment.Integration.php');
    try {
        
    	$obj = new ECPay_AllInOne();
   
        //服務參數
        $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V2"; //服務位置
        $obj->HashKey     = '5294y06JbISpM5x9' ;                                          //測試用Hashkey，請自行帶入ECPay提供的HashKey
        $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                          //測試用HashIV，請自行帶入ECPay提供的HashIV
        $obj->MerchantID  = '2000132';                                                    //測試用MerchantID，請自行帶入ECPay提供的MerchantID


        //基本參數(請依系統規劃自行調整)
        $MerchantTradeNo = "Test".time() ;
        $obj->Send['ReturnURL']         = "http://www.ecpay.com.tw/receive.php" ;    //付款完成通知回傳的網址
        $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;                           //訂單編號
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                        //交易時間
        $obj->Send['TotalAmount']       = 2000;                                       //交易金額
        $obj->Send['TradeDesc']         = "good to drink" ;                           //交易描述
        $obj->Send['ChoosePayment']     = ECPay_PaymentMethod::WebATM ;                     //付款方式:WebATM

        //訂單的商品資料
        array_push($obj->Send['Items'], array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000",
                   'Currency' => "元", 'Quantity' => 1, 'URL' => "dedwed"));

        # 電子發票參數
        /*
        $obj->Send['InvoiceMark'] = InvoiceState::Yes;
        $obj->SendExtend['RelateNumber'] = $MerchantTradeNo;
        $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
        $obj->SendExtend['CustomerPhone'] = '0911222333';
        $obj->SendExtend['TaxType'] = TaxType::Dutiable;
        $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
        $obj->SendExtend['InvoiceItems'] = array();
        // 將商品加入電子發票商品列表陣列
        foreach ($obj->Send['Items'] as $info)
        {
            array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => TaxType::Dutiable));
        }
        $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
        $obj->SendExtend['DelayDay'] = '0';
        $obj->SendExtend['InvType'] = InvType::General;
        */

        //產生訂單(auto submit至ECPay)
        //$obj->CheckOut();
       echo $obj->CheckOut();

    
    } catch (Exception $e) {
    	echo $e->getMessage();
    } 


 
?>
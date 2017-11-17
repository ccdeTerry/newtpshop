<?php
/**
 * Created by PhpStorm.
 * function.php
 * author: Terry
 * Date: 2017-10-10
 * Time: 16:35
 * description:
 */
/**
 * @postAlipay
 *
 * @param $order_id  订单id
 * @param $order_name 订单名称
 * @param $order_price 订单金额
 * @param $order_body 订单描述
 *
 * @author : Terry
 * @return
 */
function  postAlipay($order_id,$order_name,$order_price,$order_body=''){
    Vendor('Alipay.config');
    Vendor('Alipay.pagepay.service.AlipayTradeService');
    Vendor('Alipay.pagepay.buildermodel.AlipayTradePagePayContentBuilder');
    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no = trim($order_id);
    //订单名称，必填
    $subject = trim($order_name);
    //付款金额，必填
    $total_amount = trim($order_price);
    //商品描述，可空
    $body = trim($order_body);
    //构造参数
    $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
    $payRequestBuilder->setBody($body);
    $payRequestBuilder->setSubject($subject);
    $payRequestBuilder->setTotalAmount($total_amount);
    $payRequestBuilder->setOutTradeNo($out_trade_no);
    $aop = new \AlipayTradeService(C('ALIPAY'));

    /**
     * pagePay 电脑网站支付请求
     * @param $builder 业务参数，使用buildmodel中的对象生成。
     * @param $return_url 同步跳转地址，公网可以访问
     * @param $notify_url 异步通知地址，公网可以访问
     * @return $response 支付宝返回的信息
     */
    $config = C('ALIPAY');
//            dump($config);exit();
    $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
    dump($response);
}
<?php
/**
 * @myU 自定义U函数
 *
 * @param $name
 * @param $value
 *
 * @author : Terry
 * @return
 */
function myU($name,$value){
    if ($name=='sort'){
        $sort =$value;
        $price =I('get.price');
    }elseif($name='price'){
        $price=$value;
        $sort=I('get.sort');

    }
    return  U('category/index')."?id=".I('get.id')."&sort=".$sort.'&price='.$price;
}


/**
 * 发送模板短信
 * @param to 手机号码集合,用英文逗号分开
 * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
 * @param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
 */
//sendSms()
function sendTemplateSMS($to,$datas,$tempId)
{
    //要生成手机验证码，并且存储到session里面
    session_start();
    //随机验证码
    $mesNum = C('SHORTMES_NEM');
    $code = rand($mesNum['BEGIN'],$mesNum['END']);
    //主帐号,对应开官网发者主账号下的 ACCOUNT SID
    $accountSid= C('ACCOUNT_SID');
    //主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
    $accountToken= C('AUTH_TOKEN');
    //应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
    //在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
    $appId=C('APP_ID');
    //请求地址
    //沙盒环境（用于应用开发调试）：sandboxapp.cloopen.com
    //生产环境（用户应用上线使用）：app.cloopen.com
    $serverIP='sandboxapp.cloopen.com';
    //请求端口，生产环境和沙盒环境一致
    $serverPort='8883';
    //REST版本号，在官网文档REST介绍中获得。
    $softVersion='2013-12-26';
    vendor('SendShortMes.CCPRestSmsSDK');
    // 初始化REST SDK
    $rest = new \REST($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);
    // 发送模板短信
    //aram to 手机号码集合,用英文逗号分开
    //param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
    //param $tempId 模板Id,测试应用和未上线应用使用测试模板请填写1，正式应用上线后填写已申请审核通过的模板ID
    $result = $rest->sendTemplateSMS($to,array($code,3),$tempId);
    if($result == NULL ) {
        return false;
    }
    if($result->statusCode!=0) {
        return false;

    }else{
        session($to.'code',$code);
        return true;

    }

}

//curl类
function request($url, $https = true, $method = 'get', $data = null,$heard=false) {

    if (!function_exists('curl_init')){
        exit('curl扩展未开启');
    }
    //①初始化url
    //url 目标地址
    $ch = curl_init($url);
//    ②设置相关参数
    //字符串不直接输出,进行一个变量储存
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //判断是不是https请求 443 如果是关闭证书验证
    if ($https === true) {

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    //判断是不是post请求
    if ($method == 'post') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    }
    if ($heard==true){
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json',
                'Content-Length:'.strlen($data))
        );

    }
    //③发送请求
    $str = curl_exec($ch);
    //④关闭资源
    curl_close($ch);
    return $str;
}
//mail发送方法
function sendMail($title, $msghtml, $sendAddress) {
    //引入发送类phpmailer.php
    vendor('PHPMailer.phpmailer');
    //实列化对象
    $mail = new PHPMailer();
    /*服务器相关信息*/
    $mail->IsSMTP(); //设置使用SMTP服务器发送
    $mail->SMTPAuth = true; //开启SMTP认证
    $mail->Host = 'smtp.163.com'; //设置 SMTP 服务器,自己注册邮箱服务器地址
    $mail->Username = 'phpztrtest'; //发信人的邮箱用户名
    $mail->Password = 'ztr2012dl'; //发信人的邮箱密码
    /*内容信息*/
    $mail->IsHTML(true); //指定邮件内容格式为：html
    $mail->CharSet = "UTF-8"; //编码
    $mail->From = 'phpztrtest@163.com'; //发件人完整的邮箱名称
    $mail->FromName = "php_ztr"; //发信人署名
    $mail->Subject = $title; //信的标题
    $mail->MsgHTML($msghtml); //发信主体内容
    // $mail->AddAttachment("fish.jpg");      //附件
    /*发送邮件*/
    $mail->AddAddress($sendAddress); //收件人地址
    //使用send函数进行发送
    if ($mail->Send()) {
        //发送成功返回真
        return true;
        // echo '您的邮件已经发送成功！！！';
    } else {
        return $mail->ErrorInfo; //如果发送失败，则返回错误提示
    }

}

/**
 * checkLoginIp 检测用户ip
 *
 * author :Terry
 * return :
 */
//允许某ip下所有用户访问格式 192.168.1.*
//允许某ip下ip段访问用户访问格式 [192.168.1.1-20,192.168.1.31-40]
//允许某ip下指定用户访问格式  数组形式[192.168.1.1,192.168.1,2]
function checkLoginIp()
{
//    $userIp = get_client_ip();
    $userIp = getIP();
//    dump($userIp);exit;
    $allowIps =C('IPS');
    if (!$allowIps){
        return true;
    }
    $ips=[];
    //判断允许IP个数
    if (count($allowIps) >= 1){
        foreach ($allowIps as $ip){
            //将最后一个数组写入
            $endStr[] =explode('.',$ip)[3];
        }
        //判断$endStr字符串中是否存在- 若存在写是IP段
     if (strpos($endStr[0], '-')){
         //获取ip前缀 截取$ips第一个元素 从0开始截取,截取$endStr中第一个元素出现的位置-1 -1为了删除最后一个.
//         dump(strpos($allowIps[0],$endStr[0]));
         $fix = substr($allowIps[0],0,(strpos($allowIps[0],$endStr[0])-1));
//         dump($fix);exit;
         foreach ($endStr as $value){
             $tmp = explode('-', $value);
             for ($i=$tmp[0];$i<=$tmp[1];$i++){
                 $ips[] =$fix.".".$i;
             }
         }
//         dump($ips);exit;
     }else{
         $ips=$allowIps;
     }
    }else {
     $endStr = explode('.',$allowIps);
        $ips=[];
        if ($endStr[3] =='*'){
            $ip = "$endStr[0].$endStr[1].$endStr[2].";
            for ($i=1;$i<=255;$i++){
              $ips[] = $ip.$i;
            }
        }
    }
    if (!in_array($userIp, $ips)){
        writelog('IPS','illegal_user_ips',$userIp.'非法访问');
        return false;
    }
    return true;
}

//自定义日志类
/**
 *日志记录，按照"Ymd.log"生成当天日志文件
 * 日志路径为：入口文件所在目录/logs/$type/当天日期.log.php，例如 /logs/error/20120105.log.php
 * @param string $type 日志类型，对应logs目录下的子文件夹名
 * @param string $content 日志内容
 * @param string $filename 日志文件名称 若未传参默认日期命名
 * @return bool true/false 写入成功则返回true
 */
function writelog($dir="",$filename='',$content="",$type=""){
    if(!$content || !$dir){
        return FALSE;
    }
    //获取服务器绝对路径 DIRECTORY_SEPARATOR ==/
//    $dir=getcwd().DIRECTORY_SEPARATOR.'Logs'.DIRECTORY_SEPARATOR.$type;
    $dir = APP_PATH.'Runtime'.DIRECTORY_SEPARATOR.'Logs'.DIRECTORY_SEPARATOR.$dir;
    if(!is_dir($dir)){
        if(!mkdir($dir,777)){
            return false;
        }
    }
    //文件名称 若未传参默认日期命名
    if (!$filename){
        $filename=$dir.DIRECTORY_SEPARATOR.date("Ymd",time()).'.log';
    }else{
        $filename=$dir.DIRECTORY_SEPARATOR.$filename.'.log';
    }
    $logs[]=array("date"=>date("Y-m-d H:i:s"),"content"=>$content);
    $str=date('Y-m-d H:i:s').' - '. $content ."\n";

    if(!$fp=@fopen($filename,"a+")){
        return false;
    }
    if(!fwrite($fp, $str)){
        return false;
    }

    fclose($fp);
    return true;
}

/**
 * getIP 获取真实ip
 *
 * author :Terry
 * return :
 */
function getIP() {
    if (getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    } else if (getenv("REMOTE_ADDR")) {
        $ip = getenv("REMOTE_ADDR");

    } else if ($_SERVER['REMOTE_ADDR']) {

        $ip = $_SERVER['REMOTE_ADDR'];

    } else if (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } else {
        $ip = "unknown";
    }

    return $ip;

}

/**
 * @authcode
 *
 * @param        $string
 * @param string $operation
 * @param string $key
 * @param int    $expiry
 *
 * @author : Terry
 * @return
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
{
    // 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
    $ckey_length = 4;

    // 密匙
    $key = md5($key ? $key : 'abc');

    // 密匙a会参与加解密
    $keya = md5(substr($key, 0, 16));
    // 密匙b会用来做数据完整性验证
    $keyb = md5(substr($key, 16, 16));
    // 密匙c用于变化生成的密文
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
    // 参与运算的密匙
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
    // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
    // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    // 产生密匙簿
    for($i = 0; $i <= 255; $i++)
    {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    // 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
    for($j = $i = 0; $i < 256; $i++)
    {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    // 核心加解密部分
    for($a = $j = $i = 0; $i < $string_length; $i++)
    {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        // 从密匙簿得出密匙进行异或，再转成字符
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE')
    {
        // substr($result, 0, 10) == 0 验证数据有效性
        // substr($result, 0, 10) - time() > 0 验证数据有效性
        // substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
        // 验证数据有效性，请看未加密明文的格式
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16))
        {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
        // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
        return $keyc.str_replace('=', '', base64_encode($result));
    }
}


//jxshop  ==>get_data   -->api

//192.168.33.49  newshop.com   /admin;

<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> ECSHOP 管理中心 - 添加分类 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/resources/Admin//Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/resources/Admin//Styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/resources/Admin/Js/jquery-1.8.3.min.js"></script>
</head>
<body>
<h1>
   
    <span class="action-span"><a href="">添加新商品</a></span>
    <span class="action-span1"><a href="">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>

</h1>
<div class="main-div">
    

<!-- 商品列表 -->

<div class="list-div" id="listDiv">
    <table cellpadding="3" cellspacing="1">
        <tr>
            <th>订单号</th>
            <th>订单金额</th>
            <th>订单状态</th>
            <th>收货人</th>
            <th>收货地址</th>
            <th>操作</th>
        </tr>
        
            <?php if(is_array($data['list'])): $i = 0; $__LIST__ = $data['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td align="center"><?php echo ($vo["id"]); ?></td>
            <td align="center"><?php echo ($vo["totao_price"]); ?></td>
            <td align="center"><?php if(($vo["pay_status"]) == "1"): ?>已支付<?php else: ?> 未支付<?php endif; ?></td>
            <td align="center"><?php echo ($vo["name"]); ?></td>
            <td align="center"><?php echo ($vo["address"]); ?></td>
            <td align="center"><?php if(($vo["pay_status"]) == "1"): ?><a href="<?php echo U('Order/send','order_id='.$vo['id']);?>">发货<a><?php endif; ?></td>
          
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        <tr>
           <?php echo ($data["page"]); ?>
        </tr>
    </table>
    
</div>

</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
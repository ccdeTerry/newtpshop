<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 分类添加 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/resources/Admin//Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/resources/Admin//Styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/resources/Admin/Js/jquery-1.8.3.min.js"></script>
</head>
<body>
<h1>
   
    <span class="action-span"><a href="<?php echo U('cateList');?>">商品分类</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加分类 </span>
    <div style="clear:both"></div>
    <link rel="stylesheet" href="/Public/resources/Admin//datetime_js/dist/jquery-ui-timepicker-addon.css" type="text/css">
    <link rel="stylesheet" href="/Public/resources/Admin//datetime_js/dist/jquery-ui-timepicker-addon.css" type="text/css">
    <link type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />

</h1>
<div class="main-div">
    
    <form action="" method="post" name="theForm" enctype="multipart/form-data">
        <table width="100%" id="general-table">

            <div style=" margin:0 auto; width:400px; height:100px;">
                <div style="float: left"> <img src="/<?php echo ($goodsInfo["goods_thumb"]); ?>"></div>
                <div style="float: left">

                    <p><span style="color: red"><b>*每日秒杀上限为5<b></span></p>
                    <p><span>商品名称:</span><?php echo ($goodsInfo["goods_name"]); ?></p>
                    <p><span>商品价格:</span><?php echo ($goodsInfo["shop_price"]); ?>元</p>
                    <p><span>促销价格:</span><?php echo ($goodsInfo["cx_price"]); ?>元</p> </div>
            </div>
            <tr>
                <td class="label">开始时间:</td>
                <td>
                    <input type='text' name='btime' id="btime" maxlength="20" value='' size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">结束时间:</td>
                <td>
                    <input type='text' name='etime' id="etime" maxlength="20" value='' size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">秒杀价格:</td>
                <td>
                    <input type='text' name='seckill_price' maxlength="20" value='' size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">商品数量:</td>
                <td>
                    <input type='text' name='goods_num' maxlength="20" value='' size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <input type="hidden" name="goods_id" value="<?php echo ($goodsInfo["id"]); ?>">
        </table>
        <div class="button-div">
            <input type="submit" value=" 确定 " />
            <input type="reset" value=" 重置 " />
        </div>
    </form>

</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>

    <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script>
    <script src="/Public/resources/Admin//datetime_js/dist/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
    
    <script type="text/javascript">
    $(function () {
        
        console.log(12345678);
        jQuery('#btime').datetimepicker({
            timeFormat: "HH:mm:ss",
            dateFormat: "yy-mm-dd"
        });
        jQuery('#etime').datetimepicker({
            timeFormat: "HH:mm:ss",
            dateFormat: "yy-mm-dd"
        });
    })
</script>
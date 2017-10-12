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
   
    <span class="action-span"><a href="#">商品分类</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加分类 </span>
    <div style="clear:both"></div>

</h1>
<div class="main-div">
    
    <div class="list-div" id="listDiv">
    <form method="post" action="" name="listForm">
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tr>
                <?php if(is_array($attr)): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th><?php echo ($vo["0"]["attr_name"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                <th>数量</th>
                <th>操作</th>
            </tr>
              <?php if(is_array($goodsNumberInfo)): $keys = 0; $__LIST__ = $goodsNumberInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($keys % 2 );++$keys;?><tr align="center" class="0">
               <?php if(is_array($attr)): $i = 0; $__LIST__ = $attr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td align="left" class="first-cell" >
                    <select name="attr[<?php echo ($vo["0"]["attr_id"]); ?>][]">
                        <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i; echo ($v["attr_values"]); ?>
                        <option value="<?php echo ($v["id"]); ?>" <?php if(in_array(($v["id"]), is_array($v2["goods_attr_ids"])?$v2["goods_attr_ids"]:explode(',',$v2["goods_attr_ids"]))): ?>selected="selected"<?php endif; ?>><?php echo ($v["attr_values"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td><?php endforeach; endif; else: echo "" ;endif; ?>
                <td><input type="text" name="goods_number[]" value="<?php echo ($v2["goods_number"]); ?>" /></td>
                <td><input type="button" value="<?php if(($keys) == "1"): ?>+<?php else: ?>-<?php endif; ?>"/></td>
            </tr>
            <input type="hidden" name="goods_id" value="<?php echo ($_GET['goods_id']); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div style="width: 100px;margin: 0 auto"><input type="submit" value="保存"/></div>
    </div>
</form>
</div>

</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>

<script type="text/javascript">
    $(":button").click(function(){
        //取出当前行
        var curr_tr = $(this).parent().parent();
        if($(this).val()=='+'){
            //完成自我复制
            var new_tr = curr_tr.clone(true);
            new_tr.find(":button").val('-');
            curr_tr.after(new_tr);
        }else{
            //完成当前行删除
            curr_tr.remove();
        }
    });
</script>
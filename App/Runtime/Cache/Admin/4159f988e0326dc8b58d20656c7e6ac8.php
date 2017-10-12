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

</h1>
<div class="main-div">
    
    <form action="" method="post" name="theForm" enctype="multipart/form-data">
        <table width="100%" id="general-table">
            <input type="hidden" name="id" value="<?php echo ($listInfo["id"]); ?>">
            <tr>
                <td class="label">权限名称:</td>
                <td>
                    <input type='text' name='rule_name' maxlength="20" value='<?php echo ($listInfo["rule_name"]); ?>' size='27' /> <font color="red">*</font>
                </td>
            </tr>
            <tr>
                <td class="label">模型名称:</td>
                <td>
                    <input type='text' name='module_name' maxlength="20" value='<?php echo ($listInfo["module_name"]); ?>' size='27' /> <font color="red">*</font>
                </td>
            </tr><tr>
                <td class="label">控制器名称:</td>
                <td>
                    <input type='text' name='controller_name' maxlength="20" value='<?php echo ($listInfo["controller_name"]); ?>' size='27' /> <font color="red">*</font>
                </td>
            </tr><tr>
                <td class="label">方法名称:</td>
                <td>
                    <input type='text' name='action_name' maxlength="20" value='<?php echo ($listInfo["action_name"]); ?>' size='27' /> <font color="red">*</font>
                </td>
            </tr>
             <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="parent_id">
                        <option value="0">顶级分类</option>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($listInfo["parent_id"]) == $vo["id"]): ?>selected='selected'<?php endif; ?>> |<?php echo (str_repeat('--',$vo["level"])); echo ($vo["rule_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">是否显示:</td>
                <td>
                    <input type="radio" name="is_show" value="1" <?php if(($listInfo["is_show"]) == "1"): ?>checked='checked'<?php endif; ?> /> 是
                    <input type="radio" name="is_show" value="0"  <?php if(($listInfo["is_show"]) == "0"): ?>checked='checked'<?php endif; ?> /> 否
                </td>
            </tr>
            
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
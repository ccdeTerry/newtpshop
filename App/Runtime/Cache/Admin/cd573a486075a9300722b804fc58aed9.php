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
            <tr>
                <td class="label">属性名称:</td>
                <td>
                    <input type='text' name='attr_name' maxlength="20" value='' size='27' /> <font color="red">*</font>
                </td>
            </tr>
             <tr>
                <td class="label">所属类型:</td>
                <td>
                    <select name="type_id">
                        <option value="">--请选择--</option>
                        <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo (str_repeat('--',$vo["level"])); echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">属性类型:</td>
                <td>
                    <input type="radio" value="1" name="attr_type" checked="true">唯一
                    <input type="radio" value="2" name="attr_type">单选
                </td>
            </tr>
            <tr>
                <td class="label">属性录入方式:</td>
                <td>
                    <input type="radio" name="attr_input_type" value="1"  checked="true"/> 手动录入
                    <input type="radio" name="attr_input_type" value="2"  /> 列表选择
                </td>
            </tr><tr>
                <td class="label">默认值:</td>
                <td>
                    <textarea name="attr_value"></textarea>
                    <span>*属性名称之间必须以英文逗号隔开</span>
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

<script type="text/javascript">
    $("textarea[name='attr_value']").attr('disabled',true);
    $('input[name="attr_input_type"]').change(function () {
        var value=$(this).val();
        if(value==1){
            $("textarea[name='attr_value']").attr('disabled',true).val('');
        }else{
            $("textarea[name='attr_value']").attr('disabled',false).val('');
        }
    })
</script>
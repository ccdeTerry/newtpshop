<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> ECSHOP 管理中心 - 权限分配</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/resources/Admin//Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/resources/Admin//Styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/resources/Admin/Js/jquery-1.8.3.min.js"></script>
</head>
<body>
<h1>
   
    <span class="action-span"><a href="__GROUP__/Category/categoryAdd">添加分类</a></span>
    <span class="action-span1"><a href="__GROUP__">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 商品分类 </span>
    <div style="clear:both"></div>

</h1>
<div class="main-div">
    
    <form action="" method="POST" enctype="multipart/form-data">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <thead>
                <tr>
                    <th width="60">操作</th>
                    <th>权限名称</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($rule)): $i = 0; $__LIST__ = $rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td>
                        <input type="checkbox" class="top" name="rule[]" value="<?php echo ($vo["id"]); ?>"  <?php if(in_array(($vo["id"]), is_array($hasRuleIds)?$hasRuleIds:explode(',',$hasRuleIds))): ?>checked='checked'<?php endif; ?>>
                    </td>
                    <td><?php echo (str_repeat('----',$vo["level"])); echo ($vo["rule_name"]); ?></td>
                   
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                <tr>
                    <td colspan="3">
                        <input type="hidden" name="role_id" value="<?php echo ($_GET['role_id']); ?>" />
                        <button type="submit" class="btn btn-default">表单提交</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </form>

</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
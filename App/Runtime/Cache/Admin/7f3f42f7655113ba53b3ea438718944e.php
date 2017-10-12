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
    

    <!-- 列表 -->
<div class="list-div" id="listDiv">
    
	<table cellpadding="3" cellspacing="1">
        <tr>
            <th >级别名称</th>
            <th >积分上限</th>
            <th >积分下限</th>
			<th width="60">操作</th>
    </tr>
        <?php if(is_array($$data)): $i = 0; $__LIST__ = $$data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="tron">
				<td><?php echo ($v['level_name']); ?></td>
				<td><?php echo ($v['jf_bottom']); ?></td>
				<td><?php echo ($v['jf_top']); ?></td>
		        <td align="center">
		        	<a href="<?php echo U('edit','id='.$v['id']);?>" title="编辑">编辑</a> |
	                <a href="<?php echo U('delete','id='.$v['id']);?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a>
		        </td>
	        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        
	</table>
</div>

</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: category_info.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 添加商品 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/resources/Admin//Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/resources/Admin//Styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/resources/Admin/Js/jquery-1.8.3.min.js"></script>
</head>
<body>
<h1>
   
    <span class="action-span"><a href="<?php echo U('cateList');?>">商品</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 添加分类 </span>
    <div style="clear:both"></div>

</h1>
<div class="main-div">
    

<!-- 商品列表 -->

    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>秒杀编号</th>
                <th>商品ID</th>
                <th>秒杀价格</th>
                <th>秒杀数量</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
        <?php if(is_array($data['list'])): $i = 0; $__LIST__ = $data['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><?php echo ($vo["seckill_key"]); ?></td>
                <td align="center"><span><?php echo ($vo["goods_id"]); ?></span></td>
                <td align="center"><span>￥<?php echo ($vo["seckill_price"]); ?></span></td>
                <td align="center"><span><?php echo ($vo["goods_num"]); ?></span></td>
                <td align="center"><span><?php echo (date('Y-m-d H:i:s',$vo["btime"])); ?></span></td>
                <td align="center"><span><?php echo (date('Y-m-d H:i:s',$vo["etime"])); ?></span></td>
                <td align="center"><span><?php if(($vo['flag']) == "0"): ?>进行中<?php else: ?>已结束<?php endif; ?></span></td>
                <td align="center"><span><?php echo ($vo["create_time"]); ?></span></td>

                <td align="center">
                <a href="" target="_blank" title="查看"><img src="/Public/resources/Admin/Images/icon_view.gif" width="16" height="16" border="0" />查看</a>|
                    <a href="<?php echo U('edit','goods_id='.$vo['id']);?>" title="编辑"><img src="/Public/resources/Admin/Images/icon_edit.gif" width="16" height="16" border="0" />编辑</a>|
                    <?php if(($vo["flag"]) == "0"): ?><a href="<?php echo U('endSeckill','seckillKey='.$vo['seckill_key']);?>" onclick="" title="结束"><img src="/Public/resources/Admin/Images/icon_trash.gif" width="16" height="16" border="0" />立刻结束</a>
                        <?php else: ?>
                        秒杀结束<?php endif; ?>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>

        <!-- 分页开始 -->
        <table id="page-table" cellspacing="0">
            <tr>
                <td width="80%">&nbsp;</td>
                <td align="center" nowrap="true">
                    <?php echo ($data["page"]); ?>
                </td>
            </tr>
        </table>
    <!-- 分页结束 -->
    </div>

</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>
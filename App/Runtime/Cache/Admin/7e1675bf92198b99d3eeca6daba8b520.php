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
    
    <div class="tab-div">
        <div id="tabbar-div">
            <p>
                <span class="tab-front">通用信息</span>
                <span class="tab-front">商品属性</span>
                <span class="tab-front">商品相册</span>
                <span class="tab-front">会员折扣</span>
            </p>
        </div>
    </div>
     <form enctype="multipart/form-data" action="" method="post">
         <input type="hidden" name="id" value="<?php echo ($goodsInfo["id"]); ?>">
          <table width="90%" class="table" align="center" >
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="<?php echo ($goodsInfo["goods_name"]); ?>"size="30" />
                    <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品货号： </td>
                    <td>
                        <input type="text" name="goods_sn" value="<?php echo ($goodsInfo["goods_sn"]); ?>" size="20"/>
                        <span id="goods_sn_notice"></span><br />
                        <span class="notice-span"id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span>
                    </td>
                </tr>
   <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cate_id">
                            <option value="">请选择...</option>
                            <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($goodsInfo["cate_id"]) == $vo["id"]): ?>selected="selected"<?php endif; ?>><?php echo (str_repeat('--',$vo["level"])); echo ($vo["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">扩展分类：</td>
                    <td>
                        <input type="button" name="addExtCate" id="addExtCate" value="增加扩展分类">
                        <?php if(is_array($extGoodsIds)): $i = 0; $__LIST__ = $extGoodsIds;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><select name="ext_cate_id[]" >
                            <option value="">请选择...</option>
                            <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($v["cate_id"]) == $vo["id"]): ?>selected="selected"<?php endif; ?>><?php echo (str_repeat('--',$vo["level"])); echo ($vo["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select><?php endforeach; endif; else: echo "" ;endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td>
                        <input type="text" name="shop_price" value="<?php echo ($goodsInfo["shop_price"]); ?>" size="20"/>
                        <span class="require-field">*</span>
                    </td>
                </tr>
               <tr>
                    <td class="label">促销商品：</td>
                    <td>
                       促销价格: <input type="text" name="cx_price" value="" size="20"/>
                        开始时间:<input type="text" name="start" <?php if(($goodsInfo["statr"]) != "0"): ?>value="<?php echo (date('Y-m-d H:i:s',$goodsInfo["start"])); ?>"<?php endif; ?> size="20"/>
                        结束时间:<input type="text" name="end" <?php if(($goodsInfo["end"]) != "0"): ?>value="<?php echo (date('Y-m-d H:i:s',$goodsInfo["end"])); ?>"<?php endif; ?> size="20"/>
                    </td>
                </tr>
                    <tr>
                    <td class="label">是否上架：</td>
                    <td>
                        <input type="radio" name="is_sale" value="1" <?php if(($goodsInfo["is_hot"]) == "1"): ?>checked=" checked"<?php endif; ?> /> 是
                        <input type="radio" name="is_sale" value="0" <?php if(($goodsInfo["is_hot"]) == "0"): ?>checked=" checked"<?php endif; ?>/> 否
                    </td>
                </tr>
                <tr>
                    <td class="label">加入推荐：</td>
                    <td>
                        <input type="checkbox" name="is_hot" value="1" <?php if(($goodsInfo["is_hot"]) == "1"): ?>checked=" checked"<?php endif; ?>/> 热卖
                        <input type="checkbox" name="is_new" value="1" <?php if(($goodsInfo["is_new"]) == "1"): ?>checked=" checked"<?php endif; ?>/> 新品
                        <input type="checkbox" name="is_rec" value="1" <?php if(($goodsInfo["is_new"]) == "1"): ?>checked=" checked"<?php endif; ?>/> 推荐
                    </td>
                </tr>

                <tr>
                    <td class="label">市场售价：</td>
                    <td>
                        <input type="text" name="market_price" value="<?php echo ($goodsInfo["market_price"]); ?>" size="20" />
                    </td>
                </tr>

                <tr>
                    <td class="label">商品图片：</td>
                    <td>
                        <input type="file" name="goods_img" size="35" />
                    </td>
                </tr>
                <tr>
                    <td class="label">商品描述：</td>
                    <td>
                         <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
                        <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                        <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
                        <script id="editor" type="text/plain" name="goods_body" style="width:1024px;height:500px;">  <?php echo ($goodsInfo["goods_body"]); ?></script>
                      
                    </td>
                </tr>
            </table>
          <table width="90%" class="table" align="center" style="display: none">
              <tr>
                    <td class="label">商品类型：</td>
                    <td>
                        <select name="type_id" id="type_id">
                            <option value="">请选择...</option>
                            <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($goodsInfo["type_id"]) == $vo["id"]): ?>selected='selected'<?php endif; ?>><?php echo ($vo["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <span class="require-field">*</span>
                    </td>
                </tr>
              <tr>
                  <td colspan="2" id="showAttr">
                      <table width="90%"  align="center" >
                          <?php if(is_array($attrInfo)): $i = 0; $__LIST__ = $attrInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvo): $mod = ($i % 2 );++$i; if(is_array($vvo)): $i = 0; $__LIST__ = $vvo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                              <td class="label"><?php if(($vo["attr_type"]) == "2"): ?><a href="javascript:;" onclick="clonethis(this)"><?php if(($i) == "1"): ?>[+]<?php else: ?>[-]<?php endif; ?></a><?php endif; echo ($vo["attr_name"]); ?>:</td>
                              <td>
                                  <?php if(($vo["attr_input_type"]) == "1"): ?><input type="text" name="attr[<?php echo ($vo["attr_id"]); ?>][]" value="<?php echo ($vo["attr_values"]); ?>">
                              <?php else: ?>
                                    <select  name="attr[<?php echo ($vo["attr_id"]); ?>][]">
                                        <option value="">请选择...</option>
                                        <?php if(is_array($vo["attr_value"])): $i = 0; $__LIST__ = $vo["attr_value"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option <?php if(($vo["attr_values"]) == $vv): ?>selected='selected'<?php endif; ?>><?php echo ($vv); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select><?php endif; ?>
                                </td>
                          </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                  </td>
              </tr>
            </table>
          <table width="90%" class="table pic" align="center" style="display: none">
                <tr>
                        
                <td colspan="2">
                    <?php if(is_array($goodsImg)): $i = 0; $__LIST__ = $goodsImg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="width:100px; float: left;height: 140px; margin: 0 10px;"><img src="/<?php echo ($vo["goods_thumb"]); ?>" width="100" height="100">
                    <input type="button" class="delimg" value="删除" data-img-id="<?php echo ($vo["id"]); ?>">
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
                </tr>
              <tr>
                  <td class="label"></td>
                  <td>
                        <input type="button" value="添加商品图片" class="newPics" name="newPics">
                  </td>
              </tr>
              <tr>
                  <td class="label">商品图片:</td>
                  <td>
                        <input type="file" name="fics[]">
                        <span class="require-field">*</span>
                  </td>
              </tr>
            </table>
          <table width="90%" class="table" align="center" style="display: none">
              
                <?php if(is_array($member)): $i = 0; $__LIST__ = $member;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td class="label"><?php echo ($vo["level_name"]); ?>【<?php echo ($vo["level_rate"]); ?>折】：<input type="text" name="member_price[<?php echo ($vo["id"]); ?>]"  value="<?php echo ($vo["price"]); ?>"/></td>
                    <td>
                        <span  style="color: red;">若不填写会员结果则使用默认折扣</span>
                        <span class="require-field">*</span>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
             
            </table>
            <div class="button-div">
                <input type="submit" value=" 确定 " class="button"/>
                <input type="reset" value=" 重置 " class="button" />
            </div>
        </form>

</div>

<div id="footer">
共执行 3 个查询，用时 0.162348 秒，Gzip 已禁用，内存占用 2.266 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>

</body>
</html>

        <script type="text/javascript">
     var ue = UE.getEditor('editor');
     $('#addExtCate').click(function () {
         var newSelect = $(this).next().clone();
         $(this).parent().append(newSelect);

     })
     
     $('#tabbar-div p span').click(function () {
         $('.table').hide();
         var i=$(this).index();
         $('.table').eq(i).show();
     });
     //ajax获取属性
     $('#type_id').change(function () {
         type_id = $(this).val();
         $.ajax({
             url:"<?php echo U('showAttr');?>",
             data:{type_id:type_id},
             type:'post',
             success:function (msg) {
                 $('#showAttr').html(msg);
             }
         })
     })
     //clone 属性
     function clonethis(obj) {
         var current =$(obj).parent().parent();
         if($(obj).html() =="[+]"){
             var newtag =current.clone();
             newtag.find('a').html('[-]');
             current.after(newtag);
         } else{
             current.remove();
         }
       
     }
     //商品相册
     $('.newPics').click(function (obj) {
         var newfile  =$(this).parent().parent().next().clone();
         $('.pic').append(newfile);
     })
     //图片删除
        $('.delimg').click(function () {
            var img_id = $(this).attr('data-img-id');
            var obj = $(this).parent();
            $.ajax({
                url:"<?php echo U('delGoodsImg');?>",
                data:{img_id:img_id},
                type:'post',
                success:function (msg) {
                    if(msg.status==200){
                        obj.remove();
                    }
                }
            })
        })
    </script>
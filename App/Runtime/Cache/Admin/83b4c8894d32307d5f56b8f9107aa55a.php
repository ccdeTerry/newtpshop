<?php if (!defined('THINK_PATH')) exit();?><table width="90%"  align="center" >
    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td class="label"><?php if(($vo["attr_type"]) == "2"): ?><a href="javascript:;" onclick="clonethis(this)">[+]</a><?php endif; echo ($vo["attr_name"]); ?>:</td>
          <td>
              <?php if(($vo["attr_input_type"]) == "1"): ?><input type="text" name="attr[<?php echo ($vo["id"]); ?>][]">
          <?php else: ?>
                <select  name="attr[<?php echo ($vo["id"]); ?>][]">
                    <option value="">请选择...</option>
                    <?php if(is_array($vo["attr_value"])): $i = 0; $__LIST__ = $vo["attr_value"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><option ><?php echo ($vv); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <span class="require-field">*</span><?php endif; ?>
            </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
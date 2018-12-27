<?php if (!defined('THINK_PATH')) exit();?><thead id='ts'>
  <tr>
    <th>操作</th>
    <th>ID</th>
    <th>标题</th>
    <th>客户名称</th>
    <th>IP地址</th>
    <th>优先级</th>
    <th>工单类型</th>
    <th>处理方法</th>
    <th>工单状态</th>
    <th>受理部门</th>
    <th>受理工程师</th>
    <th>受理时间</th>
    <th>是否超时</th>
    <th>提交人</th>
    <th>提交时间</th>
  </tr>
</thead>
<tbody id='tb'>
  <?php if(is_array($orderinfo)): foreach($orderinfo as $key=>$vo): ?><tr onmouseover='mr(this)' onmouseout='mt(this)'>
    <td>
        <div id="confirm" style="display:none;position: absolute;left: 80px;">
        <?php if($vo["type"] != '1'): ?><button class="btn btn-sm btn-success btn-hf" onclick="reply(this)" type="button" title="回复"><i class="fa fa-send"></i> 回复</button>
        <?php else: ?>
        <button class="btn btn-sm btn-success btn-sj" onclick="upshelf(this)" type="button" title="上架完成"><i class="fa fa-check"></i> 上架完成</button><?php endif; ?>
        </div>
        <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
    </td>
    <td class='nid'><?php echo ($vo["nid"]); ?></td>
    <td><?php echo ($vo["title"]); ?></td>
    <td><?=$vo['cname']==""||$vo["cname"]==null?'':$vo["cname"]?></td>
    <td>
      <table style='width: 100%;'>
        <tr>
          <td><?php echo (substr($vo["ipaddr"],0,45)); ?></td>
          <td>
            <?php if(!empty($vo['ipaddr'])&&strlen($vo['ipaddr'])>45) :?>
                <span class="glyphicon glyphicon-eye-open" style="padding-left: 1em" title="<?php echo ($vo["ipaddr"]); ?>"></span>
            <?php endif;?>
          </td>
        </tr>
      </table>
    </td>
    <td>
      <?php switch($vo["priority"]): case "正常": ?><label class='bg-primary bgp'><?php echo ($vo["priority"]); ?></label><?php break;?>
          <?php case "优先": ?><label class='bg-warning bgp'><?php echo ($vo["priority"]); ?></label><?php break;?>
          <?php case "紧急": ?><label class='bg-danger bgp'><?php echo ($vo["priority"]); ?></label><?php break;?>
          <?php default: ?><label class='bg-muted bgp'><?php echo ($vo["priority"]); ?></label><?php endswitch;?>
    </td>
    <td>
      <?php switch($vo["type"]): case "0": ?>问题处理[无服]<?php break;?>
          <?php case "1": ?>上架单<?php break;?>
          <?php case "2": ?>下架单<?php break;?>
          <?php case "3": ?>问题处理<?php break;?>
          <?php case "4": ?>服务器转让<?php break;?>
          <?php default: ?>未知类型<?php endswitch;?>
    </td>
    <td><?php echo ($vo["action"]); ?></td>
    <td><?php echo ($vo["state"]); ?></td>
    <td><?php echo ($vo["recvdept"]); ?></td>
    <td><?=$vo['receiver']==""||$vo['receiver']==null?'':$vo['receiver']?></td>
    <td><?php echo ($vo["receive_at"]); ?></td>
    <td><?=$vo['overtime']=="超时"?"<label class='bg-danger cbgp'>".$vo['overtime']."</label>":"<label class='bg-primary bgp'>".$vo['overtime']."</label>"?></td>
    <td><?php echo ($vo["committer"]); ?></td>
    <td><?php echo ($vo["commit_at"]); ?></td>
    
  </tr><?php endforeach; endif; ?>
</tbody>
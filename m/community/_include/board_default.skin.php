<div class="comWrap">
	<h2>
		<em class="icon"><img  class="bg_color1" src="../images/icon/icon_mList1.png"></em>
		<span><?php echo $bo_subject;?><em class="text_color1">(<?php echo $bo_write_count;?>건)</em></span>
		<?php if($is_write){ ?>
		<div class="titleBtn bg_color1  clearfix positionA" style="top:0; right:0;"><!-- layerBtn -->
			<a onclick="write_layers();">글쓰기<img alt="" src="../images/btn/btn_rightArrow3.png"></a>	
		</div>
		<?php } ?>
	</h2>

	<ul class="boxWrap clearfix positionR">
	<?php foreach($list_row['result'] as $list){ ?>
		<li class="positionR">
			<dl class="clearfix">
				<dt> 
					<a href="../community/view.html?bo_table=<?php echo $bo_table;?>&wr_no=<?php echo $list['wr_no'];?>"><span class="tit"><?php echo stripslashes($list['wr_subject']);?></span></a>
				</dt>
				<dd class="text1 clearfix">
					<span class="id"><?php echo $list['wr_name'];?></span>
					<span class="date"><?php echo substr($list['wr_datetime'],0,11);?></span>
				</dd>
			</dl>
		</li>
	<?php } ?>
	</ul>
</div>
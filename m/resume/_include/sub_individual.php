<div class="mList">
	<h2>
		<em class="icon"><img  class="bg_color1" src="../images/icon/icon_mList1.png"></em>
		<span>일반인재정보<em class="text_color1 pl5">(<?php echo number_format($sub_individual_list['total_count']);?>건)</em></span>
	</h2>

	<ul class="boxWrap clearfix positionR" id="sub_individual">
	<?php 
	if(!$sub_individual_list_count){
	?>
		<li class="bth positionR">
			<dl class="tc clearfix" style="height:40px;line-height:40px;">등록된 인재정보가 없습니다.</dl>
		</li>
	<?php
	} else { 
		for($i=0;$i<$sub_individual_list_count;$i++){
		$no = $sub_individual_list['result'][$i]['no'];
		$wr_id = $sub_individual_list['result'][$i]['wr_id'];
		$list = $alba_resume_user_control->get_resume_service($no,"",44);
		$get_scrap = $alba_user_control->get_scrap_cnt($member['mb_id'], 'alba_resume', $no, date('Y-m-d'));
	?>
		<li class="bth positionR">
			<dl class="resumeList clearfix">
				<dt class="name_wrap"> 
					<a href="./detail.html?no=<?php echo $no;?>">
						<span class="name"><?php echo $list['wr_name'];?></span>
						<?php if($list['wr_photo']){ ?><span class="photo"><img width="16" height="16" src="../images/icon/icon_photo1.gif" class="vb pb2"></span><?php } ?>
						<span class="gender">(<?php echo $list['wr_gender'];?><?php echo $list['wr_age'];?>)</span>
						<span class="career"><?php echo $list['career'];?></span>
					</a> 
				</dt>
				<dd class="text1 positionR" >
					<a href="./detail.html?no=<?php echo $no;?>" class=""><?php echo $list['subject'];?></a>
				</dd>
				<dd class="text2 clearfix positionR">
					<span class="school"><?php echo $list['school_ability'];?></span>
					<span class="add"><?php echo $utility->str_cut($list['wr_area'],18,"");?></span>
					<?php if($list['license']){ ?>
					<span class="license"><em class="payIcon"><?php echo $list['license'];?></em></span>
					<?php } ?>
				</dd>
				<dd class="etc">
					<span class="pay"><em class="number"><?php echo $list['wr_pay'];?></em> 
					<?php if($list['wr_pay']!='추후협의'){ ?>
					<em class="payIcon"><?php echo $list['wr_pay_type'];?></em></span>
					<?php } ?>
				</dd>
				<dd class="scrap" ><!-- bg_color1 -->
					<a onclick="resume_scrap('<?php echo $no;?>');"><img alt="스크랩" src="../images/icon/icon_scrap1.png" class="<?php echo ($get_scrap['cnt'])?'bg_color1':'bg_gray1';?>"></a>
				</dd>
			</dl>
		</li>
	<?php
		} // for end.
	}	// if end.
	?>
	</ul>
</div>
<div class="paging mt20 mb50">
	<span class="page">
	<span id="sub_individual_first"></span>
	<?php
		$sub_individual_pages = str_replace("처음", "<img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\"><img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\">", $sub_individual_pages);
		$sub_individual_pages = str_replace("이전", "<img src=\"../images/btn/btn_leftArrow2.png\" class=\"bg_color1\">", $sub_individual_pages);
		$sub_individual_pages = str_replace("다음", "<img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\">", $sub_individual_pages);
		$sub_individual_pages = str_replace("맨끝", "<img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\"><img src=\"../images/btn/btn_rightArrow2.png\" class=\"bg_color1\">", $sub_individual_pages);
		$sub_individual_pages = preg_replace("/<b>([0-9]*)<\/b>/", "$1", $sub_individual_pages);
		echo $sub_individual_pages;
	?>
	</span>
</div>
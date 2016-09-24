	<div style="width:<?php echo ($mode=='google')?"305":"300";?>px;margin-top:-5px;margin-right:5px;<?php echo ($mode=='google')?"height:300px;":"";?>">
		<div style="width:300px;" class="quickView clearfix positionA">
			<div class="companyName positionR">
				<h2><a href="../alba/alba_detail.php?no=<?php echo $data_no;?>" style="color:#fff;"><?php echo $wr_company_name;?></a></h2>
				<a href="../alba/alba_detail.php?no=<?php echo $data_no;?>" style="top:3px; right:25px; width:66px;" class="btn1 positionA">상세보기</a>
				<?php if($mode=='naver'){ ?>
				<em style="top:6px; right:6px;" class="fr positionA"><img alt="close" src="../images/icon/icon_close3.gif" class="vm" onclick="map_api.mapInfoTestWindow.setVisible(false);"></em>
				<?php } ?>
			</div>
			<div class="titleArea positionR">
				<p class="title"><strong><a target="_blank" href="../alba/alba_detail.php?no=<?php echo $data_no;?>"><?php echo $alba_info['subject'];?></a></strong></p>
				<p class="desc"><?php echo $alba_info['job_type'];?></p>
				<!-- <div class="icons positionA" style="bottom:5px; right:5px;">
					<div><a target="_blank" href="#" class="window" id=""><img width="13" height="13" class="bg_orang" src="../images/icon/icon_newWindow.png" alt="새창으로 열기"></a></div>
					<div><a href="#" class="star" id=""><img width="13" height="13" class="bg_orang" src="../images/icon/icon_star.png" alt="공고스크랩"></a></div>
				</div> -->
			</div>
			<div class="infoArea">
			<ul class="detailItem">
			<?php if($alba_info['wr_pay']){ ?>
				<li>
					<img width="43" height="14" alt="급여조건" src="../images/icon/ico_job_quickView6.gif">
					<span class="txt"><?php echo $alba_info['wr_pay_type'];?> <?php echo $alba_info['wr_pay'];?></span>
				</li>
			<?php } ?>
				<li><img width="43" height="14" alt="마감일" src="../images/icon/ico_job_quickView5.gif"> <?php echo $end_date;?> <?php echo $volume_date;?> </li>
				<li><img width="43" height="14" alt="근무기간" src="../images/icon/ico_job_quickView2.gif"> <?php echo $alba_info['wr_date'];?></li>
				<li><img width="43" height="14" alt="근무요일" src="../images/icon/ico_job_quickView3.gif"> <?php echo $alba_info['wr_week'];?>, <?php echo $alba_info['wr_time'];?> </li>
				<li><img width="43" height="14" alt="성별" src="../images/icon/ico_job_quickView7.gif"> <?php echo $alba_info['wr_gender'];?></li>
				<li><img width="43" height="14" alt="연령" src="../images/icon/ico_job_quickView8.gif"> <?php echo $alba_info['age']['result'];?> <?php echo ",".$alba_info['age']['etc'];?></li>
				<li><img width="43" height="14" alt="모집인원" src="../images/icon/ico_job_quickView9.gif"> <?php echo $alba_info['volmue'];?></li>
			</ul>
			</div> 
		</div>
	</div>
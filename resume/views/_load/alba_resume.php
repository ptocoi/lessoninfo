<?php
		/*
		* /application/resume/views/_load/alba_resume.php
		* @author Harimao
		* @since 2013/10/08
		* @last update 2015/05/07
		* @Module v3.5 ( Alice )
		* @Brief :: Alba Resume detail
		* @Comment :: 이력서 상세보기
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$no = $_POST['no'];

		$list = $alba_resume_user_control->get_resume_service($no,"","", 100, 130);

		/* 희망지역 */
		$wr_area_0 = "";
		if($list['wr_area0']){
			$wr_area_0 .= $category_control->get_categoryCodeName($list['wr_area0']);
		}
		if($list['wr_area1']){
			$wr_area_0 .= " > " . $category_control->get_categoryCodeName($list['wr_area1']);
		}
		$wr_area_1 = "";
		if($list['wr_area2']){
			$wr_area_1 .= $category_control->get_categoryCodeName($list['wr_area2']);
		}
		if($list['wr_area3']){
			$wr_area_1 .= " > " . $category_control->get_categoryCodeName($list['wr_area3']);
		}
		$wr_area = $wr_area_0;
		if($wr_area_1 != '' ){
			$wr_area .= ", ".$wr_area_1;
		}
		$wr_areas = $wr_area;
		/* // 희망지역 */
		
		$wr_date = $category_control->get_categoryCodeName($list['wr_date']);

		// 알바 이력서 열람 정보 저장
		$get_resume = $alba_individual_control->get_resume_no($no);	// 이력서 정보
		$alba_company_control->open_insert($no,$get_resume['wr_id'],"alba");

		switch($mode){

			## 포커스 이력서
			case 'focus':
?>
				<div class="personName positionR">
					<h2 style="color:#fff;"><?php echo $list['name'];?>(<?php echo $list['wr_gender'];?>, <?php echo $list['wr_age'];?>세)</h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../resume/alba_resume_detail.php?no=<?php echo $no;?>">이력서 상세보기</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:resume_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:list_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="infoArea clearfix">
					<div class="photo pr20"><?php echo $list['wr_photo'];?></div>
					<ul class="detailItem">
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView1.gif" alt="희망근무지역"> <span><?php echo $wr_areas;?></span></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView2.gif" alt="희망 근무직종"> <?php echo $list['job_type'];?></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView3.gif" alt="희망 근무기간"> <?php echo $wr_date;?></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView4.gif" alt="학력사항"> <?php echo $list['school_ability'];?> </li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView5.gif" alt="경력사항"> <?php echo $list['wr_career'];?></li>
						<?php if($list['license']){ ?>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView6.gif" alt="자격증"> <?php echo $list['license'];?></li>
						<?php } ?>
					</ul>
				</div> 
<?php
			break;

			## 리스트형 인재정보
			case 'list':
?>
				<div class="personName positionR">
					<h2 style="color:#fff;"><?php echo $list['name'];?>(<?php echo $list['wr_gender'];?>, <?php echo $list['wr_age'];?>세)</h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../resume/alba_resume_detail.php?no=<?php echo $no;?>">이력서 상세보기</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:resume_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:list_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="infoArea clearfix">
					<div class="photo pr20"><?php echo $list['wr_photo'];?></div>
					<ul class="detailItem">
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView1.gif" alt="희망근무지역"> <span><?php echo $wr_areas;?></span></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView2.gif" alt="희망 근무직종"> <?php echo $list['job_type'];?></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView3.gif" alt="희망 근무기간"> <?php echo $wr_date;?></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView4.gif" alt="학력사항"> <?php echo $list['school_ability'];?> </li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView5.gif" alt="경력사항"> <?php echo $list['wr_career'];?></li>
						<?php if($list['license']){ ?>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView6.gif" alt="자격증"> <?php echo $list['license'];?></li>
						<?php } ?>
					</ul>
				</div> 
<?php
			break;

			## 메인하단 인재정보
			case 'basic_list':
?>
				<div class="personName positionR">
					<h2 style="color:#fff;"><?php echo $list['name'];?>(<?php echo $list['wr_gender'];?>, <?php echo $list['wr_age'];?>세)</h2>
					<a class="btn1 positionA" style="top:3px; right:125px; width:120px;" href="../resume/alba_resume_detail.php?no=<?php echo $no;?>">이력서 상세보기</a>
					<a class="btn1 positionA" style="top:3px; right:40px;  width:80px;" href="javascript:resume_scrap('<?php echo $no;?>');">공고 스크랩</a>
					<em class="fr positionA" style="top:6px; right:6px;"><a href="javascript:resume_list_close();"><img class="vm" src="../images/icon/icon_close3.gif" alt="close" /></a></em>
				</div>
				<div class="infoArea clearfix">
					<div class="photo pr20"><?php echo $list['wr_photo'];?></div>
					<ul class="detailItem">
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView1.gif" alt="희망근무지역"> <span><?php echo $wr_areas;?></span></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView2.gif" alt="희망 근무직종"> <?php echo $list['job_type'];?></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView3.gif" alt="희망 근무기간"> <?php echo $wr_date;?></li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView4.gif" alt="학력사항"> <?php echo $list['school_ability'];?> </li>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView5.gif" alt="경력사항"> <?php echo $list['wr_career'];?></li>
						<?php if($list['license']){ ?>
						<li><img class="pr10" width="67" height="14" src="../images/icon/ico_person_quickView6.gif" alt="자격증"> <?php echo $list['license'];?></li>
						<?php } ?>
					</ul>
				</div> 
<?php
			break;
		}	// switch end.
?>
<?php
		/*
		* /application/main/views/_load/poll.php
		* @author Harimao
		* @since 2013/10/31
		* @last update 2015/03/24
		* @Module v3.5 ( Alice )
		* @Brief :: Poll List
		* @Comment :: 설문조사 결과
		*/

		$alice_path = "../../../";

		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$no = $_POST['no'];

		$get_poll = $poll_control->get_poll($no);
		$poll_content = explode('|&|',$get_poll['poll_content']);
		$poll_content_cnt = count($poll_content);
		$poll_answer = explode('|&|',$get_poll['poll_answer']);
		$poll_answer_cnt = count($poll_answer);
		$answer_cnt = array_sum(array_slice($poll_answer, 0, count($poll_content)));

		$page = ($page) ? $page : 1;
		$page_rows = 12;
		$_add = " where `p_no` = '".$no."' ";
		$pollComment_list = $poll_control->__PollcommentList($page, $page_rows, $_add);
		$total_count = $pollComment_list['total_count'];
		$total_page = $pollComment_list['total_page'];
		
		// ajax paging
		$totalpages = ceil($total_count/$page_rows);

?>

	<div class="layerPop  border_color5" style="display:block; width:494px; margin:0 auto; text-align:left; " id="pop_poll">              
		<dl>
			<dt style="padding:20px 15px;" class="bg_gray1 font18"><strong>설문조사 결과보기</strong>
				<em class="closeBtn" onclick="poll_close();"><img width="11" height="11" alt="arrow" src="../images/icon/icon_close2.gif" class="pb5"></em> 
			</dt>
			<!-- 결과 그래픽  -->            
			<dd style="padding:20px 15px 10px;">
				<p style="padding-bottom:5px;">
					<img class="bg_color4" src="../images/icon/icon_survey1.png" alt="Q." />
					<strong class="pl3"><?php echo stripslashes($get_poll['poll_subject']);?></strong><br/>
				</p>
				<div class="mt10 graphBox clearfix" style="border:1px solid #d9d9d9;">
					<ul style="padding:10px;">
						<?php 
							for($i=0;$i<$poll_content_cnt;$i++){
								$pert = ($answer_cnt) ? sprintf("%.2f%%", ($poll_answer[$i]/$answer_cnt) * 100) : "0.0%";
						?>
						<li class="clearfix">
							<div class="tit"><?php echo stripslashes($poll_content[$i]);?></div>
							<div class="graphLine"><img style="width:<?php echo $pert;?>; height:100%;" class="bg_color4" src="../images/icon/icon_blank.gif" alt="그래프" /></div>
							<div class="percent"><strong><?php echo $pert;?></strong> [<?php echo $poll_answer[$i];?>표]</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</dd>
			<!-- 결과 그래픽// --> 
		</dl>
		<div style="margin:30px auto;" class="singleBtn clearfix">
		<ul> 
			<li><div class="btn font_gray bg_white"><a href="javascript:poll_close();">닫기<img width="30" height="9" alt="arrow" src="../images/icon/icon_arrow_right3.png" class="pb5"></a></div></li>
		</ul>
		</div>
	</div>
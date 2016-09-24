<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['board_path'] . "/views/_include/left_navi.php"; ?>
		<div id="rightContent"> 

		<?php /* navigation */ ?>
		<div class="NowLocation mt35 clearfix">
			<p> <a href="/">HOME</a> > <strong><?php echo $menu_name;?></strong> </p>
		</div>
		<?php /* //navigation */ ?>

		<?php if($get_board_main['use_best']){ ?>
		<!--  커뮤니티   -->
		<div class="rightWrap mt20 clearfix ">
			<h2 class="skip">커뮤니티</h2>
			<!--  베스트 오브 베스트   -->        
			<div class="comBest positionR">
				<h3><img class="bg_color4" width="183" height="23" alt="베스트 오브 베스트" src="../images/tit/community_tit_01.png"></h3>
				<div class="positionR clearfix">
					<dl class="bestLeft" >
						<dt class="mb10"><strong><a href="<?php echo $alice['board_path'];?>/board.php?code=<?php echo $best_of_best['code'];?>&bo_table=<?php echo $best_of_best['bo_table'];?>&wr_no=<?php echo $best_of_best['wr_no'];?>"><?php echo stripslashes($best_of_best['wr_subject']);?></a></strong></dt>
						<dd>
						<p><a href="<?php echo $alice['board_path'];?>/board.php?code=<?php echo $best_of_best['code'];?>&bo_table=<?php echo $best_of_best['bo_table'];?>&wr_no=<?php echo $best_of_best['wr_no'];?>"><?php echo stripslashes(strip_tags($best_of_best['wr_content']));?></a></p>
						</dd>
					</dl>
					<dl class="bestRight">
						<dt class="mb10"><strong>금주의베스트</strong></dt>
						<?php 
						if($week_hot_list){ 
							foreach($week_hot_list as $val){ 
						?>
						<dd><a href="<?php echo $alice['board_path'];?>/board.php?code=<?php echo $val['code'];?>&bo_table=<?php echo $val['bo_table'];?>&wr_no=<?php echo $val['wr_no'];?>"><?php echo stripslashes($val['subject']);?></a></dd>
						<?php 
							}
						}
						?>
					</dl>
				</div>
			</div>
			<!--  베스트 오브 베스트//   -->
			<?php } ?>

			<div class="comBoardWrap clearfix">    
			<?php 
			if($use_print==1){	// 1줄 

				foreach($print_board as $key => $val){
					if(!in_array($key,$list_bo_table)) continue;
					if(!$val['view']) 
						continue;
					else
						echo $board_control->latest($key, $val['print_cnt'], $val['subject_len'], $val['print_type'], $val);
				}	// foreach end.

			} else if($use_print==2){	// 2줄 if else 2줄

				foreach($print_board as $key => $val){
					if(!@in_array($key,$list_bo_table)) continue;
					if(!$val['view']) 
						continue;
					else
						echo $board_control->latest($key, $val['print_cnt'], $val['subject_len'], $val['print_type'], $val);
				}	// foreach end.

			}	// if end.
			?>
			</div>

			<?php /* ?>
			<!--  리스트4 한줄 스토리  -->        
			<div class="mt30 comTalk positionR">
			<h3 class="">
			<img class="vm ml5" style="margin-top:-2px;" width="18" height="17"  src="../images/icon/icon_star1.gif" alt="한줄이야기"> 한줄 이야기</h3>
			<em class="positionA" style="top:10px; right:10px;"><a href=""><img width="42" height="15" class="vb bg_color4" src="../images/icon/icon_more1.gif" alt=""></a></em>
			<div class="jobContentWrap clearfix positionR mt10">
			<ul class="comTalkcomment clearfix">
			<li>
			<ul class="comment1 clearfix">
			<li class="pl30">
			<textarea style="width:630px; height:32px; padding:10px;" id="" class="" name=""></textarea></li>                	
			<li class="pl10"><a href="" class="text_color1 bg_color2 border_color1 write" onclick="">글쓰기</a></li>
			</ul>
			</li>
			<li class="pt5">
			<ul class="comment2 clearfix">
			<li class="pr5">
			<label class="ml30">아이디</label> <input type="text" style="width:110px;" class="" id="" name=""></li>
			<li class="pr5"><label>비밀번호</label> <input type="text" style="width:110px;" class="" id="" name=""></li>
			<li class="pr5"><a href="" class="login text_color1 bg_color2 border_color1 tc">로그인</a></li> 
			<em>* 로그인 하셔야 작성하실 수 있습니다.</em>
			</ul>
			</li>
			</ul>
			<ul class="mt30 comTalkList clearfix">
			<li class="comment">  
			<div class="positionR">
			<dl class="pt10 pl10 pr10 pb5 clearfix">
			<dd>
			<p><a href="#reply">휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?</a></p>
			</dd>
			<dt class="mt10 pb5"><strong>id유종원</strong>
			<em class="time"><img class="vm mr5" width="12" height="12"  src="../images/icon/ico_time1.gif" alt="time">04.12 12:11</em>
			<em class="replyBtn"><a href=""><img class="vm bg_color4 mr3" width="11" height="9"  src="../images/icon/icon_reply1.gif" alt="댓글">(2)</a></em>
			<em class="delete"><a href=""><img width="12" height="12" alt="삭제" src="../images/icon/icon_close5.gif" class="vm mr3">삭제</a></em>                                
			</dt>  
			</dl>
			<!--        리플 글쓰기        -->   
			<div id="reply" class="reply pt5 pb10 pl50 " style="display:block;">
			<ul class="comment1 clearfix">
			<li><textarea style="width:590px; height:32px; padding:10px;" id="" class="" name=""></textarea></li>
			<li class="pl10"><a href="" class=" write" onclick="">글쓰기</a></li>
			</ul>
			<ul class="comment2 mt5 clearfix">
			<li class="pr5"><label>아이디</label> <input type="text" name="" id="" class="" style="width:110px;"></li>
			<li class="pr5"><label>비밀번호</label> <input type="text" name="" id="" class="" style="width:110px;"></li>
			<li class="pr5"><a class="login tc" href="">로그인</a></li> 
			<em>* 로그인 하셔야 작성하실 수 있습니다.</em>
			</ul>                                
			</div> 
			<!--        리플 글쓰기  //    -->
			<!--        리플 리스트        -->                                           
			<div class="reply pt5 pb5 pl50 pr10 " style="display:block;">
			<dl class="clearfix">
			<dd>
			<p>휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요?</p>
			</dd>
			<dt class="mt5 pb5"><strong>id유종원</strong><em class="time"><img class="vm mr5" width="12" height="12"  src="../images/icon/ico_time1.gif" alt="time">04.12 12:11</em>
			</dt>  
			</dl>
			</div>
			<!--        리플 리스트             -->                          
			</div>
			</li>
			<li class="comment">  
			<div class="positionR">
			<dl class="pt10 pl10 pr10 pb5 clearfix">
			<dd>
			<p><a href="#reply"> 휴일수당은 나오나요?휴일수당은 나오나요?휴일수당은 나오나요.</a></p>
			</dd>
			<dt class="mt10 pb5"><strong>id유종원</strong>
			<em class="time"><img class="vm mr5" width="12" height="12"  src="../images/icon/ico_time1.gif" alt="time">04.12 12:11</em>
			<em class="replyBtn"><a  href="#reply"><img class="vm bg_color4 mr3" width="11" height="9"  src="../images/icon/icon_reply1.gif" alt="댓글">(0)</a></em>
			</dt>  
			</dl>
			</div>
			</li>
			<li class="comment">  
			<div class="positionR">
			<dl class="pt10 pl10 pr10 pb5 clearfix">
			<dd>
			<p><a href="#reply">lv1    휴일수당은 나오나요?휴일수당은 나오나요.</a></p>
			</dd>
			<dt class="mt10 pb5"><strong>id1245</strong>
			<em class="time"><img class="vm mr5" width="12" height="12"  src="../images/icon/ico_time1.gif" alt="time">04.12 12:11</em>
			<em class="replyBtn"><a  href="#reply"><img class="vm bg_color4 mr3" width="11" height="9"  src="../images/icon/icon_reply1.gif" alt="댓글">(0)</a></em>
			</dt>  
			</dl>
			</div>
			</li>           
			</ul>
			</div>
			</div>
			<!--  리스트4//   --> 
			<?php */ ?>

			</div>
		</div>

	</div>
</section>
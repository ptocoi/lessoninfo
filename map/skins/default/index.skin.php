<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var map_load = function(){
	map_api.map_use("map", "", false);
}
var use_map = "<?php echo $use_map;?>";
var daum_local_APIKEY = "<?php echo $daum_local_key;?>";
var naver_map_KEY = "<?php echo $naver_map_key;?>";
</script>

<script type="text/javascript" src="<?php echo $alice['map_path'];?>/skins/default/index.skin.js"></script>

<section id="content" class="content_wrap clearfix">
	<?php include_once $alice['include_path']."/banner.php"; ?>
	<div class="content2_wrap clearfix"> 
		<?php include_once $alice['include_path'] . "/left_navi.php"; ?>
		<div id="rightContent">
			<?php /* navigation */ ?>
			<div class="NowLocation mt35 clearfix">
				<p> <a href="/">HOME</a> > <a href="<?php echo $alice['alba_path'];?>">채용정보</a> > <a href="<?php echo $alice['alba_path'];?>/alba_list_area.php">지역별 채용정보</a> > <strong>지도검색 채용정보</strong> </p>
			</div>
			<?php /* navigation */ ?>

			<!--  지도검색알바정보 검색영역 -->
			<div class="listWrap mt20">
				<h2 class=""><img src="../images/tit/job_tit_14.gif" width="190" height="25" alt="지도검색 알바정보"></h2>
				<div class="mapBox positionR" style="border:1px solid #ddd; border-top:3px solid #404660; border-bottom:0;">
						<div class="mapSearch positionR" style="background:none repeat scroll 0 0 #F9F9F9; padding:10px;">
							<ul>
							<li style="padding:5px 0;"><!--  시도별알바정보,대학가알바정보에서 display:none -->
										<div class="bigArea ">
											<select class="ipSelect" style="width:220px;" id="wr_area_0" name="wr_area[]" title="시·도 선택" onchange="area_sel_first(this,'wr_area_1');" required hname="근무지 시·도">
											<option value="">시·도</option>
											<?php 
											if($area_list){
												foreach($area_list as $val){ 
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
											?>
											<option value="<?php echo $val['code'];?>"><?php echo $name;?></option>
											<?php 
												}	// foreach end.
											}	// if end.
											?>
											</select>
											<span id="wr_area_1_display">
												<select class="ipSelect" style="width:220px;" id="wr_area_1" name="wr_area[]" title="시군구 선택" onchange="" required hname="근무지 시군구">
												<option value="">시군구</option>
												</select>
											</span>
											<span id="wr_area_2_display">
												<select class="ipSelect" style="width:220px;" id="wr_area_2" name="wr_area[]" title="읍면동 선택" onchange="" required hname="근무지 읍면동">
												<option value="">읍면동</option>
												</select>
											</span>
										</div>
									</li>
									<li style="padding-bottom:5px;">
										<div class="partWrap">
											<select class="ipSelect" style="width:220px;" id="wr_job_type_0" name="wr_job_type[]" title="1차 직종선택" onchange="job_type_sel_first(this,'wr_job_type_1');" required hname="1차직종">
											<option value="">= 1차 직종선택 =</option>
											<?php 
											if($job_type_list){
												foreach($job_type_list as $val){ 
												$name = $utility->remove_quoted($val['name']);	 // (쌍)따옴표 등록시 필터링
												$selected = ($wr_job_type0 == $val['code']) ? "selected" : "";
											?>
											<option value="<?php echo $val['code'];?>" <?php echo $selected;?>><?php echo $name;?></option>
											<?php 
												}	// foreach end.
											} // if end.
											?>
											</select>
											<span id="wr_job_type_1_display">
												<select class="ipSelect" style="width:220px;" id="wr_job_type_1" name="wr_job_type[]" title="2차직종선택" onchange="job_type_sel_first(this,'wr_job_type_2');">
												<option value="">= 2차 직종선택 =</option>
													<option value="">1차 직종을 먼저 선택해 주세요</option>
												</select>
											</span>
											<span id="wr_job_type_2_display">
												<select class="ipSelect" style="width:220px;" id="wr_job_type_2" name="wr_job_type[]" title="3차직종선택">
												<option value="">= 3차 직종선택 =</option>
													<option value="">2차 직종을 먼저 선택해 주세요</option>
												</select>
											</span>
										</div>
									</li>
									<div class="positionA" style="top:15px; right:20px;"><img src="<?php echo $alice['images_path'];?>/btn/btn_map01.gif" style="cursor:pointer;" onclick="map_search();"/></div>
							</ul>
						</div>

					<!-- 지도 -->
					<div class="mapPoint positionR">

						<!-- 공고 포인트
						<div class="point" style="top:100px; left:50px;"><a href=""><img  alt="point" src="../images/icon/map_blue_point.png"></a></div>
						<div class="point" style="top:50px; left:250px;"><a href=""><img  alt="point" src="../images/icon/map_blue_point.png"></a></div>
						<div class="point" style="top:60px; left:150px;"><a href=""><img  alt="point" src="../images/icon/map_blue_point.png"></a></div>
						공고 포인트 // -->

						<div class="mapWrap" style="width:797px; height:1220px;" id="map"></div>

					</div>
					<!-- 지도 // -->
				</div>

			</div>
			<!--  일반채용 end   --> 

		</div>
	</div>
</section>

<script>
$(document).ready(function() {

	map_load();

	<?php for($i=0;$i<$point_data_cnt;$i++){ ?>
		map_api.mapapi_point_is = [<?php echo $point_data[$i]['point'];?>];
		map_api.search_func_map_child('<?php echo $i;?>','<?php echo $point_data[$i][data_no];?>', '../images/icon/map_blue_point.png', 22, 25);
	<?php } ?>
 
});
</script>
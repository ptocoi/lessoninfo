<?php
		/*
		* /application/member/views/_load/layer.php
		* @author Harimao
		* @since 2013/07/15
		* @last update 2015/03/18
		* @Module v3.5 ( Alice )
		* @Brief :: Member load layer
		* @Comment :: 회원정보에 지정에 다른 정보 추출
		*/

		$alice_path = "../../../";
		
		$cat_path = "../../../";

		include_once $alice_path . "_core.php";

		$mode = $_POST['mode'];
		$type = $_POST['type'];
		$no = $_POST['no'];

		$member = $member_control->get_memberNo($no);
		
		switch($mode){

			## 우편번호 (기업회원)
			case 'zipcode_company':

				$map_color = $_POST['map_color'];

				if($type=='new'){
?>
				<div class="bocol lnb_col" style="width:420px; top:20%;left:50%;text-align:left;display:none;z-index:1005;" id="new_postSearchPop">
					<dl>
					<dt style="padding:20px 15px;cursor:pointer;" class="bg_blue2" id="new_postSearchPop_handle">
						<strong>우편번호 검색</strong>
						<em class="closeBtn"><img width="11" height="11" class="pb5" src="../../images/icon/icon_close2.gif" alt="arrow"></em>
					</dt>
					<dd style="padding:20px 15px 30px;">
						<p style="padding-bottom:10px;padding-left:15px; background:url(../../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
							<strong>우편번호 검색</strong><br/>
						</p>
						<div class="box2" style="background:#F8F8F8; border:1px solid #ddd; padding:20px;">
							<ul>
								<li>
									<span>
										<label class="skip">검색어입력</label>
										<input type="text" style="width:280px;ime-mode:active;" name="new_postSearchKeyword" id="new_postSearchKeyword">
										<em class="pr10"><a class="button" onclick="new_postSearchs();"><span>검색</span></a></em>
									</span>
								</li>
								<li class="pt5"><em class="help text_help">※ 도로명을 입력해주세요 (삼성로이면 '삼성'만 입력).</em></li>
							</ul>
						</div>
						<!-- 결과 리스트 -->
						<div class="mt20 addressResult">
							<table width="100%" cellspacing="0" cellpadding="0" align="center" >		
							<colgroup><col width="15%"><col width="50%"><col width="30%"></colgroup>
							<tr>
								<th><strong>우편 번호</strong></th>
								<th><strong>도로명 주소</strong></th>
								<th class=" brend"><strong>지번</strong></th>
							</tr>
							<tbody id="new_post_List">
							<tr>
								<td colspan="3" style="text-align:center;height:165px;">우편번호를 검색해 주세요.</td>
							</tr>
							</tbody>
							</table>
						</div>
						<!-- //결과 리스트 -->
						<div class="mt5">
							<table width="100%" cellpadding="0" cellspacing="0" align="center">
							<tr><td style="padding:15px 0 10px;"><b>회사위치(약도)</b> - 클릭시 위치가 지정됩니다.</td></tr>
							<tr>
								<td>
									<div id="mapBlock" style="border:3px solid <?php echo $map_color;?>">
										<div id="new_mapContainer" style="width:385px;height:230px;"></div>
									</div>
								</td>
							</tr>
							<tr align="center">
								<td style="padding-top:10px;">
									<img src="../../images/btn/btn23_ok.gif" align="absmiddle" style='cursor:pointer;' class='close'>
									<img src="../../images/btn/btn23_08.gif" align="absmiddle" style='cursor:pointer;' class='close'>
								</td>
							</tr>
							</table>
						</div>
					</dd>
					</dl>
				</div>

<?php
				} else {

?>
				<div class="bocol lnb_col" style="width:420px; top:20%;left:50%;text-align:left;display:none;z-index:1005;" id="postSearchPop">
					<dl>
					<dt style="padding:20px 15px;cursor:pointer;" class="bg_blue2" id="postSearchPop_handle">
						<strong>우편번호 검색</strong>
						<em class="closeBtn"><img width="11" height="11" class="pb5" src="../../images/icon/icon_close2.gif" alt="arrow"></em>
					</dt>
					<dd style="padding:20px 15px 30px;">
						<p style="padding-bottom:10px;padding-left:15px; background:url(../../images/icon/icon_arrow_right1.gif) no-repeat 0 20%;">
							<strong>우편번호 검색</strong><br/>
						</p>
						<div class="box2" style="background:#F8F8F8; border:1px solid #ddd; padding:20px;">
							<ul>
								<li>
									<span>
										<label class="skip">검색어입력</label>
										<input type="text" style="width:280px;ime-mode:active;" name="postSearchKeyword" id="postSearchKeyword">
										<em class="pr10"><a class="button" onclick="postSearchs('company');"><span>검색</span></a></em>
									</span>
								</li>
								<li class="pt5"><em class="help text_help">※ 동명을 입력해주세요 (삼성동이면 '삼성동'만 입력).</em></li>
							</ul>
						</div>
						<!-- 결과 리스트 -->
						<div class="mt20 addressResult">
							<table width="100%" cellspacing="0" cellpadding="0" align="center" >		
							<colgroup><col width="20%"><col width="80%"></colgroup>
							<tr>
								<th><strong>우편 번호</strong></th>
								<th class=" brend"><strong>주소</strong></th>
							</tr>		
							<tbody id="post_List">
							<tr>
								<td colspan="2" style="text-align:center;height:165px;">우편번호를 검색해 주세요.</td>
							</tr>
							</tbody>
							</table>
						</div>
						<!-- //결과 리스트 -->
						<div class="mt5">
							<table width="100%" cellpadding="0" cellspacing="0" align="center">
							<tr><td style="padding:15px 0 10px;"><b>회사위치(약도)</b> - 클릭시 위치가 지정됩니다.</td></tr>
							<tr>
								<td>
									<div id="mapBlock" style="border:3px solid <?php echo $map_color;?>">
										<div id="mapContainer" style="width:385px;height:230px;"></div>
									</div>
								</td>
							</tr>
							<tr align="center">
								<td style="padding-top:10px;">
									<img src="../../images/btn/btn23_ok.gif" align="absmiddle" style='cursor:pointer;' class='close'>
									<img src="../../images/btn/btn23_08.gif" align="absmiddle" style='cursor:pointer;' class='close'>
								</td>
							</tr>
							</table>
						</div>
					</dd>
					</dl>
				</div>

<?php
				}
			break;

		}	// switch end.

?>
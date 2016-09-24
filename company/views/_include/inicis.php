<!-- <script language=javascript src="http://plugin.inicis.com/pay61_secuni_cross.js"></script> -->
<script language=javascript src="http://plugin.inicis.com/pay61_secuni_cross.js"></script>
<script language=javascript>
StartSmartUpdate();
</script>
<!------------------------------------------------------------------------------- 
* 웹SITE 가 https를 이용하면 https://plugin.inicis.com/pay61_secunissl_cross.js를 사용 
* 웹SITE 가 Unicode(UTF-8)를 이용하면 http://plugin.inicis.com/pay61_secuni_cross.js를 사용 
* 웹SITE 가 https, unicode를 이용하면 https://plugin.inicis.com/pay61_secunissl_cross.js 사용 
--------------------------------------------------------------------------------> 
<!---------------------------------------------------------------------------------- 
※ 주의 ※
 상단 자바스크립트는 지불페이지를 실제 적용하실때 지불페이지 맨위에 위치시켜 
 적용하여야 만일에 발생할수 있는 플러그인 오류를 미연에 방지할 수 있습니다.

<script language=javascript src="http://plugin.inicis.com/pay61_secuni_cross.js"></script> 
  <script language=javascript>
  StartSmartUpdate();	// 플러그인 설치(확인)
  </script>
-----------------------------------------------------------------------------------> 
<script language=javascript>
var openwin;
function pay(frm) {

	// MakePayMessage()를 호출함으로써 플러그인이 화면에 나타나며, Hidden Field
	// 에 값들이 채워지게 됩니다. 일반적인 경우, 플러그인은 결제처리를 직접하는 것이
	// 아니라, 중요한 정보를 암호화 하여 Hidden Field의 값들을 채우고 종료하며,
	// 다음 페이지인 INIsecureresult.php로 데이터가 포스트 되어 결제 처리됨을 유의하시기 바랍니다.
	if(document.ini.clickcontrol.value == "enable") {

		//alert( document.ini.mid.value );
		
		if(document.ini.goodname.value == "")  { // 필수항목 체크 (상품명, 상품가격, 구매자명, 구매자 이메일주소, 구매자 전화번호)
			alert("상품명이 빠졌습니다. 필수항목입니다.");
			return false;
		} else if(document.ini.buyername.value == "") {
			alert("구매자명이 빠졌습니다. 필수항목입니다.");
			return false;
		}  else if(document.ini.buyeremail.value == "") {
			alert("구매자 이메일주소가 빠졌습니다. 필수항목입니다.");
			return false;
		} else if(document.ini.buyertel.value == "") {
			alert("구매자 전화번호가 빠졌습니다. 필수항목입니다.");
			return false;
		} else if( ( navigator.userAgent.indexOf("MSIE") >= 0 || navigator.appName == 'Microsoft Internet Explorer' ) &&  (document.INIpay == null || document.INIpay.object == null) ) {  // 플러그인 설치유무 체크
			alert("\n이니페이 플러그인 128이 설치되지 않았습니다. \n\n안전한 결제를 위하여 이니페이 플러그인 128의 설치가 필요합니다. \n\n다시 설치하시려면 Ctrl + F5키를 누르시거나 메뉴의 [보기/새로고침]을 선택하여 주십시오.");
			return false;
		} else {
			/******
			 * 플러그인이 참조하는 각종 결제옵션을 이곳에서 수행할 수 있습니다.
			 * (자바스크립트를 이용한 동적 옵션처리)
			 */					 
			if (MakePayMessage(frm)) {
				disable_click();
				openwin = window.open("<?php echo $alice['paygate_path'];?>/INIpay50/childwin.html","childwin","width=299,height=149");		
				return true;
			} else {
				if( IsPluginModule() ) {    //plugin타입 체크
					alert("결제를 취소하셨습니다.");
				}
				return false;
			}
		}
	} else {
		return false;
	}
}

function enable_click() {
	//document.ini.clickcontrol.value = "enable"
	document.getElementById('clickcontrol').value = "enable";
}

function disable_click() {
	document.getElementById('clickcontrol').value = "disable";
	//document.ini.clickcontrol.value = "disable";
}

function focus_control() {
	//if(document.ini.clickcontrol.value == "disable")
	if(document.getElementById('clickcontrol').value == "disable")
		openwin.focus();
}
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

$(document).ready(function(){
	enable_click();
	focus_control();
});
</script>

<form name="ini" method="post" action="<?php echo $alice['paygate_path'];?>/INIpay50/INIsecureresult.php" onSubmit="return pay(this);" id="PayGateFrm"> 
<?php if($package_no){ // 패키지 결제시 ?>
<input type="hidden" name="package_no" value="<?php echo $package_no;?>"/>
<?php } ?>

<!--  결제수단 선택   --> 
<div id="payFrm" class="mainTopBorder positionR mt30 clearfix" style="display:<?php echo ($post_total_price==0)?'none':'';?>;">
	<h3 class="pb5 h3">
		<img width="13" height="13" alt="" src="../images/icon/icon_arrow_4.png" class="bg_color4"> <strong>결제수단 선택</strong>
	</h3>
	<div class="customList1 mb30">
		<div class="CashDone">
			<ul class="option clearfix">
				<?php if(in_array('card',$pg_sel_method)){ // 카드결제 ?>
				<li>
					<input type="radio" name="pay_methods" id="pay_method_card" value="<?php echo $pg_method['card']['gopaymethod'];?>" onclick="sel_methods(this);">
					<label for="pay_method_card"><?php echo $pg_method['card']['name'];?></label>
				</li>
				<?php } ?>
				<?php if(in_array('direct',$pg_sel_method)){ // 실시간 계좌이체 ?>
				<li>
					<input type="radio" name="pay_methods" id="pay_method_direct" value="<?php echo $pg_method['direct']['gopaymethod'];?>" onclick="sel_methods(this);">
					<label for="pay_method_direct"><?php echo $pg_method['direct']['name'];?></label>
				</li>
				<?php } ?>
				<?php if(in_array('virtual',$pg_sel_method)){ // 가상계좌 ?>
				<li>
					<input type="radio" name="pay_methods" id="pay_method_virtual" value="<?php echo $pg_method['virtual']['gopaymethod'];?>" onclick="sel_methods(this);">
					<label for="pay_method_virtual"><?php echo $pg_method['virtual']['name'];?></label>
				</li>
				<?php } ?>
				<?php if(in_array('hphone',$pg_sel_method)){ // 핸드폰 ?>
				<li>
					<input type="radio" name="pay_methods" id="pay_method_hphone" value="<?php echo $pg_method['hphone']['gopaymethod'];?>" onclick="sel_methods(this);">
					<label for="pay_method_hphone"><?php echo $pg_method['hphone']['name'];?></label>
				</li>
				<?php } ?>
				<?php if(in_array('phone',$pg_sel_method)){ // 일반전화 ?>
				<li>
					<input type="radio" name="pay_methods" id="pay_method_phone" value="<?php echo $pg_method['phone']['gopaymethod'];?>" onclick="sel_methods(this);">
					<label for="pay_method_phone"><?php echo $pg_method['phone']['name'];?></label>
				</li>
				<?php } ?>
				<?php if(in_array('bank',$pg_sel_method)){ // 무통장입금 ?>
				<li>
					<input type="radio" name="pay_methods" id="pay_method_bank" value="<?php echo $pg_method['bank']['gopaymethod'];?>" onclick="sel_methods(this);">
					<label for="pay_method_bank"><?php echo $pg_method['bank']['name'];?></label>
				</li>
				<?php } ?>
			</ul>        
		</div>

		<div style="display:none;" class="CashData1" id="bank_info">
			<ul class="clearfix">
				<li class="mt20">
					<label class="title">입금은행</label>
					<select style="width:304px;" class="ipSelect" id="bank_list" name="bank" hname="입금은행" option="select" onchange="bank_lists(this);";>
					<option value="">입금은행 선택</option>
					<?php foreach($bank_list as $_bank){?>
					<option value="<?php echo $_bank['no'];?>">은행명 : <?php echo stripslashes($_bank['bank_name']);?> / 계좌번호 : <?php echo $_bank['bank_num'];?> / 예금주 : <?php echo stripslashes($_bank['name']);?></option>
					<?php } ?>
					</select>
				</li>
				<li class="">
					<label class="title">입금자명</label>
					<input type="text" title="입금자명" value="<?php echo $member['mb_name'];?>" maxlength="6" name="bank_name" id="bank_name" style="width:110px;" class="ipText" hname="입금자명">
				</li>
				<li class="" id="tax_info" style="display:none;">
					<label class="title">현금영수증</label>
					<label><input type="checkbox" id="tax_use" class="check2" value="1" name="tax_use" onclick="tax_uses(this);" hname="현금영수증 발급" option="checkbox">발급</label>
					<dl style="margin-left:150px;display:none;" id="receipt">
						<label><input type="radio" class="radio2" value="1" name="pay_tax_type" checked onclick="tax_type(this);">소득공제용(일반개인용)</label> &nbsp;
						<label><input type="radio" class="radio2" value="2" name="pay_tax_type" onclick="tax_type(this);">지출증빙용(사업자용)</label>
						<!-- 소득공제시 -->
						<dt style="display:none;" class="mt5" id="receipt_person">
							<select class="ipSelect" name="pay_tax_num_type" id="pay_tax_num_type" onchange="tax_num_type(this);">
							<option value="0">주민등록번호</option>
							<option value="1">휴대폰번호</option>
							<option value="2">카드번호</option>
							</select>    
							<input type="text" size="32" class="ipText" name="pay_tax_num_person" id="pay_tax_num_person">
						</dt>
						<!-- 지출증빙시 -->
						<dt style="display:none;" class="mt5" id="receipt_biz">사업자등록번호    
							<input type="text" size="3" class="ipText biz_no" name="pay_tax_num_biz[]" hname="사업자등록번호"> -
							<input type="text" size="2" class="ipText biz_no" name="pay_tax_num_biz[]" hname="사업자등록번호"> -
							<input type="text" size="5" class="ipText biz_no" name="pay_tax_num_biz[]" hname="사업자등록번호">
						</dt>
					</dl>
				</li>
			</ul>
		</div> 

	</div>
</div> 
<!--  결제수단 선택 end   -->          

<input type="hidden" name="gopaymethod" id="pay_method"/>	<!-- 결제수단 -->
<input type="hidden" name="success_url" value="../../<?php echo $alice['company_path'];?>/success.php"/>
<input type="hidden" name="pay_no" size="40" id="pay_no">
<input type="hidden" name="goodname" value="<?php echo $good_name;?>" id="good_name"/>		<!-- 상품명 -->
<input type="hidden" name="buyername" value="<?php echo $member['mb_name'];?>" id="buyer_name"/>		<!-- 주문자명 -->
<input type="hidden" name="buyeremail" value="<?php echo $member['mb_email'];?>" id="buyer_email"/>		<!-- 주문자 이메일 -->
<input type="hidden" name="parentemail"id="parent_email"/>	<!-- 보호자 이메일 -->
<input type="hidden" name="buyertel" value="<?php echo ($member['mb_hphone'])?$member['mb_hphone']:$member['mb_phone'];?>" id="buyer_tel"/>				<!-- 주문자 휴대폰 -->

<input type="hidden" name="currency" size="20" value="WON">
<input type="hidden" name="acceptmethod" size="20" value="HPP(1):Card(0):OCB:receipt:cardpoint">
<input type="hidden" name="oid" size="40" id="oid"><!-- 주문번호 -->
<?php if($get_pg['pg_logo']){ ?>
<input type="hidden" name="ini_logoimage_url" value="http://<?php echo $host_name."/data/logo/".$get_pg['pg_logo'];?>">
<?php } ?>

<input type="hidden" name="mid" id="mid" value="<?php echo $get_pg['pg_id'];?>"/>	<!-- 상점아이디 -->
<input type="hidden" name="price" id="price" value="<?php echo ($is_debug)?$test_price:$post_total_price;?>"/>	<!-- 주문 금액 -->

<input type="hidden" name="ini_encfield" value="<?php echo($inipay->GetResult("encfield")); ?>">
<input type="hidden" name="ini_certid" value="<?php echo($inipay->GetResult("certid")); ?>">
<input type="hidden" name="quotainterest" value="">
<input type="hidden" name="paymethod" value="">
<input type="hidden" name="cardcode" value="">
<input type="hidden" name="cardquota" value="">
<input type="hidden" name="rbankcode" value="">
<input type="hidden" name="reqsign" value="DONE">
<input type="hidden" name="encrypted" value="">
<input type="hidden" name="sessionkey" value="">
<input type="hidden" name="uid" value="<?php echo $member['mb_id'];?>"> 
<input type="hidden" name="sid" value="">
<input type="hidden" name="version" value="4000">
<input type="hidden" name="clickcontrol" value="" id="clickcontrol">

</form>
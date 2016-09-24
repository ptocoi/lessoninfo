<?
    /* ============================================================================== */
    /* =   PAGE : 결제 요청 PAGE                                                    = */
    /* = -------------------------------------------------------------------------- = */
    /* =   이 페이지는 Payplus Plug-in을 통해서 결제자가 결제 요청을 하는 페이지    = */
    /* =   입니다. 아래의 ※ 필수, ※ 옵션 부분과 매뉴얼을 참조하셔서 연동을        = */
    /* =   진행하여 주시기 바랍니다.                                                = */
    /* = -------------------------------------------------------------------------- = */
    /* =   연동시 오류가 발생하는 경우 아래의 주소로 접속하셔서 확인하시기 바랍니다.= */
    /* =   접속 주소 : http://testpay.kcp.co.kr/pgsample/FAQ/search_error.jsp       = */
    /* = -------------------------------------------------------------------------- = */
    /* =   Copyright (c)  2010.02   KCP Inc.   All Rights Reserved.                 = */
    /* ============================================================================== */
?>
<script type="text/javascript" src='<?=$g_conf_js_url?>'></script>
<script type="text/javascript">
	/* 플러그인 설치(확인) */
	StartSmartUpdate();
	
	/*  해당 스크립트는 타브라우져에서 적용이 되지 않습니다.
	if( document.Payplus.object == null )
	{
		openwin = window.open( "chk_plugin.html", "chk_plugin", "width=420, height=100, top=300, left=300" );
	}
	*/

	/* Payplus Plug-in 실행 */
	function  jsf__pay( form )
	{
		var RetVal = false;

		/* Payplus Plugin 실행 */
		if ( MakePayMessage( form ) == true )
		{
			openwin = window.open( "<?php echo $alice['paygate_path'];?>/kcp/proc_win.html", "proc_win", "width=449, height=209, top=300, left=300" );
			RetVal = true ;
		}
		
		else
		{
			/*  res_cd와 res_msg변수에 해당 오류코드와 오류메시지가 설정됩니다.
				ex) 고객이 Payplus Plugin에서 취소 버튼 클릭시 res_cd=3001, res_msg=사용자 취소
				값이 설정됩니다.
			*/
			res_cd  = document.order_info.res_cd.value ;
			res_msg = document.order_info.res_msg.value ;

		}

		return RetVal ;
	}

	// Payplus Plug-in 설치 안내 
	function init_pay_button()
	{
		/*
		if( document.Payplus.object == null )
			document.getElementById("display_setup_message").style.display = "block" ;
		else
			document.getElementById("display_pay_button").style.display = "block" ;
		*/
		// 체크 방법이 변경
		if( GetPluginObject() == null ){
			document.getElementById("display_setup_message").style.display = "block" ;
		}
		else{
			document.getElementById("display_pay_button").style.display = "block" ;
		}
	}

	

	/* 주문번호 생성 예제 */
	function init_orderid()
	{
		var today = new Date();
		var year  = today.getFullYear();
		var month = today.getMonth() + 1;
		var date  = today.getDate();
		var time  = today.getTime();

		if(parseInt(month) < 10) {
			month = "0" + month;
		}

		if(parseInt(date) < 10) {
			date = "0" + date;
		}

		var order_idxx = "TEST" + year + "" + month + "" + date + "" + time;

		//document.order_info.ordr_idxx.value = order_idxx;

		/*
		 * 인터넷 익스플로러와 파이어폭스(사파리, 크롬.. 등등)는 javascript 파싱법이 틀리기 때문에 object 가 인식 전에 실행 되는 문제
		 * 기존에는 onload 부분에 추가를 했지만 setTimeout 부분에 추가
		 * setTimeout 300의 의미는 플러그인 인식속도에 따른 여유시간 설정
		 * - 김민수 - 20101018 -
		 */
		//setTimeout("init_pay_button();",300);
	}

	/* onLoad 이벤트 시 Payplus Plug-in이 실행되도록 구성하시려면 다음의 구문을 onLoad 이벤트에 넣어주시기 바랍니다. */
	function onload_pay()
	{
		 if( jsf__pay(document.order_info) )
			document.order_info.submit();
	}

$(document).ready(function(){
	//init_orderid();
});
</script>

<form name="order_info" method="post" action="<?php echo $alice['paygate_path'];?>/kcp/pp_ax_hub.php" id="PayGateFrm">

<!--  onSubmit="return onload_pay();" -->

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
				<li class="">
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

<input type="hidden" name="success_url" value="../../<?php echo $alice['company_path'];?>/success.php"/>
<input type="hidden" name="no" value="<?php echo $no;?>"/>
<input type="hidden" name="pay_method" id="pay_method"/><!-- 결제수단 -->
<input type="hidden" name="return_url" value="../../<?php echo $alice['company_path'];?>/alba_service.php"/>
<input type="hidden" name="ordr_idxx" id="oid"><!-- 주문번호 -->
<input type="hidden" name="good_name" value="<?php echo $good_name;?>" id="good_name">
<input type="hidden" name="good_mny" value="<?php echo ($is_debug)?$test_price:$post_total_price;?>" id="price">
<input type="hidden" name="buyr_name" value="<?php echo $member['mb_name'];?>" id="buyer_name">
<input type="hidden" name="buyr_mail" value="<?php echo $member['mb_email'];?>" id="buyer_email">
<input type="hidden" name="buyr_tel1" value="<?php echo ($member['mb_hphone'])?$member['mb_hphone']:$member['mb_phone'];?>">
<input type="hidden" name="buyr_tel2" value="<?php echo $member['mb_hphone'];?>">
<?php
    /* ============================================================================== */
    /* =   2. 가맹점 필수 정보 설정                                                 = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 필수 - 결제에 반드시 필요한 정보입니다.                               = */
    /* =   site_conf_inc.php 파일을 참고하셔서 수정하시기 바랍니다.                 = */
    /* = -------------------------------------------------------------------------- = */
    // 요청종류 : 승인(pay)/취소,매입(mod) 요청시 사용
?>
    <input type="hidden" name="req_tx" value="pay" />
    <input type="hidden" name="site_cd" value="<?=$g_conf_site_cd	?>" />
    <input type="hidden" name="site_key" value="<?=$g_conf_site_key  ?>" />
    <input type="hidden" name="site_name" value="<?=$g_conf_site_name ?>" />
<?php
    /*
    할부옵션 : Payplus Plug-in에서 카드결제시 최대로 표시할 할부개월 수를 설정합니다.(0 ~ 18 까지 설정 가능)
    ※ 주의  - 할부 선택은 결제금액이 50,000원 이상일 경우에만 가능, 50000원 미만의 금액은 일시불로만 표기됩니다
               예) value 값을 "5" 로 설정했을 경우 => 카드결제시 결제창에 일시불부터 5개월까지 선택가능
    */
?>
    <input type="hidden" name="quotaopt" value="12"/>    
    <input type="hidden" name="currency" value="WON"/><!-- 필수 항목 : 결제 금액/화폐단위 -->
    <input type="hidden" name="module_type" value="01"/><!-- PLUGIN 설정 정보입니다(변경 불가) -->
    <input type="hidden" name="epnt_issu" value="" /><!-- 복합 포인트 결제시 넘어오는 포인트사 코드 : OK캐쉬백(SCSK), 베네피아 복지포인트(SCWB) -->

    <input type="hidden" name="res_cd" value=""/>
    <input type="hidden" name="res_msg" value=""/>
    <input type="hidden" name="tno" value=""/>
    <input type="hidden" name="trace_no" value=""/>
    <input type="hidden" name="enc_info" value=""/>
    <input type="hidden" name="enc_data" value=""/>
    <input type="hidden" name="ret_pay_method" value=""/>
    <input type="hidden" name="tran_cd" value=""/>
    <!-- <input type="hidden" name="bank_name" value=""/> -->
    <input type="hidden" name="bank_issu" value=""/>
    <input type="hidden" name="use_pay_method" value=""/>

    <!--  현금영수증 관련 정보 : Payplus Plugin 에서 설정하는 정보입니다 -->
    <input type="hidden" name="cash_tsdtime" value=""/>
    <input type="hidden" name="cash_yn" value=""/>
    <input type="hidden" name="cash_authno" value=""/>
    <input type="hidden" name="cash_tr_code" value=""/>
    <input type="hidden" name="cash_id_info" value=""/>

	<!-- 2012년 8월 18일 정자상거래법 개정 관련 설정 부분 -->
	<!-- 제공 기간 설정 0:일회성 1:기간설정(ex 1:2012010120120131)  -->
	<input type="hidden" name="good_expr" value="0">

<?php
    /* ============================================================================== */
    /* =   4. 옵션 정보                                                             = */
    /* = -------------------------------------------------------------------------- = */
    /* =   ※ 옵션 - 결제에 필요한 추가 옵션 정보를 입력 및 설정합니다.             = */
    /* = -------------------------------------------------------------------------- = */

    /* PayPlus에서 보이는 신용카드사 삭제 파라미터 입니다
    ※ 해당 카드를 결제창에서 보이지 않게 하여 고객이 해당 카드로 결제할 수 없도록 합니다. (카드사 코드는 매뉴얼을 참고)
    <input type="hidden" name="not_used_card" value="CCPH:CCSS:CCKE:CCHM:CCSH:CCLO:CCLG:CCJB:CCHN:CCCH"/> */

    /* 신용카드 결제시 OK캐쉬백 적립 여부를 묻는 창을 설정하는 파라미터 입니다
         OK캐쉬백 포인트 가맹점의 경우에만 창이 보여집니다
        <input type="hidden" name="save_ocb"        value="Y"/> */
    
	/* 고정 할부 개월 수 선택
	       value값을 "7" 로 설정했을 경우 => 카드결제시 결제창에 할부 7개월만 선택가능
    <input type="hidden" name="fix_inst"        value="07"/> */

	/*  무이자 옵션
            ※ 설정할부    (가맹점 관리자 페이지에 설정 된 무이자 설정을 따른다)                             - "" 로 설정
            ※ 일반할부    (KCP 이벤트 이외에 설정 된 모든 무이자 설정을 무시한다)                           - "N" 로 설정
            ※ 무이자 할부 (가맹점 관리자 페이지에 설정 된 무이자 이벤트 중 원하는 무이자 설정을 세팅한다)   - "Y" 로 설정
    <input type="hidden" name="kcp_noint"       value=""/> */

    
	/*  무이자 설정
            ※ 주의 1 : 할부는 결제금액이 50,000 원 이상일 경우에만 가능
            ※ 주의 2 : 무이자 설정값은 무이자 옵션이 Y일 경우에만 결제 창에 적용
            예) 전 카드 2,3,6개월 무이자(국민,비씨,엘지,삼성,신한,현대,롯데,외환) : ALL-02:03:04
            BC 2,3,6개월, 국민 3,6개월, 삼성 6,9개월 무이자 : CCBC-02:03:06,CCKM-03:06,CCSS-03:06:04
    <input type="hidden" name="kcp_noint_quota" value="CCBC-02:03:06,CCKM-03:06,CCSS-03:06:09"/> */

	/* 사용카드 설정 여부 파라미터 입니다.(통합결제창 노출 유무)                                                                
	<input type="hidden" name="used_card_YN"        value="Y"/>                                                                 
	/* 사용카드 설정 파라미터 입니다. (해당 카드만 결제창에 보이게 설정하는 파라미터입니다. used_card_YN 값이 Y일때 적용됩니다. 
	/<input type="hidden" name="used_card"        value="CCBC:CCKM:CCSS"/>                                                      
																																
	/* 해외카드 구분하는 파라미터 입니다.(해외비자, 해외마스터, 해외JCB로 구분하여 표시)                                        
	<input type="hidden" name="used_card_CCXX"        value="Y"/>                                                               

    
	/*  가상계좌 은행 선택 파라미터
         ※ 해당 은행을 결제창에서 보이게 합니다.(은행코드는 매뉴얼을 참조) */
?>
    <input type="hidden" name="wish_vbank_list" value="05:03:04:07:11:23:26:32:34:81:71"/>

<?php
    
	
	/*  가상계좌 입금 기한 설정하는 파라미터 - 발급일 + 3일
    <input type="hidden" name="vcnt_expire_term" value="3"/> */

    
	/*  가상계좌 입금 시간 설정하는 파라미터
         HHMMSS형식으로 입력하시기 바랍니다
         설정을 안하시는경우 기본적으로 23시59분59초가 세팅이 됩니다
         <input type="hidden" name="vcnt_expire_term_time" value="120000"/> */


    /* 포인트 결제시 복합 결제(신용카드+포인트) 여부를 결정할 수 있습니다.- N 일경우 복합결제 사용안함
        <input type="hidden" name="complex_pnt_yn" value="N"/>    */


	/* 문화상품권 결제시 가맹점 고객 아이디 설정을 해야 합니다.(필수 설정)
	    <input type="hidden" name="tk_shop_id" value=""/>    */

    
	/* 현금영수증 등록 창을 출력 여부를 설정하는 파라미터 입니다
         ※ Y : 현금영수증 등록 창 출력
         ※ N : 현금영수증 등록 창 출력 안함
		 ※ 주의 : 현금영수증 사용 시 KCP 상점관리자 페이지에서 현금영수증 사용 동의를 하셔야 합니다 */
?>
    <input type="hidden" name="disp_tax_yn"     value="Y"/>
<?php
    /* 결제창에 가맹점 사이트의 로고를 플러그인 좌측 상단에 출력하는 파라미터 입니다
       업체의 로고가 있는 URL을 정확히 입력하셔야 하며, 최대 150 X 50  미만 크기 지원

	※ 주의 : 로고 용량이 150 X 50 이상일 경우 site_name 값이 표시됩니다. */
	if($get_pg['pg_logo']){
?>
    <input type="hidden" name="site_logo" value="http://<?php echo $host_name."/data/logo/".$get_pg['pg_logo'];?>" />
<?php
	}
	/* 결제창 영문 표시 파라미터 입니다. 영문을 기본으로 사용하시려면 Y로 세팅하시기 바랍니다
		2010-06월 현재 신용카드와 가상계좌만 지원됩니다
		<input type='hidden' name='eng_flag'      value='Y'> */
?>

<?php
	/* KCP는 과세상품과 비과세상품을 동시에 판매하는 업체들의 결제관리에 대한 편의성을 제공해드리고자, 
	   복합과세 전용 사이트코드를 지원해 드리며 총 금액에 대해 복합과세 처리가 가능하도록 제공하고 있습니다
	
	   복합과세 전용 사이트 코드로 계약하신 가맹점에만 해당이 됩니다
    
	   상품별이 아니라 금액으로 구분하여 요청하셔야 합니다
	
	   총결제 금액은 과세금액 + 부과세 + 비과세금액의 합과 같아야 합니다. 
	   (good_mny = comm_tax_mny + comm_vat_mny + comm_free_mny)

	   <input type="hidden" name="tax_flag"          value="TG03">     <!-- 변경불가    -->
	   <input type="hidden" name="comm_tax_mny"	     value="">         <!-- 과세금액    --> 
       <input type="hidden" name="comm_vat_mny"      value="">         <!-- 부가세	    -->
	   <input type="hidden" name="comm_free_mny"     value="">         <!-- 비과세 금액 -->  
	   
	   skin_indx 값은 스킨을 변경할 수 있는 파라미터이며 총 7가지가 지원됩니다. 
	   변경을 원하시면 1부터 7까지 값을 넣어주시기 바랍니다. */
?>
    <input type='hidden' name='skin_indx'      value='1'>

<?php
    /* 상품코드 설정 파라미터 입니다.(상품권을 따로 구분하여 처리할 수 있는 옵션기능입니다.)
	<input type='hidden' name='good_cd'      value=''>
	*/
?>
</form>
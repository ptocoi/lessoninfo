<?php if (!defined("_ALICE_")) exit; // 개별 페이지 접근 불가 ?>

<script>
var pg_company = "<?php echo $pg_company;?>";
$(function(){
	$('#pay_total').autoNumeric('init');
});
var email_sel = function( vals ){	// 이메일 서비스 선택
	var sel = vals.value;
	$('#pay_email_tail').val(sel);
}
var sel_methods = function( vals ){		// 결제수단 선택시
	var method = vals.value;
	if( method == 'bank' ){	// 무통장 입금일때
		$('#bank_list').attr('required',true);
		$('#tax_use').attr('required',true);
		$('#bank_info').show();
		$('#tax_info').show();
	} else {	 // 그외
		$('#bank_list').removeAttr('required');
		$('#tax_use').removeAttr('required');
		$('#bank_info').hide();
		$('#tax_info').hide();
	}
}
var pay_submit = function(){	// 선택 서비스 정보 form ajax 전송
	var total_price = $('#total_price').val();
	var pay_options = { beforeSubmit: payRequest, success : payResponse };
	var pay_methods = $("input[name='pay_methods']").is(':checked');
	
	if(total_price!=0){
		if( pay_methods == false ) {
			alert("결제수단을 선택해 주세요.");
			$("input[name='pay_methods']:first").focus();
			return;
		} else {
			var pay_method = $("input[name='pay_methods']:checked").val();
			$('#directFrm > #pay_method').val(pay_method);
			$('#PayGateFrm > #pay_method').val(pay_method);
		}
	}	
	$('#directFrm').attr("action", "./process/direct.php");
	$('#directFrm').ajaxSubmit(pay_options);
	//$('#directFrm').submit();
	//document.directFrm.submit();
}
var tax_uses = function( vals ){	// 현금영수증 발급
	var sel = vals.value;
	var checked = vals.checked;

	var pay_tax_type = $("input[name='pay_tax_type']:checked").val();

	if(checked == true ){	// 체크시
		$('#receipt').show();
		
		if(pay_tax_type=='1'){	// 일반개인용
			var pay_tax_num_type_sel = $("#pay_tax_num_type :selected").val();
			switch(pay_tax_num_type_sel){
				case '0': $('#pay_tax_num_person').attr('hname','주민등록번호'); break;
				case '1': $('#pay_tax_num_person').attr('hname','휴대폰번호'); break;
				case '2': $('#pay_tax_num_person').attr('hname','카드번호'); break;
			}
			$('#pay_tax_num_person').attr('required',true);
			$("input[name='pay_tax_num_biz[]']").removeAttr('required');
			$('#receipt_person').show();
			$('#receipt_biz').hide();
		} else {	 // 사업자용
			$('#pay_tax_num_person').removeAttr('required');
			$("input[name='pay_tax_num_biz[]']").attr('required',true);
			$('#receipt_person').hide();
			$('#receipt_biz').show();
		}

	} else {	 // 체크 해지시
		$('#pay_tax_num_person').removeAttr('required');
		$("input[name='pay_tax_num_biz[]']").removeAttr('required');
		$('#receipt').hide();
	}

}
var tax_num_type = function( vals ){
	var sel = vals.value;
	var $pay_tax_num_person = $('#pay_tax_num_person');
	switch(sel){
		case '0': $pay_tax_num_person.attr('hname','주민등록번호'); break;
		case '1': $pay_tax_num_person.attr('hname','휴대폰번호'); break;
		case '2': $pay_tax_num_person.attr('hname','카드번호'); break;
	}
	$pay_tax_num_person.attr('required',true);
}
var tax_type = function( vals ){	// 소득공제용 / 지출증빙용
	var sel = vals.value;
	if(sel=='1'){
		var pay_tax_num_type_sel = $("#pay_tax_num_type :selected").val();
		switch(pay_tax_num_type_sel){
			case '0': $('#pay_tax_num_person').attr('hname','주민등록번호'); break;
			case '1': $('#pay_tax_num_person').attr('hname','휴대폰번호'); break;
			case '2': $('#pay_tax_num_person').attr('hname','카드번호'); break;
		}
		$('#pay_tax_num_person').attr('required',true);
		$("input[name='pay_tax_num_biz[]']").removeAttr('required');
		$('#receipt_person').show();
		$('#receipt_biz').hide();
	} else {
		$('#pay_tax_num_person').removeAttr('required');
		$("input[name='pay_tax_num_biz[]']").attr('required',true);
		$('#receipt_person').hide();
		$('#receipt_biz').show();
	}
}
</script>

<section id="content" class="content_wrap clearfix">

<!--  content -->
<div class="company2 mt30">
	<h2 class="pb5"><img src="../images/icon/direct_tlt_icon2.png" alt="다이렉트 결제"></h2>	
	<ul class="tlt_title">
		<li><img src="../images/icon/direct_tlt_icon3.png" alt="다이렉트 결제"></li>
		<li>회원정보를 입력해 주시기 바랍니다</li>			
	</ul>

	<form method="post" name="directFrm" action="<?php echo $alice['service_path'];?>/process/regist.php" id="directFrm">
	<input type="hidden" name="mode" value="insert"/>
	<input type="hidden" name="ajax" value="1"/>
	<input type="hidden" name="wr_id" value="<?php echo $member['mb_id'];?>"/>
	
	<input type="hidden" name="pay_method" id="pay_method"/>
	<input type="hidden" name="pay_type" value="direct"/>

	<div class="registWrap mt10">
		<table>
		<colgroup><col width="214px"><col width="*"></colgroup>
		<tbody>
		<tr>
			<th scope="row"><label>이름</label></th>
			<td><input name="pay_name" class="ipText" id="pay_name" style="width:130px;" required type="text" hname="이름"></td>
		</tr>				
		<tr>
			<th scope="row"><label>연락처</label></th>
			<td>
				<div class="mobile">
				<select class="ipSelect" style="width:110px;" name="pay_phone[]" id="pay_phone0" title="휴대폰 국번" hname="휴대폰 국번" required option="select">
				<option value="">국번</option>
				<?php echo $hp_num_option; ?>
				</select>
				</select>
				<span class="delimiter">-</span>
				<input type="text" class="ipText" style="width:120px;" title="휴대폰 앞자리" maxlength="4" name="pay_phone[]" id="pay_phone1" hname="휴대폰 앞자리" required value="">
				<span class="delimiter">-</span>
				<input type="text" class="ipText" style="width:120px;" title="휴대폰 뒷자리" maxlength="4" name="pay_phone[]" id="pay_phone2" hname="휴대폰 뒷자리" required value="">
				</div>
			</td>
		</tr>
		<tr>
			<th scope="row" class="vt"><label>이메일</label></th>
			<td>
				<div class="mbrHelpWrap">
				<input type="text" class="ipText" style="width:150px;ime-mode:disabled;" maxlength="30" id="pay_email" name="pay_email[]" hname="이메일" required value="">
				<span class="delimiter">@</span>
				<input type="text" style="width:185px;ime-mode:disabled;" class="ipText" maxlength="25" title="이메일 서비스 입력" id="pay_email_tail" name="pay_email[]" value="">
				<select class="ipSelect" style="width:105px;" id="email_service" onchange="email_sel(this);">
				<option value="">직접입력</option>
				<?php echo $email_option; ?>
				</select>
				</div>
			</td>
		</tr>	
		</tbody>
		</table>

	</div>

	<ul class="tlt_title">
		<li><img src="../images/icon/direct_tlt_icon3.png" alt="다이렉트 결제"></li>
		<li>결제사항 정보를 입력해 주시기 바랍니다</li>			
	</ul>
	
	<div class="registWrap mt10">
		<table>
		<colgroup><col width="214px"><col width="*"></colgroup>
		<tbody>
		<tr>
			<th scope="row"><label>결제금액</label></th>
			<td><input name="pay_total" class="ipText num" id="pay_total" style="width:130px;ime-mode:inactive;" required type="text" hname="결제금액" placeholder="0" data-v-min="0" data-v-max="10000000000"> 원</td>
		</tr>				
		<tr>
			<th scope="row"><label>결제내용</label></th>
			<td class="pt10 pb10">
				<textarea name="etc_0" class="txt" id="etc_0" style="border: 1px solid rgb(221, 221, 221); width: 98%; height: 80px; -ms-ime-mode: active;" required hname="결제내용"></textarea>
			</td>
		</tr>

		<?php /* ?>
		<tr>
			<th scope="row" class="vt"><label>결제방법</label></th>
			<td>
				<input name="pay_methods" class="chk" id="pay_method_card" required="" onclick="sel_methods(this);" type="radio" value="onlycard" hname="결제수단" option="radio">
				<label for="pay_method_card">신용카드</label>&nbsp;
				<input name="pay_methods" class="chk" id="pay_method_direct" required="" onclick="sel_methods(this);" type="radio" value="onlydbank" hname="결제수단" option="radio">
				<label for="pay_method_direct">실시간 계좌이체</label>&nbsp;
				<input name="pay_methods" class="chk" id="pay_method_bank" required="" onclick="sel_methods(this);" type="radio" value="bank" hname="결제수단" option="radio">
				<label for="pay_method_bank">무통장입금</label>
			</td>
		</tr>
		<?php */ ?>

		</tbody>
		</table>
	</div>

	</form>

	<?php
	switch($pg_company){
		case 'inicis':	## 이니시스
			include_once "./views/_include/inicis.php";
		break;
		case 'allthegate':	## 올더게이트
			include_once "./views/_include/allthegate.php";
		break;
		case 'kcp':	## KCP
			include_once "./views/_include/kcp.php";
		break;
	}	// pg_company switch end.
	?>

	<div style="margin:40px auto;" class="clearfix">
	<ul> 
		<li style="text-align:center;"><a style="cursor:pointer;" onclick="pay_submit();"><img src="../images/icon/direct_tlt_icon1.png" alt="arrow"></a></li>
	</ul>
	</div>

	</div>    <!--  content end --> 

</div>

</section>
<script>
var payRequest = function(formData, jqForm, pay_options){
	var directFrm = document.getElementById('directFrm');
	var PayGateFrm = document.getElementById('PayGateFrm');
	var queryString = $.param(formData);
	if(validate(PayGateFrm)){
		return validate(directFrm);
	} else {
		return false;
	}
}
var payResponse = function(responseText, statusText, xhr, $form){
	
	if(responseText == '0006' ){
		alert("결제 데이터 입력중 오류가 발생하였습니다.\n\n사이트 관리자에게 문의하세요.");
	} else {
		var result = responseText.split('/');
		var pay_no = result[0], oid = result[1], price = result[2], pay_method = result[3];

		if(pay_method=='bank'){	// 무통장 입금
			var PayGateFrm = document.getElementById('PayGateFrm');
			if(validate(PayGateFrm)){
				$('#PayGateFrm').attr("action","./process/direct_bank.php");
				$('#PayGateFrm').removeAttr("onsubmit");
				//location.href = "./success.php?oid=" + oid;
			}/* else {
				return;
			}*/
		}

		$('#pay_no').val(pay_no);
		$('#oid').val(oid);	// 주문번호
		$('#price').val(price);
		$('#buyer_name').val( $('#pay_name').val() );
		$('#buyer_email').val( $('#pay_email').val() +"@" + $('#pay_email_tail').val());
		$('#buyer_tel').val( $('#pay_phone0 :selected').val() + '-' + $('#pay_phone1').val() + '-' + $('#pay_phone2').val() );

		if(pg_company=='inicis'){	// 이니시스

			$('#PayGateFrm').submit();

		} else if(pg_company=='allthegate'){	// 올더게이트

			if(pay_method=='bank'){
				$('#PayGateFrm').submit();
			} else {
				return Pay(frmAGS_pay);
			}

		} else if(pg_company=='kcp'){	// KCP

			if(pay_method=='bank'){
				$('#PayGateFrm').submit();
			} else {
				return onload_pay();
			}

		}

	}

}
</script>
var page_rows = function( vals ){	// ��¼� ����
	var sel = vals.value;
	//$('#page_rows').val(sel);
	serviceListFrmSubmit();
}

var sel_date = function( dates ){

	var todate = new Date();

	switch(dates){

		// �ֱ� 1����
		case '7day':
			startDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() );
			endDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() + 6);
			var start_year = startDate.getFullYear(), start_month = leadingZeros(startDate.getMonth()+1,2), start_date = startDate.getDate() - startDate.getDay();
			var end_year = endDate.getFullYear(), end_month = leadingZeros(endDate.getMonth()+1,2), end_date = leadingZeros(endDate.getDate(),2);
		break

		// �ֱ� 1����
		case '30day':	
			startDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() - 30 );
			endDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() );
			var start_year = startDate.getFullYear(), start_month = leadingZeros(startDate.getMonth()+1,2), start_date = leadingZeros(startDate.getDate()+2,2);
			var end_year = endDate.getFullYear(), end_month = leadingZeros(endDate.getMonth()+1,2), end_date = endDate.getDate();
		break

		// �ֱ� 3����
		case '90day':	
			startDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() - 90 );
			endDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() );
			var start_year = startDate.getFullYear(), start_month = leadingZeros(startDate.getMonth()+1,2), start_date = leadingZeros(startDate.getDate()+1,2);
			var end_year = endDate.getFullYear(), end_month = leadingZeros(endDate.getMonth()+1,2), end_date = endDate.getDate();
		break
	}

	$("#sdate_year > option[value='"+start_year+"']").attr('selected',true);
	$("#sdate_month > option[value='"+start_month+"']").attr('selected',true);
	$("#sdate_date > option[value='"+start_date+"']").attr('selected',true);
	$("#edate_year > option[value='"+end_year+"']").attr('selected',true);
	$("#edate_month > option[value='"+end_month+"']").attr('selected',true);
	$("#edate_date > option[value='"+end_date+"']").attr('selected',true);

	$('.sel_date').removeClass('text_red');
	$('#sel_'+dates).addClass('text_red');
	$('#sel_date').val(dates);
}

var serviceListFrmSubmit = function(){
	$('#smsListFrm').submit();
}

var sms_send = function( no, rphone, wr_person, wr_receive ){	// ���� ���� ������

	$('#rphone').val(rphone);
	$('#wr_person').val(wr_person);
	$('#wr_receive').val(wr_receive);

	$('#mobileWrap').show();
	$('#send_msg').focus();
}
var smsSendFrmSubmit = function(){	// ���� �� ����
	var sms_options = { target : '', beforeSubmit : smsRequest, success : smsResponse }
	$('#smsSendFrm').ajaxSubmit(sms_options);

}
var smsSendFrmClose = function(){	// ���� �� �ݱ�
	$('#smsSendFrm').resetForm();
	$('#mobileWrap').hide();
}
var smsRequest = function(formData, jqForm, sms_options){	 // ���� ���� ��
	var smsSendFrm = document.getElementById('smsSendFrm');
	var queryString = $.param(formData);
	return validate(smsSendFrm);
}
var smsResponse = function(responseText, statusText, xhr, $form){	// ���� ���� ��
	var results = responseText.split('/');
	var result = results[0], msg = results[1];
	if(result=='success'){
		alert(msg);
		smsSendFrmClose();
	} else {
		//alert("SMS �߼��� ������ �߻��Ͽ����ϴ�.\n\n����Ʈ ��ڿ� �����ϼ���.");
		alert(msg);
	}

}

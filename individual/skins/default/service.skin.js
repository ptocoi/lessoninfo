$(function(){

});

var page_rows = function( vals ){	// 출력수 조절
	var sel = vals.value;
	//$('#page_rows').val(sel);
	serviceListFrmSubmit();
}

var sel_date = function( dates ){

	var todate = new Date();

	switch(dates){

		// 최근 1주일
		case '7day':
			startDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() );
			endDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() + 6);
			var start_year = startDate.getFullYear(), start_month = leadingZeros(startDate.getMonth()+1,2), start_date = startDate.getDate() - startDate.getDay();
			var end_year = endDate.getFullYear(), end_month = leadingZeros(endDate.getMonth()+1,2), end_date = leadingZeros(endDate.getDate(),2);
		break

		// 최근 1개월
		case '30day':	
			startDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() - 30 );
			endDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() + 1 );
			var start_year = startDate.getFullYear(), start_month = leadingZeros(startDate.getMonth()+1,2), start_date = startDate.getDate() - startDate.getDay();
			var end_year = endDate.getFullYear(), end_month = leadingZeros(endDate.getMonth()+1,2), end_date = endDate.getDate();
		break

		// 최근 3개월
		case '90day':	
			startDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() - 90 );
			endDate = new Date(todate.getFullYear(), todate.getMonth(), todate.getDate() - todate.getDay() + 1 );
			var start_year = startDate.getFullYear(), start_month = leadingZeros(startDate.getMonth()+1,2), start_date = startDate.getDate() - startDate.getDay();
			var end_year = endDate.getFullYear(), end_month = leadingZeros(endDate.getMonth()+1,2), end_date = endDate.getDate();
		break
	}

	$("#pay_sdate_year > option[value='"+start_year+"']").attr('selected',true);
	$("#pay_sdate_month > option[value='"+start_month+"']").attr('selected',true);
	$("#pay_sdate_date > option[value='"+start_date+"']").attr('selected',true);
	$("#pay_edate_year > option[value='"+end_year+"']").attr('selected',true);
	$("#pay_edate_month > option[value='"+end_month+"']").attr('selected',true);
	$("#pay_edate_date > option[value='"+end_date+"']").attr('selected',true);

	$('.sel_date').removeClass('text_red');
	$('#sel_'+dates).addClass('text_red');
	$('#sel_date').val(dates);

}

var serviceListFrmSubmit = function(){
	$('#serviceListFrm').submit();
}
var service_extend = function(){	 // 서비스 연장

}
$(function(){
	if(is_demo){
		$("input[name='mb_type']").click(function(){
			var sel = $(this).val();
			if(sel=='individual'){
				$('#login_id, #login_passwd').val('test_individual');
			} else if(sel=='company'){
				$('#login_id, #login_passwd').val('test_company');
			}
		});
	}
});
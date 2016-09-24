<?php
	$alice_path = "../../../";

	$cat_path = "../../../";

	include_once $alice_path . "_core.php";

	if($_SESSION[$user_control->sess_user_val]){

		$result = $user_control->user_logout($_SESSION[$user_control->sess_user_val]);

	} else {

		$result = "0015";

	}

	$utility->location_href("../../main/");

?>
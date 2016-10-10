<?php
function statusOfDeliveryForDriver($deliveryDate,$status){
    $now = new DateTime('now');
    $interval = date_diff($now, $deliveryDate);
    if ($interval->days < 2 && $status != "Complete"){
        return "danger";
    }else if($interval->days < 4 && $status != "Complete"){
        return "warning";
    }else {
        return "success";
    }
}
function changeHomePageAccordingUserStatus($loggedIn){
    if($loggedIn){
        echo '<p>To On The Spot delivery service. Click the button below to begin your order</p>'
        . '<p><a class="btn btn-primary btn-lg" href="order.php" role="button">Start Order &raquo;</a></p>';
    }
    else{
        echo '<p>To On The Spot delivery service. Login to make an order</p>'
        . '<p><a class="btn btn-primary btn-lg" href="signin.php" role="button">Login &raquo;</a></p>'
        . '<p>Or </p>'
        . '<p><a class="btn btn-primary btn-lg" href="register.php" role="button">Register &raquo;</a></p>';
    }
}
function alertUser($variable,$stringToDisplay){
    if($variable){
        echo '<label style="color:red;">'.$stringToDisplay.'</label>';
        return true;
    }   
}

function updateNav($items) {
	$active = "class=\"active\"";
	foreach($items as $item) {
		$html .= "<li " . ($_SERVER['PHP_SELF']==$item['url'] ? $active : ''). "><a href='{$item['url']}'>{$item['text']}</a></li>\n";
	}
	return $html;
}

function packageCost($priority, $size, $weight) {
	$cost = 0;
	switch ($priority) {
		case 1:
			$cost += 10;
			break;
		case 2:
			$cost += 5;
			break;
		case 3:
			$cost += 0;
			break;
	}
	switch ($size) {
		case "small":
			$cost += 10;
			break;
		case "medium":
			$cost += 15;
			break;
		case "large":
			$cost += 20;
			break;
		case "x-large":
			$cost += 30;
			break;
	}
	if ($weight < 1) {
		$cost += 5;
	} else if ($weight < 5) {
		$cost += 10;
	} else if ($weight < 10) {
		$cost += 15;
	} else {
		$cost += 20;
	}
	return $cost;
}
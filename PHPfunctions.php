<?php
function statusOfDeliveryForDriver($orderDate,$status){
    $now = new DateTime('now');
    date_add($orderDate, date_interval_create_from_date_string('5 weekdays'));		
    $interval = $now->diff($orderDate);
    if ($interval->days < 2 && $status != "Complete"){
        return "danger";
    }else if($interval->days < 4 && $status != "Complete"){
        return "warning";
    }else{
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

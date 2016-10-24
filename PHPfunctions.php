<?php

$guest = array(
  'home'  => array('text'=>'Home',  'url'=>'/index.php'),
  'about' => array('text'=>'About', 'url'=>'/about.php'),
  'calculator' => array('text'=>'Calculator', 'url'=>'/calculator.php'),
);

$customer = array(
  'home'  => array('text'=>'Home',  'url'=>'/index.php'),
  'order'  => array('text'=>'Order',  'url'=>'/order.php'),
  'history' => array('text'=>'History', 'url'=>'/history.php'),
  'about' => array('text'=>'About', 'url'=>'/about.php'),
  'calculator' => array('text'=>'Calculator', 'url'=>'/calculator.php'),
);

$driver = array(
  'assigned'  => array('text'=>'Assigned',  'url'=>'/assigned.php'),
  'deliveries'  => array('text'=>'Deliveries',  'url'=>'/delivery.php'),
  'pickups'  => array('text'=>'Pick-Ups',  'url'=>'/pickups.php'),
);

$owner = array(
  'unassigned'  => array('text'=>'Unassigned',  'url'=>'/unassigned.php'),
  'deliveries'  => array('text'=>'Deliveries',  'url'=>'/delivery.php'),
  'pickups'  => array('text'=>'Pick-Ups',  'url'=>'/pickups.php'),
  'records'  => array('text'=>'Records',  'url'=>'/records.php'),
  'drivers'  => array('text'=>'Drivers',  'url'=>'/drivers.php'),
);

function statusOfDeliveryForDriver($deliveryDate){
    $now = date_create();
    $interval = date_diff($now, $deliveryDate);
	if ($now < $deliveryDate) {
		if ($interval->days < 2 && $status != "Complete"){
			return "danger";
		}else if($interval->days < 4 && $status != "Complete"){
			return "warning";
		}else {
			return "success";
		}
	} else {
		return "danger";
	}
}
function changeHomePageAccordingUserStatus($loggedIn){
    if($loggedIn){
        echo '<center> <p>Click the button below to begin your order</p>'
        . '<p><a class="btn btn-primary btn-lg1" href="order.php" role="button">Start Order </a></p></center>';
    }
    else{
        echo '<center><p>Welcome To On The Spot Delivery, please login to make an order</p>'
        . '<p><a class="btn btn-primary btn-lg1" href="signin.php" role="button">Login</a></p>'
        . '<p>Or create an account </p>'
        . '<p><a class="btn btn-primary btn-lg1" href="register.php" role="button">Register </a></p></center>';
    }
}
function alertUser($variable,$stringToDisplay){
    if($variable){
        echo '<label style="color:red;">'.$stringToDisplay.'</label>';
        return true;
    }   
}

function updateNav($account) {
	global $customer, $driver, $owner, $guest;
	switch ($account) {
		case "Customer":
			$items = $customer;
			break;
		case "Driver":
			$items = $driver;
			break;
		case "Owner":
			$items = $owner;
			break;
		case NULL:
			$items = $guest;
			break;
	}
	$active = "class=\"active\"";
	foreach($items as $item) {
		$html .= "<li " . ($_SERVER['PHP_SELF']==$item['url'] ? $active : ''). "><a href='{$item['url']}'>{$item['text']}</a></li>\n";
	}
	return $html;
}

function priority($priority) {
	switch ($priority) {
		case 1:
			$string = "Overnight";
			break;
		case 2:
			$string =  "Express";
			break;
		case 3:
			$string =  "Standard";
			break;
	}
	return $string;
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
	if ($size == "x-large" || $weight >= 10) {
		$cost += 25.6;
	} else if ($size == "large" || weight >= 5) {
		$cost += 20.05;
	} else if ($size == "medium" || weight >= 3) {
		$cost += 17.6;
	} else if ($size == "small" || weight >= 0.5) {
		$cost += 13.8;
	} else if ($size == "envelope") {
		$cost += 7.6;
	}
	return $cost;
}

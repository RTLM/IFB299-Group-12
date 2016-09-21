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

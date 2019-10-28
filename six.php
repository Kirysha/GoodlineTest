<?php
function masDay ($year, $month) {
    $dt = new DateTime();
    $day = 0;
    $mDay = [];
    if ($year<1) {
        echo "Плохой год";
        return null;
    }
    while ($day < cal_days_in_month(CAL_GREGORIAN,$month,$year)){
        $day++;
        $dt ->setDate($year,$month,$day);
        $numDay = date('N', $dt->getTimestamp());
        ($numDay == 2) ? array_push($mDay, $day):"";
    }
return $mDay;
}
print_r(masDay(0000,12));
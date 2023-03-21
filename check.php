<?php

require('NationalHolidays.php');
header('Content-Type: application/json');

$holidays = NationalHolidays::generate(date('Y', strtotime($_GET['date'])));
$date = DateTime::createFromFormat('Y-m-d', $_GET['date'])->format(NationalHolidays::PRETTY_FORMAT);

//$found = false;
//foreach ($holidays as $holiday) {
//
//    if ($date === $holiday['date']) {
//        $found = true;
//        break;
//    }
//}
//
//if ($found) {
//    echo json_encode('A public holiday!');
//} else {
//    echo json_encode('Not a public holiday!');
//}

echo json_encode([
    'status' => in_array($date, array_column($holidays, 'date'))

]);

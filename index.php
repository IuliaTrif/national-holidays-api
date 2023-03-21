<?php

require ('NationalHolidays.php');

header('Content-Type: application/json');

echo json_encode(NationalHolidays::generate((int) $_GET['year']));

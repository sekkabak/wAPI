<?php

/**
 * Created by: Cezary Bąk
 */

require_once __DIR__ . '/Core.php';

$api = new Core();

// single
//$result = $api->decodeOneCode('28-200', '41-203', '30-001', '71-001');

// array
$result = $api->decodeArrayOfCodes(['28-200', '41-203', '30-001', '71-001']);

// json
// WIP

var_dump($result);
echo '<br>';

// czas wykonania
echo $api->getExecTime();
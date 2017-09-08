<?php

/**
 * Created by: Cezary Bąk
 * License: OEM
 */

require_once __DIR__ . '/Core.php';

$api = new Core();
$result = $api->decodeArrayOfCodes(['28-200', '41-203', '30-001', '71-001']);
var_dump($result);
echo '<br>';
echo $api->getExecTime();
<?php

/**
 * Created by: Cezary Bąk
 * License: OEM
 */

require_once __DIR__ . '/Core.php';

require_once __DIR__. '/a.php';
$api = new Core();
$result = $api->decodeArrayOfCodes('28-200');
echo $result;
echo '<br>';
echo $api->getExecTime();
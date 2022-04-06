<?php

$array = [7, 346, 672, 46322435, 65765312, 546475457, 345345, 72, 2, 0];
$a = 'Hello';
$count = count($array);

for ($i = 0; $i < $count; $i++) {
    $array[] = array_shift($array);
    if (!empty(strstr($array[count($array) - 1], 2))) {
        $array[] = $a;
    }
}

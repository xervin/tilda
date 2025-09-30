<?php

/**
 * @throws Exception
 */
function ladder(int $steps): void
{
    if ($steps < 1) {
        throw new Exception("Нам не нужны лестницы с количеством ступеней меньше $steps");
    }
    $num = 1;
    $row = 1;
    while ($num <= $steps) {
        for ($col = 1; $col <= $row; $col++) {
            echo ($num <= $steps ? $num : '[]') . " ";
            $num++;
        }
        echo PHP_EOL;
        $row++;
    }
}

ob_start();
try {
    ladder(100);
} catch (Exception $e) {
    echo $e->getMessage();
}
$stream = ob_get_clean();

if (PHP_SAPI === 'cli') {
    echo $stream;
} else {
    echo "<pre>$stream</pre>";
}
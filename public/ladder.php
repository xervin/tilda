<?php

/**
 * @throws Exception
 */
function ladder(int $steps)
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

ladder(100);
<?php

class TArray
{
    private array $array = [];

    private array $colSum = [];
    private array $rowSum = [];
    public function __construct(
        readonly private int $rows,
        readonly private int  $cols,
        readonly private string $countUniqValues,
    )
    {
        if ($this->rows < 1) {
            throw new Exception("Количество строк не может быть меньше 1\n");
        }
        if ($this->cols < 1) {
            throw new Exception("Количество строк не может быть меньше 1\n");
        }
        if ($this->countUniqValues < $this->rows * $this->cols) {
            throw new Exception("Количество уникальных значений не может быть меньше произведения матрицы `{$this->cols} x {$this->rows}`\n");
        }

        $numbers = range(1, $this->countUniqValues);
        shuffle($numbers);

        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                $el = array_pop($numbers);
                $this->array[$i][$j] = $el;

                if (isset($this->rowSum[$i])) {
                    $this->rowSum[$i] += $el;
                } else {
                    $this->rowSum[$i] = $el;
                }

                if (isset($this->colSum[$j])) {
                    $this->colSum[$j] += $el;
                } else {
                    $this->colSum[$j] = $el;
                }
            }
        }
    }

    public function print(): void
    {
        for ($i = 0; $i < $this->rows; $i++) {
            for ($j = 0; $j < $this->cols; $j++) {
                echo str_pad($this->array[$i][$j], 5, " ", STR_PAD_LEFT);
            }
            echo " | {$this->rowSum[$i]}\n";
        }

        echo str_repeat("-", $this->cols * 6) . "\n";

        for ($j = 0; $j < $this->cols; $j++) {
            echo str_pad($this->colSum[$j], 5, " ", STR_PAD_LEFT);
        }
        echo "\n";
    }
}


try {
    $tArray = new TArray(5, 7, 100);
    $tArray->print();
} catch (Exception $e) {
    echo $e->getMessage();
}


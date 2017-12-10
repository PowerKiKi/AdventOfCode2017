<?php

declare(strict_types=1);

require 'aoc.php';

function solve1(int $l, array $input): int
{
    $current = 0;
    $skip = 0;

    $list = range(0, $l);
    oneRound($input, $list, $current, $skip);

    return $list[0] * $list[1];
}

function solve2(string $input): string
{
    $letters = preg_split('/(.)/', $input, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    $bytes = [];
    foreach ($letters as $c) {
        $bytes[] = ord($c);
    }
    $bytes = array_merge($bytes, [17, 31, 73, 47, 23]);

    $current = 0;
    $skip = 0;
    $sparse = range(0, 255);
    for ($i = 0; $i < 64; $i++) {
        oneRound($bytes, $sparse, $current, $skip);
    }

    $dense = [];
    foreach (range(0, 15) as $q) {
        $res = null;
        foreach (range($q * 16, ($q + 1) * 16 - 1) as $i) {
            if ($res === null) {
                $res = $sparse[$i];
            } else {
                $res = $res ^ $sparse[$i];
            }
        }

        $dense[] = $res;
    }

    $hex = '';
    foreach ($dense as $d) {
        $hex .= str_pad(dechex($d), 2, '0', STR_PAD_LEFT);
    }

    return $hex;
}

function oneRound(array $lengths, array &$list, int &$current = 0, int &$skip = 0): void
{
    foreach ($lengths as $length) {
        $original = $list;
        for ($i = 0; $i < $length; $i++) {
            $a = ($current + $i) % count($list);
            $b = ($current + $length - $i - 1) % count($list);
            $list[$a] = $original[$b];
        }

        $current = ($current + $length + $skip) % count($list);
        ++$skip;
    }
}

$input = [94, 84, 0, 79, 2, 27, 81, 1, 123, 93, 218, 23, 103, 255, 254, 243];

assertSame(12, solve1(4, [3, 4, 1, 5]));
var_dump(solve1(255, $input));

$input = '94,84,0,79,2,27,81,1,123,93,218,23,103,255,254,243';
assertSame('a2582a3a0e66e6e86e3812dcb672a272', solve2(''));
assertSame('33efeb34ea91902bb2f59c9920caa6cd', solve2('AoC 2017'));
assertSame('3efbe78a8d82f29979031a4aa0b16a9d', solve2('1,2,3'));
assertSame('63960835bcdc130f0b66d7ff4f6a5a8e', solve2('1,2,4'));
var_dump(solve2($input));


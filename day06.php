<?php

declare(strict_types=1);

require 'aoc.php';

function solve1(array $input): int
{
    $seen = [];
    $config = implode('', $input);

    while (!in_array($config, $seen, true)) {
        $seen[] = $config;
        $max = max($input);
        $i = array_search($max, $input);
        $input[$i] = 0;

        while ($max) {
            ++$i;
            if ($i >= count($input)) {
                $i = 0;
            }

            $input[$i]++;
            --$max;
        }

        $config = implode('', $input);
    }

    return count($seen);
}

function solve2(array $input): int
{

    $seen = [];
    $config = implode('', $input);

    while (!array_key_exists($config, $seen)) {
        $seen[$config] = count($seen);
        $max = max($input);
        $i = array_search($max, $input);
        $input[$i] = 0;

        while ($max) {
            ++$i;
            if ($i >= count($input)) {
                $i = 0;
            }

            $input[$i]++;
            --$max;
        }

        $config = implode('', $input);
    }

    return count($seen) - $seen[$config];
}

$input = [11, 11, 13, 7, 0, 15, 5, 5, 4, 4, 1, 1, 7, 1, 15, 11];

$sample1 = [0, 2, 7, 0];

assertSame(5, solve1($sample1));
var_dump(solve1($input));

assertSame(4, solve2($sample1));
var_dump(solve2($input));

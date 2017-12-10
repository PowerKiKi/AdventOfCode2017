<?php

declare(strict_types=1);

require 'aoc.php';

function solve1(int $input): int
{
    $minX = 0;
    $maxX = 0;
    $minY = 0;
    $maxY = 0;
    $x = 0;
    $y = 0;
    $direction = 'r';

    --$input;
    while ($input) {
        switch ($direction) {
            case 'r':
                ++$x;
                break;
            case 'u':
                ++$y;
                break;
            case 'l':
                --$x;
                break;
            case 'd':
                --$y;
                break;
            default:
                throw new Exception();
        }

        if ($x > $maxX) {
            $direction = 'u';
        } elseif ($y > $maxY) {
            $direction = 'l';
        } elseif ($x < $minX) {
            $direction = 'd';
        } elseif ($y < $minY) {
            $direction = 'r';
        }

        $minX = min($x, $minX);
        $maxX = max($x, $maxX);
        $minY = min($y, $minY);
        $maxY = max($y, $maxY);

        --$input;
    }

    return abs($x) + abs($y);
}

function solve2(int $input): int
{
    $storage = [
        0 => [
            0 => 1,
        ],
    ];
    $minX = 0;
    $maxX = 0;
    $minY = 0;
    $maxY = 0;
    $x = 0;
    $y = 0;
    $direction = 'r';

    --$input;
    while ($input) {
        switch ($direction) {
            case 'r':
                ++$x;
                break;
            case 'u':
                ++$y;
                break;
            case 'l':
                --$x;
                break;
            case 'd':
                --$y;
                break;
            default:
                throw new Exception();
        }

        if ($x > $maxX) {
            $direction = 'u';
        } elseif ($y > $maxY) {
            $direction = 'l';
        } elseif ($x < $minX) {
            $direction = 'd';
        } elseif ($y < $minY) {
            $direction = 'r';
        }

        $minX = min($x, $minX);
        $maxX = max($x, $maxX);
        $minY = min($y, $minY);
        $maxY = max($y, $maxY);

        $value = 0;
        $value += $storage[$x + 1][$y] ?? 0;
        $value += $storage[$x + 1][$y + 1] ?? 0;
        $value += $storage[$x][$y + 1] ?? 0;
        $value += $storage[$x - 1][$y + 1] ?? 0;
        $value += $storage[$x - 1][$y] ?? 0;
        $value += $storage[$x - 1][$y - 1] ?? 0;
        $value += $storage[$x][$y - 1] ?? 0;
        $value += $storage[$x + 1][$y - 1] ?? 0;

        $storage[$x][$y] = $value;

        --$input;
    }

    return $storage[$x][$y];
}

$input = 347991;

assertSame(0, solve1(1));
assertSame(3, solve1(12));
assertSame(2, solve1(23));
assertSame(31, solve1(1024));
var_dump(solve1($input));

assertSame(1, solve2(1));
assertSame(1, solve2(2));
assertSame(2, solve2(3));
assertSame(4, solve2(4));
assertSame(5, solve2(5));

$square = 0;
$res = 0;
while ($res < $input) {
    $res = solve2(++$square);
}
var_dump($res);

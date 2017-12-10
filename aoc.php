<?php

declare(strict_types=1);

function assertSame($expected, $actual): void
{
    if ($expected !== $actual) {
        throw new Exception("Actual value `$actual` is not identical to expected `$expected`");
    }
}

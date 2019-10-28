<?php

declare(strict_types=1);

namespace Korbeil\Uuid;

use FFI\CData;

final class UuidStruct
{
    const UUID_SEPARATORS = [4, 2, 2, 2, 6];

    private array $value = [];

    public function __construct(CData $ouput)
    {
        foreach ($ouput as $item) {
            $this->value[] = $item;
        }
    }

    public function __toString(): string
    {
        $incr = 0;
        $output = '';
        $iterator = new \ArrayIterator(self::UUID_SEPARATORS);

        foreach ($this->value as $item) {
            $output .= dechex($item);

            ++$incr;
            if ($incr === $iterator->current()) {
                $incr = 0;
                $iterator->next();

                if ($iterator->valid()) {
                    $output .= '-';
                }
            }
        }

        return $output;
    }
}

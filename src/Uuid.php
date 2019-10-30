<?php

declare(strict_types=1);

namespace Korbeil\Uuid;

use FFI;
use FFI\CData;

final class Uuid
{
    const UUID_SEPARATORS = [4, 2, 2, 2, 6];

    private CData $value;
    private ?string $cached = null;

    /** @var \KorbeilUuidPhp $ffi */
    public static function createFromString(string $uuid, FFI $ffi): self
    {
        $matches = [];
        preg_match_all('/([0-9a-z]){2}/', $uuid, $matches);

        $value = $ffi->new('uuid_t');
        foreach ($matches[0] as $k => $item) {
            $value[$k] = hexdec($item);
        }

        return new self($value, $uuid);
    }

    public function __construct(CData $value, string $cached = null)
    {
        $this->value = $value;
        $this->cached = $cached;
    }

    public function toString(): string
    {
        if (null === $this->cached) {
            $this->cachedString();
        }

        return $this->cached;
    }

    private function cachedString(): void
    {
        $incr = 0;
        $output = '';
        $iterator = new \ArrayIterator(self::UUID_SEPARATORS);

        foreach ($this->value as $item) {
            $current = dechex($item);
            if (1 === \strlen($current)) {
                $current = '0'.$current;
            }

            $output .= $current;

            ++$incr;
            if ($incr === $iterator->current()) {
                $incr = 0;
                $iterator->next();

                if ($iterator->valid()) {
                    $output .= '-';
                }
            }
        }

        $this->cached = $output;
    }

    public function toCData(): CData
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

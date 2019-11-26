<?php

declare(strict_types=1);

namespace JoliCode\Uuid;

use FFI;
use FFI\CData;
use JoliCodeUuidPhp;

final class UuidGenerator
{
    /**
     * When this namespace is specified, the name string is a fully-qualified domain name.
     * @link http://tools.ietf.org/html/rfc4122#appendix-C
     */
    const NAMESPACE_DNS = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    /**
     * When this namespace is specified, the name string is a URL.
     * @link http://tools.ietf.org/html/rfc4122#appendix-C
     */
    const NAMESPACE_URL = '6ba7b811-9dad-11d1-80b4-00c04fd430c8';

    /**
     * When this namespace is specified, the name string is an ISO OID.
     * @link http://tools.ietf.org/html/rfc4122#appendix-C
     */
    const NAMESPACE_OID = '6ba7b812-9dad-11d1-80b4-00c04fd430c8';

    /**
     * When this namespace is specified, the name string is an X.500 DN in DER or a text output format.
     * @link http://tools.ietf.org/html/rfc4122#appendix-C
     */
    const NAMESPACE_X500 = '6ba7b814-9dad-11d1-80b4-00c04fd430c8';

    private JoliCodeUuidPhp $ffi;

    public function __construct()
    {
        $this->ffi = JoliCodeUuidPhp::load(__DIR__ . '/../include/uuid-php.h');
    }

    public function v1(): string
    {
        $output = $this->ffi->new('uuid_t');

        $this->ffi->uuid_generate_time($output);

        return $this->decode($output);
    }

    public function v3(string $name, string $namespace = self::NAMESPACE_X500): string
    {
        $output = $this->ffi->new('uuid_t');

        $this->ffi->uuid_generate_md5($output, $this->encode($namespace), $name, \mb_strlen($name));

        return $this->decode($output);
    }

    public function v4(): string
    {
        $output = $this->ffi->new('uuid_t');

        $this->ffi->uuid_generate_random($output);

        return $this->decode($output);
    }

    public function v5(string $name, string $namespace = self::NAMESPACE_X500): string
    {
        $output = $this->ffi->new('uuid_t');

        $this->ffi->uuid_generate_sha1($output, $this->encode($namespace), $name, \mb_strlen($name));

        return $this->decode($output);
    }

    private function decode(CData $value): string
    {
        return sprintf('%02x%02x%02x%02x-%02x%02x-%02x%02x-%02x%02x-%02x%02x%02x%02x%02x%02x',
            $value[0],
            $value[1],
            $value[2],
            $value[3],
            $value[4],
            $value[5],
            $value[6],
            $value[7],
            $value[8],
            $value[9],
            $value[10],
            $value[11],
            $value[12],
            $value[13],
            $value[14],
            $value[15],
        );
    }

    private function encode(string $uuid): CData
    {
        preg_match_all('/([0-9a-z]){2}/', $uuid, $matches);

        $cdata = $this->ffi->new('uuid_t');
        foreach ($matches[0] as $k => $item) {
            $cdata[$k] = hexdec($item);
        }

        return $cdata;
    }
}

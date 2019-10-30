<?php

declare(strict_types=1);

namespace Korbeil\Uuid;

use FFI;
use FFI\CData;
use KorbeilUuidPhp;

final class UuidFactory
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

    /** @var KorbeilUuidPhp */
    private FFI $ffi;
    private ?CData $emptyOutput = null;

    public function __construct()
    {
        $this->ffi = FFI::load(__DIR__ . '/../include/uuid-php.h');
    }

    private function prepareOutput(): CData
    {
        if (null === $this->emptyOutput) {
            $this->emptyOutput = $this->ffi->new('uuid_t');
        }

        return clone $this->emptyOutput;
    }

    public function v1(): Uuid
    {
        $this->ffi->uuid_generate_time($output = $this->prepareOutput());

        return new Uuid($output);
    }

    public function v4(): Uuid
    {
        $this->ffi->uuid_generate_random($output = $this->prepareOutput());

        return new Uuid($output);
    }

    public function v3(string $name, string $namespace = self::NAMESPACE_X500): Uuid
    {
        $namespaceUuid = Uuid::createFromString($namespace, $this->ffi);

        $this->ffi->uuid_generate_md5($output = $this->prepareOutput(), $namespaceUuid->toCData(), $name, \mb_strlen($name));

        return new Uuid($output);
    }

    public function v5(string $name, string $namespace = self::NAMESPACE_X500): Uuid
    {
        $namespaceUuid = Uuid::createFromString($namespace, $this->ffi);

        $this->ffi->uuid_generate_sha1($output = $this->prepareOutput(), $namespaceUuid->toCData(), $name, \mb_strlen($name));

        return new Uuid($output);
    }
}

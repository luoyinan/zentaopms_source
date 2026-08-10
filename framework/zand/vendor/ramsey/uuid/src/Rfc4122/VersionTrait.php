<?php

namespace Ramsey\Uuid\Rfc4122;

use Ramsey\Uuid\Uuid;

/**
 * Provides common functionality for handling the version, as defined by RFC 4122
 *
 * @psalm-immutable
 */
trait VersionTrait
{
    /**
     * Returns the version
     */
    abstract public function getVersion();

    /**
     * Returns true if these fields represent a max UUID
     */
    abstract public function isMax();

    /**
     * Returns true if these fields represent a nil UUID
     */
    abstract public function isNil();

    /**
     * Returns true if the version matches one of those defined by RFC 4122
     *
     * @return bool True if the UUID version is valid, false otherwise
     */
    private function isCorrectVersion()
    {
        if ($this->isNil() || $this->isMax()) {
            return true;
        }

        return match ($this->getVersion()) {
            Uuid::UUID_TYPE_TIME, Uuid::UUID_TYPE_DCE_SECURITY,
            Uuid::UUID_TYPE_HASH_MD5, Uuid::UUID_TYPE_RANDOM,
            Uuid::UUID_TYPE_HASH_SHA1, Uuid::UUID_TYPE_REORDERED_TIME,
            Uuid::UUID_TYPE_UNIX_TIME, Uuid::UUID_TYPE_CUSTOM => true,
            default => false,
        };
    }
}

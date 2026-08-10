<?php

namespace Spiral\RoadRunner\Console\Repository;

/**
 * @template-extends Collection<AssetInterface>
 */
final class AssetsCollection extends Collection
{
    /**
     * @return $this
     */
    public function onlyRoadrunner()
    {
        return $this->filter(static fn (AssetInterface $asset): bool =>
            \str_starts_with($asset->getName(), 'roadrunner')
        );
    }

    /**
     * @return $this
     */
    public function exceptDebPackages()
    {
        return $this->except(static fn (AssetInterface $asset): bool =>
            \str_ends_with(\strtolower($asset->getName()), '.deb')
        );
    }

    /**
     * @param string $arch
     * @return $this
     */
    public function whereArchitecture($arch)
    {
        return $this->filter(static fn (AssetInterface $asset): bool =>
            \str_contains($asset->getName(), '-' . \strtolower($arch) . '.')
        );
    }

    /**
     * @param string $os
     * @return $this
     */
    public function whereOperatingSystem($os)
    {
        return $this->filter(static fn (AssetInterface $asset): bool =>
            \str_contains($asset->getName(), '-' . \strtolower($os) . '-')
        );
    }
}

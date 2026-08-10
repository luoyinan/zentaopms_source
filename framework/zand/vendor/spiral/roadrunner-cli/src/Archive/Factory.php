<?php

namespace Spiral\RoadRunner\Console\Archive;

use Spiral\RoadRunner\Console\Repository\AssetInterface;

/**
 * @psalm-import-type ArchiveMatcher from FactoryInterface
 */
class Factory implements FactoryInterface
{
    /**
     * @var array<ArchiveMatcher>
     */
    private array $matchers = [];

    /**
     * FactoryTrait constructor.
     */
    public function __construct()
    {
        $this->bootDefaultMatchers();
    }

    /**
     * @return void
     */
    private function bootDefaultMatchers()
    {
        $this->extend($this->matcher('zip',
            static fn (\SplFileInfo $info): ArchiveInterface => new ZipPharArchive($info)
        ));

        $this->extend($this->matcher('tar.gz',
            static fn (\SplFileInfo $info): ArchiveInterface => new TarPharArchive($info)
        ));

        $this->extend($this->matcher('phar',
            static fn (\SplFileInfo $info): ArchiveInterface => new PharArchive($info)
        ));
    }

    /**
     * @param string $extension
     * @param ArchiveMatcher $then
     * @return ArchiveMatcher
     */
    private function matcher($extension, $then)
    {
        return static fn (\SplFileInfo $info): ?ArchiveInterface =>
            \str_ends_with(\strtolower($info->getFilename()), '.' . $extension) ? $then($info) : null
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function extend($matcher)
    {
        \array_unshift($this->matchers, $matcher);

        return $this;
    }

    /**
     * @param \SplFileInfo $file
     * @return ArchiveInterface
     */
    public function create($file)
    {
        $errors = [];

        foreach ($this->matchers as $matcher) {
            try {
                if ($archive = $matcher($file)) {
                    return $archive;
                }
            } catch (\Throwable $e) {
                $errors[] = '  - ' . $e->getMessage();
                continue;
            }
        }

        $error = \sprintf('Can not open the archive "%s":%s', $file->getFilename(), \PHP_EOL) .
            \implode(\PHP_EOL, $errors)
        ;

        throw new \InvalidArgumentException($error);
    }

    /**
     * {@inheritDoc}
     */
    public function fromAsset($asset, $progress = null, $temp = null)
    {
        $temp = $this->getTempDirectory($temp) . '/' . $asset->getName();

        $file = new \SplFileObject($temp, 'wb+');

        try {
            foreach ($asset->download($progress) as $chunk) {
                $file->fwrite($chunk);
            }
        } catch (\Throwable $e) {
            @\unlink($temp);

            throw $e;
        }

        return $this->create($file);
    }

    /**
     * @param string|null $temp
     * @return string
     */
    private function getTempDirectory($temp)
    {
        if ($temp) {
            if (! \is_dir($temp) || ! \is_writable($temp)) {
                throw new \LogicException(\sprintf('Directory "%s" is not writeable', $temp));
            }

            return $temp;
        }

        return \sys_get_temp_dir();
    }
}

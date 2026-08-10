<?php

namespace Spiral\RoadRunner\Console\Repository;

class RepositoriesCollection implements RepositoryInterface
{
    /**
     * @var array<RepositoryInterface>
     */
    private array $repositories;

    /**
     * @param array<RepositoryInterface> $repositories
     */
    public function __construct($repositories)
    {
        $this->repositories = $repositories;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'unknown/unknown';
    }

    /**
     * @return ReleasesCollection
     */
    public function getReleases()
    {
        return ReleasesCollection::from(function () {
            foreach ($this->repositories as $repository) {
                yield from $repository->getReleases();
            }
        });
    }
}

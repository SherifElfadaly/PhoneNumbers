<?php

namespace App\Services;

use App\Contracts\PhoneNumberRepositoryInterface;
use App\Contracts\PhoneNumberServiceInterface;

class PhoneNumberService implements PhoneNumberServiceInterface
{
    /**
     * @var PhoneNumberRepositoryInterface
     */
    protected $repo;
    
    /**
     * Init new object.
     *
     * @param  PhoneNumberRepositoryInterface $repo
     * @return void
     */
    public function __construct(PhoneNumberRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Fetch all records with relations based on
     * the given condition from storage in pages.
     *
     * @param  array   $conditions array of conditions
     * @param  integer $perPage
     * @param  array   $relations
     * @param  string  $sortBy
     * @param  boolean $desc
     * @param  array   $columns
     * @return collection
     */
    public function paginateBy($conditions, $perPage = 15, $relations = [], $sortBy = 'created_at', $desc = 1, $columns = ['*'])
    {
        unset($conditions['perPage']);
        return $this->repo->paginateBy($conditions, $perPage, $relations, $sortBy, $desc, $columns);
    }
}

<?php

namespace App\Contracts;

interface PhoneNumberRepositoryInterface
{   
    /**
     * Fetch all records with relations based on
     * the given condition from storage in pages.
     *
     * @param  array   $conditions array of conditions
     * @param  integer $perPage
     * @param  array   $relations
     * @param  array   $sortBy
     * @param  array   $desc
     * @param  array   $columns
     * @return collection
     */
    public function paginateBy($conditions, $perPage = 15, $relations = [], $sortBy = 'created_at', $desc = 0, $columns = ['*']);

    /**
     * Apply the given conditions to the given query.
     *
     * @param  array  $conditions array of conditions
     * @param  object $query
     * @return object
     */
    public function constructFilters($conditions, $query);
}

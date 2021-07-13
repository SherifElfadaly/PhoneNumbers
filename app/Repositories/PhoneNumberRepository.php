<?php

namespace App\Repositories;

use App\Contracts\PhoneNumberRepositoryInterface;
use App\Contracts\PhoneNumberUtlInterface;
use App\Enums\PhoneNumberRegex;
use App\Models\PhoneNumber;
use Illuminate\Support\Arr;

class PhoneNumberRepository implements PhoneNumberRepositoryInterface
{
    /**
     * @var PhoneNumber
     */
    protected $model;

    /**
     * @var PhoneNumberUtlInterface
     */
    protected $phoneNumberUtl;

    /**
     * Init new object.
     *
     * @param  PhoneNumber $model
     * @param  PhoneNumberUtl  $phoneNumberUtl
     * @return  void
     */
    public function __construct(PhoneNumber $model, PhoneNumberUtlInterface $phoneNumberUtl)
    {
        $this->model = $model;
        $this->phoneNumberUtl = $phoneNumberUtl;
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
        $sort = $desc ? 'desc' : 'asc';
        $query = $this->model->with($relations);
        $query = $this->constructFilters($conditions, $query);

        return $query->orderBy($sortBy, $sort)->paginate($perPage, $columns);
    }

    /**
     * Apply the given conditions to the given query.
     *
     * @param  array  $conditions array of conditions
     * @param  object $query
     * @return object
     */
    public function constructFilters($conditions, $query)
    {
        if ($countryCondition = Arr::get($conditions, 'country')) {
            $countryCode = $this->phoneNumberUtl->getCodeByCountry($countryCondition);
            $query->where([['phone', 'like', $countryCode . '%']]);
        }

        if ($validCondition = Arr::get($conditions, 'valid')) {
            $notFlag = filter_var($validCondition, FILTER_VALIDATE_BOOLEAN) ? '' : '!';

            $query->where(function ($query) use ($notFlag) {

                collect(PhoneNumberRegex::all())->each(function ($pattern) use ($query, $notFlag) {
                    $notFlag ? $query->where('phone', 'REGEXP', $notFlag . $pattern) : $query->orWhere('phone', 'REGEXP', $notFlag . $pattern);
                });
            });
        }

        return $query;
    }
}

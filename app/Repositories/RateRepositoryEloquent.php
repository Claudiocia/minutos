<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RateRepository;
use App\Models\Rate;
use App\Validators\RateValidator;

/**
 * Class RateRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RateRepositoryEloquent extends BaseRepository implements RateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rate::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

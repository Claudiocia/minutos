<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\IndicatorRepository;
use App\Models\Indicator;
use App\Validators\IndicatorValidator;

/**
 * Class IndicatorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class IndicatorRepositoryEloquent extends BaseRepository implements IndicatorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Indicator::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

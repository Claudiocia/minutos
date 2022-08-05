<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RazionRepository;
use App\Models\Razion;
use App\Validators\RazionValidator;

/**
 * Class RazionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RazionRepositoryEloquent extends BaseRepository implements RazionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Razion::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

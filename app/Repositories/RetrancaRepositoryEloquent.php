<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RetrancaRepository;
use App\Models\Retranca;
use App\Validators\RetrancaValidator;

/**
 * Class RetrancaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RetrancaRepositoryEloquent extends BaseRepository implements RetrancaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Retranca::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

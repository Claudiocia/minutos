<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PremioRepository;
use App\Models\Premio;
use App\Validators\PremioValidator;

/**
 * Class PremioRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PremioRepositoryEloquent extends BaseRepository implements PremioRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Premio::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

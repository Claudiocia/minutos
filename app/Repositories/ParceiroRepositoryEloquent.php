<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ParceiroRepository;
use App\Models\Parceiro;
use App\Validators\ParceiroValidator;

/**
 * Class ParceiroRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ParceiroRepositoryEloquent extends BaseRepository implements ParceiroRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Parceiro::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

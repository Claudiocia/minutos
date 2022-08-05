<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NoticiaRepository;
use App\Models\Noticia;
use App\Validators\NoticiaValidator;

/**
 * Class NoticiaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NoticiaRepositoryEloquent extends BaseRepository implements NoticiaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Noticia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

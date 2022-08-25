<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\NewsletterNoticiaRepository;
use App\Models\NewsletterNoticia;
use App\Validators\NewsletterNoticiaValidator;

/**
 * Class NewsletterNoticiaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class NewsletterNoticiaRepositoryEloquent extends BaseRepository implements NewsletterNoticiaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NewsletterNoticia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

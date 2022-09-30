<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Premio.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $nome
 * @property int $pontos
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Premio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Premio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Premio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Premio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Premio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Premio whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Premio wherePontos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Premio whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Premio extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'pontos'];

    public function getTableHeaders()
    {
        // TODO: Implement getTableHeaders() method.
    }

    public function getValueForHeader($header)
    {
        // TODO: Implement getValueForHeader() method.
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Retranca.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $nome
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Retranca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Retranca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Retranca query()
 * @method static \Illuminate\Database\Eloquent\Builder|Retranca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Retranca whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Retranca whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Retranca whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Retranca extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nome'
    ];

}

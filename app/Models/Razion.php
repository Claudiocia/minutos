<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Razion.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $number
 * @property string $texto
 * @property string|null $title
 * @property string $priori
 * @property string $ativo
 * @property string|null $icon
 * @property string|null $color
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Razion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Razion newQuery()
 * @method static \Illuminate\Database\Query\Builder|Razion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Razion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereAtivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion wherePriori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereTexto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Razion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Razion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Razion withoutTrashed()
 * @mixin \Eloquent
 */
class Razion extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'texto', 'title',
        'priori', 'ativo', 'icon', 'color',
    ];

    public function getTableHeaders()
    {
        // TODO: Implement getTableHeaders() method.
    }

    public function getValueForHeader($header)
    {
        // TODO: Implement getValueForHeader() method.
    }
}

<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Retranca.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $nome
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Retranca newModelQuery()
 * @method static Builder|Retranca newQuery()
 * @method static Builder|Retranca query()
 * @method static Builder|Retranca whereCreatedAt($value)
 * @method static Builder|Retranca whereId($value)
 * @method static Builder|Retranca whereNome($value)
 * @method static Builder|Retranca whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Retranca onlyTrashed()
 * @method static Builder|Retranca whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Retranca withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Retranca withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Foto[] $fotos
 * @property-read int|null $fotos_count
 */
class Retranca extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nome'
    ];

    public function fotos()
    {
        return $this->belongsToMany(Foto::class);
    }

    public function getTableHeaders()
    {
        return ['ID', 'Nome'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case 'ID':
                return $this->id;
            case 'Nome':
                return $this->nome;
        }
    }
}

<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Newsletter.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $numb_edicao
 * @property string $data_edicao
 * @property string $enviada
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Foto[] $fotos
 * @property-read int|null $fotos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Noticia[] $noticias
 * @property-read int|null $noticias_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Parceiro[] $parceiros
 * @property-read int|null $parceiros_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter newQuery()
 * @method static \Illuminate\Database\Query\Builder|Newsletter onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereDataEdicao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereEnviada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereNumbEdicao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Newsletter whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Newsletter withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Newsletter withoutTrashed()
 * @mixin \Eloquent
 */
class Newsletter extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'numb_edicao', 'data_edicao',
        'enviada', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fotos()
    {
        return $this->belongsToMany(Foto::class);
    }

    public function noticias()
    {
        return $this->belongsToMany(Noticia::class);
    }

    public function parceiros()
    {
        return $this->belongsToMany(Parceiro::class);
    }

    public function getTableHeaders()
    {
        // TODO: Implement getTableHeaders() method.
    }

    public function getValueForHeader($header)
    {
        // TODO: Implement getValueForHeader() method.
    }
}

<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Noticia.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $title
 * @property string $resumo
 * @property string $texto
 * @property string $fonte
 * @property string $link
 * @property string $data_cria
 * @property string|null $data_edit
 * @property int $user_id
 * @property int $retranca_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Foto[] $fotos
 * @property-read int|null $fotos_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Newsletter[] $newsletters
 * @property-read int|null $newsletters_count
 * @property-read \App\Models\Retranca $retranca
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia query()
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereDataCria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereDataEdit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereFonte($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereResumo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereRetrancaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereTexto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Noticia whereUserId($value)
 * @mixin \Eloquent
 */
class Noticia extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'resumo', 'texto', 'fonte',
        'link', 'data_cria', 'data_edit',
        'user_id',  'retranca_id'
    ];

    public function retranca()
    {
        return $this->belongsTo(Retranca::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newsletters()
    {
        return $this->belongsToMany(Newsletter::class);
    }

    public function fotos()
    {
        return $this->belongsToMany(Foto::class);
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

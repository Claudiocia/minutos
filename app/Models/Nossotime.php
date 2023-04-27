<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Nossotime.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $nome
 * @property string $funcao
 * @property string $texto
 * @property string|null $twitter
 * @property string|null $face
 * @property string|null $insta
 * @property string|null $linked
 * @property int|null $foto_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Foto|null $foto
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereFace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereFotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereFuncao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereInsta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereLinked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereTexto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereUpdatedAt($value)
 * @property string $ativo
 * @method static \Illuminate\Database\Eloquent\Builder|Nossotime whereAtivo($value)
 * @mixin \Eloquent
 */
class Nossotime extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'funcao', 'texto', 'twitter', 'face', 'insta', 'linked', 'ativo','foto_id'
    ];

    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }

    public function getTableHeaders()
    {
        return ['Ativo'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case 'Ativo':
                return $this->ativo == 's' ? 'Sim' : 'Não';
        }
    }
}

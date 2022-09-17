<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
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
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Models\Foto[] $fotos
 * @property-read int|null $fotos_count
 * @property-read Collection|\App\Models\Noticia[] $noticias
 * @property-read int|null $noticias_count
 * @property-read Collection|\App\Models\Parceiro[] $parceiros
 * @property-read int|null $parceiros_count
 * @property-read \App\Models\User $user
 * @method static Builder|Newsletter newModelQuery()
 * @method static Builder|Newsletter newQuery()
 * @method static \Illuminate\Database\Query\Builder|Newsletter onlyTrashed()
 * @method static Builder|Newsletter query()
 * @method static Builder|Newsletter whereCreatedAt($value)
 * @method static Builder|Newsletter whereDataEdicao($value)
 * @method static Builder|Newsletter whereDeletedAt($value)
 * @method static Builder|Newsletter whereEnviada($value)
 * @method static Builder|Newsletter whereId($value)
 * @method static Builder|Newsletter whereNumbEdicao($value)
 * @method static Builder|Newsletter whereUpdatedAt($value)
 * @method static Builder|Newsletter whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Newsletter withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Newsletter withoutTrashed()
 * @mixin \Eloquent
 * @property string $abertura
 * @property int|null $num_seq
 * @method static Builder|Newsletter whereAbertura($value)
 * @method static Builder|Newsletter whereNumSeq($value)
 * @property string|null $title_dia
 * @method static Builder|Newsletter whereTitleDia($value)
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
        'id', 'abertura','numb_edicao', 'data_edicao',
        'enviada', 'user_id', 'num_seq', 'title_dia'
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
        return $this->belongsToMany(Noticia::class, 'newsletter_noticia', 'newsletter_id', 'noticia_id');
    }

    public function parceiros()
    {
        return $this->belongsToMany(Parceiro::class);
    }

    public function getTableHeaders()
    {
        return ['Ed. Número', 'Dt. Edição', 'Enviada'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case 'Ed. Número':
                return $this->numb_edicao;
            case 'Dt. Edição':
                return \Carbon\Carbon::parse($this->data_edicao)->format('d/m/Y');
            case 'Enviada':
                return $this->enviada == 'n' ? 'Não' : 'Sim';
        }
    }
}

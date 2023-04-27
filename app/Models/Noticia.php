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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Models\Foto[] $fotos
 * @property-read int|null $fotos_count
 * @property-read Collection|\App\Models\Newsletter[] $newsletters
 * @property-read int|null $newsletters_count
 * @property-read Retranca $retranca
 * @property-read User $user
 * @method static Builder|Noticia newModelQuery()
 * @method static Builder|Noticia newQuery()
 * @method static Builder|Noticia query()
 * @method static Builder|Noticia whereCreatedAt($value)
 * @method static Builder|Noticia whereDataCria($value)
 * @method static Builder|Noticia whereDataEdit($value)
 * @method static Builder|Noticia whereFonte($value)
 * @method static Builder|Noticia whereId($value)
 * @method static Builder|Noticia whereLink($value)
 * @method static Builder|Noticia whereResumo($value)
 * @method static Builder|Noticia whereRetrancaId($value)
 * @method static Builder|Noticia whereTexto($value)
 * @method static Builder|Noticia whereTitle($value)
 * @method static Builder|Noticia whereUpdatedAt($value)
 * @method static Builder|Noticia whereUserId($value)
 * @property string $public
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Noticia onlyTrashed()
 * @method static Builder|Noticia whereDeletedAt($value)
 * @method static Builder|Noticia wherePublic($value)
 * @method static \Illuminate\Database\Query\Builder|Noticia withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Noticia withoutTrashed()
 * @property int|null $newsletter_id
 * @property-read \App\Models\Newsletter|null $newsletter
 * @method static Builder|Noticia busca($search)
 * @method static Builder|Noticia newsl($id)
 * @method static Builder|Noticia public($public)
 * @method static Builder|Noticia whereNewsletterId($value)
 * @mixin \Eloquent
 */
class Noticia extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'title', 'resumo', 'texto', 'fonte',
        'link', 'data_cria', 'data_edit', 'public',
        'user_id',  'retranca_id', 'newsletter_id',
    ];

    /**
	 * Escopo que busca clientes com limite
	 *
	 * @param Builder $query
	 * @return Builder
	 */
    public function scopePublic($query, $public)
    {
        return $query->where('public', '=', $public);
    }

    public function scopeBusca($query, $search)
    {
        return $query->where('texto', 'LIKE', '%'.$search.'%');
    }

    public function scopeNewsl($query, $id)
    {
        return $query->where('newsletter_id', '=', $id);
    }

    public function retranca()
    {
        return $this->belongsTo(Retranca::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    public function fotos()
    {
        return $this->belongsToMany(Foto::class);
    }

    public function getTableHeaders()
    {
        return ['Editoria', 'Título', 'Data', 'Publicada'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case 'Editoria':
                return $this->retranca->nome;
            case 'Título':
                return $this->title;
            case 'Data':
                return \Carbon\Carbon::parse($this->data_cria)->format('d/m/Y | H:m');
            case 'Publicada':
                return $this->public == 'n' ? 'Não' : 'Sim';
        }
    }
}

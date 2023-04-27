<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Rate.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $cliente_id
 * @property int $nota
 * @property string $title
 * @property string|null $texto
 * @property string $public
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Rate newModelQuery()
 * @method static Builder|Rate newQuery()
 * @method static Builder|Rate query()
 * @method static Builder|Rate whereClienteId($value)
 * @method static Builder|Rate whereCreatedAt($value)
 * @method static Builder|Rate whereId($value)
 * @method static Builder|Rate whereNota($value)
 * @method static Builder|Rate wherePublic($value)
 * @method static Builder|Rate whereTexto($value)
 * @method static Builder|Rate whereTitle($value)
 * @method static Builder|Rate whereUpdatedAt($value)
 * @property-read \App\Models\Cliente $cliente
 * @mixin \Eloquent
 */
class Rate extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'cliente_id', 'nota', 'title', 'texto', 'public'];

    public function getTableHeaders()
    {
        return ['Nome', 'Título', 'Nota', 'Public' ];
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class)->withTrashed();
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case 'Nome':
                return $this->cliente->nome;
            case 'Título':
                return $this->title;
            case 'Nota':
                return $this->nota;
            case 'Public':
                return $this->public == 'n' ? 'Não' : 'Publicada';
        }
    }
}

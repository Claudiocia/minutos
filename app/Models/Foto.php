<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Foto.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $nome
 * @property string $foto_path
 * @property string $origin_name
 * @property string $foto_thumb
 * @property string $using
 * @property string|null $legenda
 * @property string|null $credito
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Newsletter[] $newsletters
 * @property-read int|null $newsletters_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Noticia[] $noticias
 * @property-read int|null $noticias_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Site[] $sites
 * @property-read int|null $sites_count
 * @method static \Illuminate\Database\Eloquent\Builder|Foto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Foto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Foto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereCredito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereFotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereFotoThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereLegenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereOriginName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Foto whereUsing($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Retranca[] $retrancas
 * @property-read int|null $retrancas_count
 * @mixin \Eloquent
 */
class Foto extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'foto_path', 'origin_name',
        'using', 'legenda', 'credito', 'foto_thumb'];

    public function sites()
    {
        return $this->belongsToMany(Site::class);
    }

    public function noticias()
    {
        return $this->belongsToMany(Noticia::class);
    }

    public function newsletters()
    {
        return $this->belongsToMany(Newsletter::class);
    }

    public function retrancas()
    {
        return $this->belongsToMany(Retranca::class);
    }

    public function getTableHeaders()
    {
        return [];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case 'ident':
                return $this->id;
        }
    }
}

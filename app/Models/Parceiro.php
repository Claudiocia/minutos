<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Parceiro.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $nome
 * @property string $site
 * @property string $cnpj
 * @property string $tele
 * @property string $end
 * @property string $bairro
 * @property string $cidade
 * @property string $uf
 * @property string $email
 * @property string $slogan
 * @property string $data_ini
 * @property string $data_fim
 * @property int|null $foto_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Foto|null $foto
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Newsletter[] $newsletters
 * @property-read int|null $newsletters_count
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro query()
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereBairro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereCidade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereCnpj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereDataFim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereDataIni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereFotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereSlogan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereTele($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereUf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parceiro whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Parceiro extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nome', 'cnpj', 'tele', 'end',
        'bairro', 'cidade', 'uf', 'site', 'email',
        'slogan', 'data_ini', 'data_fim', 'foto_id'
    ];

    public function newsletters()
    {
        return $this->belongsToMany(Newsletter::class);
    }

    public function foto()
    {
        return $this->belongsTo(Foto::class);
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

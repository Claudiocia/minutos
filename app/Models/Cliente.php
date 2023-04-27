<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Cliente.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $signed
 * @property int $review
 * @property int|null $foto_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Foto|null $foto
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereFotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereSigned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereUpdatedAt($value)
 * @property string|null $motivo
 * @property-read \App\Models\Rate|null $rate
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereMotivo($value)
 * @property string|null $validado
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereValidado($value)
 * @property string|null $token
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereToken($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Cliente onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Cliente withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Cliente withoutTrashed()
 * @property-read \App\Models\Indicator|null $indicator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Premio[] $premios
 * @property-read int|null $premios_count
 * @mixin \Eloquent
 */
class Cliente extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use SoftDeletes;

    const ASSINANTE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nome', 'email',
        'signed', 'motivo', 'review',
        'token', 'validado', 'foto_id'];

    public function foto()
    {
        return $this->belongsTo(Foto::class);
    }

    public function rate()
    {
        return $this->hasOne(Rate::class);
    }

    public function indicator()
    {
        return $this->hasOne(Indicator::class);
    }

    public function premios()
    {
        return $this->belongsToMany(Premio::class);
    }

    public function getTableHeaders()
    {
        return ['ID','Nome', 'Email', 'Situação', 'Avalia'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case 'ID':
                return $this->id;
            case 'Nome':
                return $this->nome;
            case 'Email':
                return $this->email;
            case 'Situação':
                return $this->signed == 1 ? 'Ativo' : 'Inativo';
            case 'Avalia':
                return !$this->review ? 'Sem Avaliação' : $this->rate->nota;
        }
    }
}

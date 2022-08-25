<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class NewsletterNoticia.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $editoria
 * @property int $newsletter_id
 * @property int $noticia_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Noticia|null $noticia
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterNoticia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterNoticia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterNoticia query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterNoticia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterNoticia whereEditoria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterNoticia whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterNoticia whereNewsletterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterNoticia whereNoticiaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsletterNoticia whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewsletterNoticia extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'editoria', 'newsletter_id', 'noticia_id'
    ];

    public function noticia()
    {
        return $this->belongsTo(Noticia::class);
    }

}

<?php

namespace App\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Site.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $title_site
 * @property string $apoio_title
 * @property string $text_abert
 * @property string $site_final
 * @property string $text_botton_site
 * @property string $cancel_one
 * @property string $cancel_two
 * @property string $title_razion
 * @property string|null $apoio_razion
 * @property string $title_causa
 * @property string $apoio_causa
 * @property string $text_causa
 * @property string $causa_final
 * @property string $title_review
 * @property string|null $apoio_review
 * @property string $title_cta
 * @property string|null $apoio_cta
 * @property string $title_footer
 * @property string $text_footer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Foto[] $fotos
 * @property-read int|null $fotos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Site newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Site newQuery()
 * @method static \Illuminate\Database\Query\Builder|Site onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Site query()
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereApoioCausa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereApoioCta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereApoioRazion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereApoioReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereApoioTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereCancelOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereCancelTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereCausaFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereSiteFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTextAbert($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTextBottonSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTextCausa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTextFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTitleCausa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTitleCta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTitleFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTitleRazion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTitleReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereTitleSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Site whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Site withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Site withoutTrashed()
 * @mixin \Eloquent
 */
class Site extends Model implements Transformable, TableInterface
{
    use TransformableTrait;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'site_nome','title_site', 'apoio_title', 'text_abert',
        'text_botton_site', 'cancel_one', 'cancel_two',
        'title_razion',  'title_causa', 'apoio_causa', 'text_causa',
        'causa_final', 'title_review', 'apoio_review', 'title_cta',
        'apoio_cta', 'final_cta', 'title_footer', 'text_footer',
        'site_final', 'apoio_razion', 'causa_final',
    ];

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

<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PortfolioDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_item_id',
        'page_title',
        'breadcrumb_title',
        'project_title',
        'category',
        'client',
        'company',
        'college',
        'project_date',
        'technologies',
        'project_url',
        'project_url_label',
        'slider_style',
        'image_style',
        'info_style',
        'description_title',
        'description',
    ];

    public function portfolioItem(): BelongsTo
    {
        return $this->belongsTo(PortfolioItem::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioDetailImage::class)->orderBy('sort_order');
    }
}

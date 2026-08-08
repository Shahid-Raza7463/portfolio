<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioDetailImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_detail_id',
        'image',
        'width',
        'height',
        'sort_order',
    ];

    public function detail(): BelongsTo
    {
        return $this->belongsTo(PortfolioDetail::class, 'portfolio_detail_id');
    }
}

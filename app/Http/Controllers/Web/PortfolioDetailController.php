<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Portfolio\PortfolioItem;
use Illuminate\View\View;

class PortfolioDetailController extends Controller
{
    public function portfolio(int $id): View
    {
        return $this->show("/portfolio-details/{$id}");
    }

    public function android(int $id): View
    {
        return $this->show("/android-app/{$id}");
    }

    private function show(string $detailsUrl): View
    {
        $portfolioItem = PortfolioItem::with(['detail.images'])
            ->where('details_url', $detailsUrl)
            ->where('is_active', true)
            ->firstOrFail();

        abort_unless($portfolioItem->detail, 404);

        return view('web.pages.portfolio.detail', [
            'portfolioItem' => $portfolioItem,
            'detail' => $portfolioItem->detail,
        ]);
    }
}

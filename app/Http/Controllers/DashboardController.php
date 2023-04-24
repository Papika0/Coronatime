<?php

namespace App\Http\Controllers;

use App\Models\CountryStats;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
	public function show(): View
	{
		$stats = CountryStats::selectRaw('sum(confirmed) as confirmed, sum(recovered) as recovered, sum(deaths) as deaths')
		->first();
		return view('dashboard.worldwide', ['stats' => $stats]);
	}

	public function index(Request $request): View
	{
		$countryStats = CountryStats::filter($request)->get();

		return view('dashboard.countries', ['countryStats' => $countryStats]);
	}
}

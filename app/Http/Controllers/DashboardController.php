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
		$sort = $request->sort;

		$countryStats = CountryStats::select('country_stats.country', 'country_stats.confirmed', 'country_stats.deaths', 'country_stats.recovered', 'country_stats.code', 'countries.name')
		->join('countries', 'countries.code', '=', 'country_stats.code')
		->where(function ($query) use ($request) {
			$query->where('countries.name->en', 'LIKE', "%$request->search%")
				  ->orWhere('countries.name->ka', 'LIKE', "%$request->search%");
		})
		->when($sort, function ($query, $sort) {
			[$column, $direction] = explode('_', $sort);
			return $query->orderBy($column, $direction);
		})
		->get();

		return view('dashboard.countries', ['countryStats' => $countryStats]);
	}
}

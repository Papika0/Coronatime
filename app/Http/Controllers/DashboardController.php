<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
	public function show(): View
	{
		$stats = DB::table('country_stats')
		->selectRaw('sum(confirmed) as confirmed, sum(recovered) as recovered, sum(deaths) as deaths')
		->first();
		return view('dashboard.worldwide', ['stats' => $stats]);
	}

	public function showCountries(Request $request): View
	{
		$search = $request->search;
		$sort = $request->sort;

		$countryStats = DB::table('country_stats')
			->select('country', 'confirmed', 'deaths', 'recovered')
			->where('country', 'LIKE', "%$search%")
			->when($sort, function ($query, $sort) {
				[$column, $direction] = explode('_', $sort);
				return $query->orderBy($column, $direction);
			})
			->get();

		return view('dashboard.countries', ['countryStats' => $countryStats]);
	}
}

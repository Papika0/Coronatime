<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Contracts\View\View;
use App\Http\Requests\CountryRequest;

class CountryController extends Controller
{
	public function show(): View
	{
		$stats = Country::selectRaw('sum(confirmed) as confirmed, sum(recovered) as recovered, sum(deaths) as deaths')
		->first();
		return view('dashboard.worldwide', ['stats' => $stats]);
	}

	public function index(CountryRequest $request): View
	{
		$countryStats = Country::filter($request)->get();

		return view('dashboard.countries', ['countryStats' => $countryStats]);
	}
}

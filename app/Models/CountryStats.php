<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CountryStats extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function countryName()
	{
		return $this->belongsTo(Countries::class, 'code', 'code');
	}

	public function scopeFilter($query, $request)
	{
		$search = $request->search;
		$sort = $request->sort;

		if ($search) {
			$query->whereHas('countryName', function ($query) use ($search) {
				$query->where('name->en', 'LIKE', "%$search%")
					  ->orWhere('name->ka', 'LIKE', "%$search%");
			});
		}

		if ($sort) {
			[$column, $direction] = explode('_', $sort);
			$query->orderBy($column, $direction);
		}

		return $query;
	}
}

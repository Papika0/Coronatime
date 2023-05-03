<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
	use HasFactory, HasTranslations;

	protected $guarded = [];

	public $translatable = ['name'];

	public function scopeFilter($query, $request)
	{
		$search = $request->search;
		$sort = $request->sort;

		if ($search) {
			$searchFields = ['name->en', 'name->ka'];
			$query->where(function ($query) use ($searchFields, $search) {
				foreach ($searchFields as $field) {
					$query->orWhere($field, 'LIKE', "%$search%");
				}
			});
		}

		if ($sort) {
			[$column, $direction] = explode('_', $sort);
			if (in_array($column, ['name.en', 'name.ka'])) {
				$query->orderByRaw('JSON_EXTRACT(name, "$.' . str_replace('name.', '', $column) . '") ' . $direction);
			} else {
				$query->orderBy($column, $direction);
			}
		}

		return $query;
	}
}

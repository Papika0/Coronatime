<?php

return [
	'required' => 'აუცილებელია შეივსოს :attribute.',

	'min' => [
		'string' => ':attribute უნდა იყოს მინიმუმ :min ასო.',
	],

	'email'    => ':attribute უნდა იყოს ვალიდური.',

	'exists'   => 'არჩეული :attribute არასწორია.',
	'unique'   => 'ასეთი :attribute უკვე არსებობს.',

	'same'       => ':attribute და :other უნდა ემთხვეოდეს ერთმანეთს.',
	'attributes' => [
		'email'                 => 'ელ-ფოსტა',
		'password'              => 'პაროლი',
		'username'              => 'სახელი',
		'password_confirmation' => 'პაროლი განმეორებით',
	],
];

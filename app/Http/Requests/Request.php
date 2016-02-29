<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
	public function rules()
	{
		return [
			'title' => 'required|unique:posts',
			'description' => 'required',
			'image' => 'required',
		];
	}
}

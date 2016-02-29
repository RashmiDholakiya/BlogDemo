<?php

namespace App\Http\Controllers;

use App\Events\LoginDone;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LoginRequest;


class LoginController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public  $post_repo;
	public function __construct(PostRepositoryInterface $post)
	{
			$this->post_repo=$post;
		$this->post_repo=$post;

	}
	public function check(LoginRequest $req)
	{
		$user_name = Input::get('username');
		$password = Input::get('password');
		$user= ['username'=>Input::get('username'),'password'=>Input::get('password')];


		 if(Auth::attempt($user)){
			//Event::fire(new LoginDone($user));
				return redirect('home');


		} else{
			Session::flash('message', 'Enter Valid Email Address And Password');
			Session::flash('alert-class', 'alert-danger');
			return Redirect::back();
		}
	}

	public function Logout()
	{
		Auth::logout();
		return redirect::to('/');
	}
}

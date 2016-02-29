<?php

namespace App\Http\Controllers;
use App\Events\LoginDone;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public  $post_repo;


    public function __construct(PostRepositoryInterface $post)
    {
        $this->post_repo=$post;
    }
    public function index()
    {

        return view('login');
    }

    public function addblog()
    {
        return view('blog.add_blog');
    }

    public function view_editblog($id)
    {
        $records = $this->post_repo->get_Blog($id);
		return view('admin.editblog',compact('records'));
    }


    public function register()
    {
        $records = $this->post_repo->get_country();
        return view('registration',compact('records'));
    }

    public function get_state()
    {

        $records = $this->post_repo->get_state(Input::get('id'));
        return json_encode($records);
    }

    public function do_register()
    {
        $user= ['username'=>Input::get('username'),'password'=>Input::get('password')];
        $values = array('username' => Input::get('username'), 'password' => Hash::make(Input::get('password')),
                        'state_id' => Input::get('state'));

        $user_id = $this->post_repo->registerUser($values);
        if($user_id)
        {
            Event::fire(new LoginDone($user));
            return redirect('login');
        }
        else
        {
            Session::flash('message', 'User of '.Input::get('username').' is already exist.. Try another email id.');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::back();
        }
    }

}

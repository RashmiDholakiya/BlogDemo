<?php

namespace App\Http\Controllers;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use SSymfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Validator;


class BlogController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public  $post_repo;
	public function __construct(PostRepositoryInterface $post)
	{
		$this->post_repo=$post;
	}

	public function home()
	{
		$records = $this->post_repo->getUserRecords();
		$records_admin = $this->post_repo->getAdminRecords();
			if($records==null)
			{
				return redirect(url('error'));
			}
		if($records_admin==null)
		{
			return redirect(url('error'));
		}
			$uname = Auth::id();
			if($uname == "1")
			{

				return view('admin.home',compact('records_admin'));
			}
			else {
				return view('blog.blog', compact('records'));
			}

	}

	public function front()
	{
		$records = $this->post_repo->getUserRecords();
		return view('blog.blog', compact('records'));
	}
	public function insert()
	{
		$data = Input::all();

        if ($data != NULL) {

			$rules = array(
				'title'       => 'required',
				'description' => 'required',
				'image'       => 'mimes:jpeg,png,jpg',
			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput();

			}
			/*$user       = ['username' => Input::get('username'), 'password' => Input::get('password')];
			$extensions = array("jpeg", "jpg", "png");
			if (in_array(Input::file('image')->getClientOriginalExtension(), $extensions) === false) {
				Session::flash('message', 'Extension Not allowed!!! Choose only JPEG,JPG,PNG files');
				Session::flash('alert-class', 'alert-danger');
				return Redirect::back();
			}*/
			$date     = date("Y-m-d");
			$date     = strtotime($date);
			$new_date = strtotime('+ 1 year', $date);
			$d        = date('Y/m/d', $new_date);

			$filename = date("d-m-Y") . "-" . time() . '.' . Input::file('image')->getClientOriginalExtension();

			$des = 'resources/assets/upload/';
			if(Input::file('image')->move($des, $filename)) {
				$values = array('title'          => Input::get('title'), 'description' => Input::get('description'),
								'image_path'     => $filename, 'active_from_date' => date('Y-m-d'),
								'active_to_date' => $d, 'status' => 'Active');

				$id = $this->post_repo->insertBlog($values);

				return redirect('/home');
			}
			else
			{
				Session::flash('message', 'Your File size is too long..Please select samller one');
				Session::flash('alert-class', 'alert-danger');
				return Redirect::back();
			}
		}
	}

	public function comment($id)
	{
		$comments = $this->post_repo->getComments($id);

		if($comments->isEmpty())
		{
			Session::flash('message', 'No Comments added in the blog');
			Session::flash('alert-class', 'alert-danger');
			return Redirect::back();
		}
		return view('admin.comment',compact('comments'));
	}
	public function view_blog($id)
	{

		$records = $this->post_repo->getSelectedBlog($id);
		$comments =$this->post_repo->getSelectedComment($id);
		if($records==null)
		{
			return redirect(url('error'));
		}
		return view('blog.viewblog',compact('records'),compact('comments'));
	}

	public function insertComment($id)
	{
		$userId = Auth::id();
		$data = Input::all();

		if ($data != NULL) {

			$rules = array(
				'comment'       => 'required',

			);

			$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()) {
				return Redirect::back()->withErrors($validator)->withInput();

			}

			$values = array('comment' => Input::get('comment'), 'user_id' => $userId,
							'article_id' => $id);

			$comment_id = $this->post_repo->insertComment($values);

			return redirect(url('/viewBlog/'.$id));


		}
	}

	public function editBlog()
	{
		if(!Input::file('image'))
		{
			$filename = Input::get('old_image');
		}
		else {


			$extensions = array("jpeg", "jpg", "png");
			if (in_array(Input::file('image')->getClientOriginalExtension(), $extensions) === false) {
				Session::flash('message', 'Extension Not allowed!!! Choose only JPEG,JPG,PNG files');
				Session::flash('alert-class', 'alert-danger');
				return Redirect::back();
			}

			$filename = date("d-m-Y") . "-" . time() . '.' . Input::file('image')->getClientOriginalExtension();

			$des = 'resources/assets/upload/';
			Input::file('image')->move($des, $filename);
		}
		$values = array('title' => Input::get('title'), 'description' => Input::get('description'),
						'image_path' => $filename);

		$update_id = $this->post_repo->updateBlog(Input::get('id'),$values);

		return redirect(url('/home'));
	}

	public function search()
	{
		$data = $this->post_repo->search(Input::get('title'));
		return json_encode($data);
	}

	public function searchBystatus()
	{

		$data = $this->post_repo->search_by_status(Input::get('status'));
		return json_encode($data);
	}
	public function updateStatus($id,$status)
	{
		$res=$this->post_repo->changeStatus($id,$status);
		return redirect::back();
	}

}

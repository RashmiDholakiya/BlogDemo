<?php

namespace App\Http\Controllers;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;
use SSymfony\Component\HttpFoundation\File\UploadedFile;


class adminController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public  $post_repo;
	public function __construct(PostRepositoryInterface $post)
	{
		$this->post_repo=$post;
	}
	public function delete($id)
	{

		$id = $this->post_repo->deleteBlog($id);
		if($id)
		{
			return Redirect::back();
		}
		else
		{
			Session::flash('message', 'Delete Uns');
			Session::flash('alert-class', 'alert-danger');
			return Redirect::back();
		}

	}
	public function deleteComment($id)
	{

		$id = $this->post_repo->deleteComment($id);
		return Redirect::back();
	}

	public function deleteRows()
	{
		$ids=Input::get('ids');
		$this->post_repo->deleteSelected($ids);

	}
}

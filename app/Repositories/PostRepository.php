<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/2/16
 * Time: 5:29 PM
 */
namespace App\Repositories;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class PostRepository implements PostRepositoryInterface
{
	public function save()
	{

	}
	public function getAdminRecords()
	{
		return DB::table('tbl_blog')->orderBy('id', 'desc')->paginate(5);
	}

	public function getUserRecords()
	{
		return DB::table('tbl_blog')->where('status', 'Active')->orderBy('id', 'desc')->paginate(3);
	}

	public function deleteBlog($id)
	{
		return DB::table('tbl_blog')
			->where('id',$id)
			->delete();
	}

	public function deleteComment($id)
	{
		return DB::table('tbl_comment')
			->where('id',$id)
			->delete();
	}

	public function deleteSelected($ids)
	{
		$sql= "DELETE FROM tbl_comment WHERE id IN ($ids)";
		return DB::delete($sql);
	}

	public function insertBlog($val)
	{
		return DB::table('tbl_blog')->insertGetId($val);
	}

	public function getComments($id)
	{
		return DB::table('customer')
			->Join('tbl_comment', 'tbl_comment.user_id', '=', 'customer.id')
			->where('tbl_comment.article_id',$id)
			->orderBy('tbl_comment.id', 'desc')
			->paginate(5);
	}

	public function getSelectedBlog($id)
	{
		return DB::table('tbl_blog')->where('id', $id)->where('status','Active')->get();
	}

	public function getSelectedComment($id)
	{
		return  DB::table('tbl_comment')
			->Join('customer', 'tbl_comment.user_id', '=', 'customer.id')
			->where('article_id', $id)
			->orderBy('tbl_comment.id', 'desc')
			->get();
	}

	public function insertComment($values)
	{
		return DB::table('tbl_comment')->insertGetId($values);
	}

	public function updateBlog($id,$value)
	{
		return DB::table('tbl_blog')
			->where('id',$id)
			->update($value);
	}

	public function search($title)
	{
		return DB::table('tbl_blog')->where('title','like', $title."%")->where('status','Active')->get();
	}

	public function search_by_status($status)
	{
		return DB::table('tbl_blog')->where('status', $status)->get();
	}

	public function changeStatus($id,$status)
	{
		return DB::table('tbl_blog')
			->where('id', $id)
			->update(['status' => $status]);
	}

	public function get_Blog($id)
	{
		return DB::table('tbl_blog')->where('id', $id)->get();
	}

	public function get_country()
	{
		return DB::table('tbl_country')->get();
	}

	public function get_state($id)
	{
		return DB::table('tbl_state')->where('country_id', $id)->get();
	}

	public function registerUser($values)
	{
		try
		{
			(DB::table('customer')->insertGetId($values));
			return true;
		}
		catch(QueryException $e)
		{
			return false;
		}



	}
}
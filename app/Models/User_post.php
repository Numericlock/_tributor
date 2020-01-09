<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_post extends Model
{
    protected $table = 'users_posts';
	protected $fillable = ['post_user_id', 'content_text', 'parent_post_id', 'is_deleted', 'longitude', 'latitude'];
	
	public function scopeOfPosts($query,$user_id){
		return $query->select('users_posts.*','users_posts.id as posts_id', 'users.id as users_id', 'users.name as users_name', 'users_follows.subject_user_id as subject_user_id','users_follows.is_canceled as is_canceled',
		\DB::raw(//フォロー数
			"(SELECT COUNT(subject_user_id = users.id  OR NULL) AS subject_count FROM users_follows) AS subject_count "
		),
		\DB::raw(//フォロワー数
			"(SELECT COUNT(*) FROM users_follows WHERE followed_user_id = users.id) AS followed_count "
		),
		\DB::raw(//フォローされているかどうか
			"(SELECT COUNT(followed_user_id = '$user_id' OR NULL) FROM `users_follows` WHERE subject_user_id = users.id AND is_canceled = 0) AS users_followed_count "
		)
		)
		->leftjoin('posts_valid_disclosure_lists', 'users_posts.id', '=', 'posts_valid_disclosure_lists.post_id')
		->leftjoin('users_follows', 'users_follows.followed_user_id', '=', 'users_posts.post_user_id')
        ->leftjoin('users', 'users_posts.post_user_id', '=', 'users.id')
		->leftjoin('disclosure_lists_users', 'disclosure_lists_users.list_id', '=', 'posts_valid_disclosure_lists.list_id')
		->where('users_follows.subject_user_id',$user_id)
		->where('disclosure_lists_users.user_id',$user_id)
		->orWhere('users_follows.subject_user_id',$user_id)
		->whereNull('disclosure_lists_users.user_id')
		->orWhere('users_posts.post_user_id',$user_id)
		->distinct();
	}
}

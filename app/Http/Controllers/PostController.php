<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_post;
use App\Models\Post_valid_disclosure_list;
use App\Models\Attached_content;
use App\Models\User_favorite;
use App\Http\Requests\PostFormRequest;
use Log;

class PostController extends Controller
{
    public function __construct()
    {
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }
	
	public function post (PostFormRequest $request){
		$post = new User_post;
		$post -> post_user_id = $request->base_user->user_id;
		$post -> content_text = $request->content_text;
		$post -> is_deleted = 0;
		if($request->parent_post_id){
			$post -> parent_post_id = $request->parent_post_id;
		}
        $png ="png";
		$post -> save();
		$id = $post->id;
        foreach($request->lists as $list){
            Log::debug($list);
            Log::debug($id);
            Post_valid_disclosure_list::create([
                'list_id'=> $list,
                'post_id'=> $id,
                'is_hidden'=> 0
            ]);
        }
        
        Log::debug("あひる");
            $count=0;
        foreach($request->filetati as $file){
            $canvas = $file;
            $canvas = preg_replace("/data:[^,]+,/i","",$canvas);
            $canvas = base64_decode($canvas);
            $image = imagecreatefromstring($canvas);
            $savepath=$id;
            $img_path = 'img/post_img/'.$savepath."_".$count.".png";
            imagesavealpha($image, TRUE); // 透明色の有効
            imagepng($image ,$img_path);
            $count++;
            
            Attached_content::create([
                'post_id'=> $id,
                'content_type'=>$png,
                'content_file_path'=>$img_path
            ]);
			
        }
        Log::debug("あひる3");
		return User_post::where('post_user_id', $request->base_user->user_id)->get();
	}
	
	public function get_posts (Request $request){
		$user = $request->base_user;
		$posts = User_post::ofPosts($user->user_id)->offset($request->num)->limit(25)->get();
		return $posts;
	}
	
	public function users_favorite (Request $request){
		Log::debug($request->post_id);
		User_favorite::create([
			'user_id'=>$request->base_user->user_id,
			'post_id'=>$request->post_id,
			'is_canceled'=>0
		]);
	}
    
    	private static function unique_filename($org_path, $num=0){

		if( $num > 0){
			$info = pathinfo($org_path);
			$path = $info['dirname'] . "/" . $info['filename'] . "_" . $num;
			if(isset($info['extension'])) $path .= "." . $info['extension'];
		} else {
			$path = $org_path;
		}

		if(file_exists($path)){
			$num++;
			return unique_filename($org_path, $num);
		} else {
			$path.=".png";
			return $path ;
		}
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSession;
use App\Models\Disclosure_list;
use App\Models\Disclosure_list_user;
use App\Http\Requests\listFormRequest;
use App\Http\Requests\listMemberRequest;
use Log;

class ListsController extends Controller
{

    public function __construct()
    {
        // 作成したMiddlewareを呼び出し
        $this->middleware('auth.before');
    }

	public function lists (Request $request){
		$user = $request->base_user;
		$lists = $request->base_user_lists;
		return view('lists',compact('user','lists'));
	}

	public function lists_insert(listFormRequest $request){
        

        
		$list = new Disclosure_list;
		$list -> name = $request->name;
		$list -> owner_user_id = $request->base_user->user_id;
		$list -> is_published = $request->publish;
		$list -> is_hidden = $request->hidden;
		$list -> save();
		$id = $list->id;
        
        //ヘッダに「data:image/png;base64,」が付いているので、それは外す
        $canvas = $request->icon;
        $canvas = preg_replace("/data:[^,]+,/i","",$canvas);
 
//残りのデータはbase64エンコードされているので、デコードする
        $canvas = base64_decode($canvas);
 
//まだ文字列の状態なので、画像リソース化
        $image = imagecreatefromstring($canvas);
 
//画像として保存（ディレクトリは任意）
        $savepath=$id;
        $path2 ='img/list_icon/';
        $path2 .=$savepath;
        $img_path =  self::unique_filename($path2);
        imagesavealpha($image, TRUE); // 透明色の有効
        imagepng($image ,$img_path);
        
        foreach($request->users as $user){
            Disclosure_list_user::create([
                'list_id'=> $id,
                'user_id'=> $user,
                'is_deleted'=> 0
            ]);
        }
		return $list;
	}

	public function users_lists(Request $request){
		$lists = Disclosure_list_user::select('list_id')
		->join('disclosure_lists', 'disclosure_lists.id', '=', 'disclosure_lists_users.list_id' )
		->where('disclosure_lists_users.user_id', $request->input('user_id'))
		->where('disclosure_lists.owner_user_id', $request->base_user->user_id)
		->get();
		Log::debug($lists."LISTMEMBERあいでwwwwwwwwwwwー");
		return $lists;
	}
	
	
	public function lists_member_post(listMemberRequest $request){


		/*$lists = Disclosure_list::join('disclosure_lists_users', 'disclosure_lists.id', '=', 'disclosure_lists_users.list_id')
		->join('users', 'users.id', '=', 'disclosure_lists_users.user_id')
		->where('disclosure_lists.id', $request->input('list_id'))
		->get();*/
		Log::debug($request->input('list_id')."LISTMEMBERあいでー");
		$lists = Disclosure_list::select('id as list_id','name')
		->where('id', $request->input('list_id'))
		->first();
		$lists_users = Disclosure_list_user::select('disclosure_lists_users.user_id as users_id', 'users.name as users_name')
		->join('users', 'users.id', '=', 'disclosure_lists_users.user_id')
		->where('disclosure_lists_users.list_id', $request->input('list_id'))
		->get();
		$count = $lists_users->count();


		Log::debug($lists."LISTMEMBERあいでー");
		return view('lists_members',compact('lists','lists_users', 'count'));
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

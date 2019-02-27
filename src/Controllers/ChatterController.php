<?php

namespace Codiiv\Chatter\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Codiiv\Chatter\Models\ForumCategory;

use Sentinel;

class ChatterController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }
  public function loadAdmin(){
    return view('chatter::admin');
  }
  public function loadInstall(){
    return view('chatter::install');
  }
  public function loadPage($page){
    if (view()->exists('chatter::pages.'.$page))
      {
        return view('chatter::pages.'.$page, ["page"=>$page]);
      }
    else
      {
        return redirect()->back();
      }
  }

  public static function insertCategory(Request $request){
    $x      = $request->payload_source;
    $sender = base64_decode(base64_decode($x));
    $category = new ForumCategory;

    if(Sentinel::check()):
      $category->name = $request->name;
      $category->parent_id = $request->parent;
      $category->color = '#'.$request->color;
      $slugged = str_slug($request->name, '-');

      $exists = ForumCategory::where('slug', $slugged)->first();
      if($exists){
        $category->slug = $slugged.'-1';
      }else{
        $category->slug = $slugged;
      }
      $saved  = $category->save();
      $lastInsertedId = $category->term_id;

      if($saved){
        $message = __("Created Successfully");
        $msgtype = 1;
      }else{
        $message = __("There were errors creating the post");
        $msgtype = 0;
      }

    else:
      $message = __("You absolutely are NOT authorized to do that");
      $msgtype = 0;
    endif;

    return redirect('/chatteradmin/categories')->with('status', ["message"=>$message, "msgtype"=>$msgtype]);
  }
  static public function deleteCategory(){
    $cat  = $_POST['cat'];
    $page = $_POST['page'];
    if(Sentinel::check()):
      $dis = ForumCategory::where('id', $cat)->first();
      $directParent = $dis->parent_id;
      // We update direct descendants if any
      $updateOrphans = ForumCategory::where('parent_id', $cat)
      ->update(['parent_id' => $directParent]);

      //WE then obliterate the category
      $deleted = ForumCategory::destroy($cat);

      if($deleted){
        $message = __("Deleted Successfully");
        $msgtype = "success";
      }else{
        $message = __("There were errors deleting category");
        $msgtype = 0;
      }

    else:
      $message = __("You are trying to be smart");
      $msgtype = 0;
    endif;
    return response()->json(["message"=>$message, "msgtype"=>$msgtype, 'page'=>$page]);
  }
}

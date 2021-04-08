<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Middleware\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MainPageController extends Controller
{
    public function index()
    {
        $posts = Posts::latest()->get(); 
        $b = [];
        foreach($posts as $a) {
            $c =  User::where('id', $a->post_user_id . '')->get();
            foreach($c as $d)
                array_push($b, $d->name);
        }
        return view('main/newsfeedpage', [ 'posts' => $posts, 'usersforthepost' => $b]);
    }

    public function addPost()
    {
        return view('main/addpost');
    }
    public function createpost(Request $request)
    {
        $file = $request->file('postimage');
        $text = $request->input('posttext');

        if ($file != null && $text != '') {
            $ext = $file->getClientOriginalExtension();
            $imgname = time() . '' . rand(0, 1000) . '.' . $ext;
            $destinationPath = 'storage';
            $file->move($destinationPath, $imgname);
            $posts = new Posts();
            $posts->post_text = $text;
            $posts->post_user_id = Auth::user()->id;
            $posts->post_img_src = $destinationPath . '/' . $imgname;
            $posts->post_date = date("l jS \of F Y h:i:s") . "";
            $posts->save();
            return back()->withInput()->with('messagegood', 'Post has been added');
        } else {
            return back()->withInput()->with('messagebad', 'Please fill everything');
        }
    }

    public function showallmyposts()
    {
        $user_id = Auth::user()->id;
        $all_posts = Posts::where('post_user_id', $user_id)->get();
        error_log($all_posts);
        return view('main/myposts', ['all_posts' => $all_posts]);
    }

    public function destroy($id) {

        $postToDelete = Posts::findOrFail($id);
        $a = '' . $postToDelete->post_img_src;
        File::delete($a);
        $postToDelete->delete();
        return redirect('/main/editdelte');
    }
}

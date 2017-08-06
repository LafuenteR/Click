<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Input;
use App\Post;
use App\Like;
use App\Comment;

class Social_Controller extends Controller
{
    function editAbout(Request $request){
        $edit_about = Auth::user();
        $edit_about->birthday = $request->birthday;
        $edit_about->address = $request->address;
        $edit_about->contact = $request->contact;
        $edit_about->bio = $request->bio;
        $edit_about->save();
        return back();
    }
    function editProfile(Request $request){
    	$edit_profile = Auth::user();
    	$edit_profile->name = $request->name;

    	if ($request->avatar){
    		 $image = $request->avatar;

    		
    		$filename = time().'.'.$image->getClientOriginalExtension();

    		if(preg_match("/(\.jpeg|\.png|\.jpg)$/", $filename)){ 

    		$image->move('uploads',$filename);
    		$edit_profile->avatar = 'uploads/'.$filename;
    		}

    	}
        if ($request->cover){
             $image = $request->cover;

            $filename = time().'.'.$image->getClientOriginalExtension();

            if(preg_match("/(\.jpeg|\.png|\.jpg|\.gif)$/", $filename)){ 

            $image->move('uploads',$filename);
            $edit_profile->cover = 'uploads/'.$filename;
            }

        }

		
    	$edit_profile->save();

    	return back();
    }
    function searchAccount(Request $request){
    	// $accounts = User::all();
        $search = $request->search;
        $accounts= User::where('name','Like','%'.$search.'%')->get();
    	return view('social.search',compact('accounts'));
    }
    function uploadPost(Request $request){
    	$new_post = new Post();
    	// $new_post->img = "$request->img";
    	$new_post->description = "$request->description";
    	$new_post->user_id = Auth::user()->id;

        if(empty($request->img)){

        }
        else{
    	$image = $request->img;
		$filename = time().'.'.$image->getClientOriginalExtension();
		$image->move('uploads',$filename);
    	$new_post->img = 'uploads/'.$filename;
        }
        if(empty($request->cover)){

        }
        else{
        $image = $request->cover;
        $filename = time().'.'.$image->getClientOriginalExtension();
        $image->move('uploads',$filename);
        $new_post->cover = 'uploads/'.$filename;
        }

    	$new_post->save();
    	return back();	
 
    }
    function postRequest($id){
        $accounts = User::find($id);
        $posts = Post::all();
        // dd($accounts);
        $pending_requests = Auth::user()->pendingRequests();
        $friends = Auth::user()->friends();
        $connections = Auth::user()->myRequests->merge(Auth::user()->theirRequests);
        Auth::user()->addFriend($accounts);
        // dd($connections);
        return back();  
    }
    function showProfile($id){
    $accounts = User::find($id);
    $posts = Post::orderBy('id','desc')->get();
    $pending_requests = Auth::user()->pendingRequests();
    $friends = Auth::user()->friends();
    $connections = Auth::user()->myRequests->merge(Auth::user()->theirRequests);
    return view('social.profile_post',compact('accounts','posts','connections','friends','pending_requests'));
    }
    // function addForm($id){
    //     $accounts = User::find($id);
    //     Auth::user()->addFriend($accounts);
    //     $posts = Post::all();
    //     return view('social.profile_post',compact('accounts','posts'));
    // }
    function showAbout($id){
    $accounts = User::find($id);
    // dd($accounts);
    return view('social.about',compact('accounts'));
    }
    function showHomePost(){
        $accounts = User::all();
        $comments = Comment::orderBy('id','desc')->get();;
        $likes = Like::all();
        $friends = Auth::user()->friends();
        // dd($friends);
        $connections = Auth::user()->myRequests->merge(Auth::user()->theirRequests);
        $pending_requests=Auth::user()->pendingRequests();
        $posts = Post::orderBy('id','desc')->get();
    return view('social.home',compact('posts','accounts',
        'connections','pending_requests','likes','comments','friends')); 
    }
    function cancelRequest($id){
        Auth::user()->cancelRequest($id);
        return back();   
    }
    function acceptRequest($id){
        Auth::user()->acceptRequest($id);
        return back();   
     }
     function unfriend($id){
        Auth::user()->unfriend($id);
        return back();
     }
     function showFriends($id){
        $accounts = User::find($id);
        $friends = $accounts->friends();
        $pending_requests = Auth::user()->pendingRequests();
        $connections = Auth::user()->myRequests->merge(Auth::user()->theirRequests);
        return view('social.friend',compact('accounts','connections','friends','pending_requests'));
     }
     function like(Request $request){
        $new_like = new Like();
        $new_like->user_id = Auth::user()->id;
        $new_like->post_id = $request->id;
        $new_like->save();
        return back();
        }
    function unlike(Request $request){
    $unlike = Like::where('post_id',$request->id)->where('user_id',Auth::user()->id)->first();
    $unlike->delete();
    return back();
    }
    function deletePost(Request $request){
        $deletePost = Post::where('id',$request->id)->where('user_id',Auth::user()->id)->first();
        $deletePost->delete();
        return back();
    }
    function deleteComment(Request $request){
        $deleteComment = Comment::where('id',$request->id)->first();
        $deleteComment->delete();
        return back();
    }
    function addcomment(Request $request){
        $new_comment = new Comment();
        $new_comment->user_id = Auth::user()->id;
        $new_comment->post_id = $request->id;
        $new_comment->comment = $request->content;

        $new_comment->save();
        $post = Post::find($request->id);
        $comments = Post::find($request->id)->comments()->orderBy('id','desc')->get();
        $accounts = User::all();

        return view('social.commentbox',compact('comments','accounts','post'));
    }

   }


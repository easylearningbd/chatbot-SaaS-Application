<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\GenerateBlogPostJob;
use Illuminate\Support\Facades\Auth; 
use App\Models\Blog;

class BlogController extends Controller
{
    public function BlogList(){
        $blogs = Blog::latest()->get();
        return view('admin.backend.blogs.blog_list',compact('blogs'));
    }
    //End Method 

    public function AdminBlogsCreate(){
        return view('admin.backend.blogs.blog_create');
    }
    //End Method 

    public function AdminBlogsStore(Request $request){
        $request->validate([
            'title' => 'required|string'
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'status' => 'pending',
        ]);

        GenerateBlogPostJob::dispatch($blog);

        $notification = array(
            'message' => 'Blog post generate Successfully It may takes little time',
            'alert-type' => 'success'
        ); 
        return redirect()->route('blog.list')->with($notification); 

    }
     //End Method 




} 

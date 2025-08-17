<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Blog;

class BlogController extends Controller
{
    public function BlogList(){
        $blogs = Blog::latest()->get();
        return view('admin.backend.blogs.blog_list',compact('blogs'));
    }
    //End Method 




} 

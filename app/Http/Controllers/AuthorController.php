<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;


use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;





class AuthorController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('back.pages.home');
    }


    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function ResetForm(Request $request, $token = null)
    {
        $data = ['pageTitle' => 'Reset Password'];
        return view('back.pages.auth.reset', $data)->with(['token' => $token, 'email' => $request->email]);
    }


    public function createPost(Request $request)
    {
        $request->validate([
            'post_title' => 'required|unique:posts,post_title',
            'post_content' => 'required',
            'post_category' => 'required|exists:categories,id',
            'featured_image' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $path = "images/post_images/";
            $file = $request->file('featured_image');
            $filename = $file->getClientOriginalName();
            $new_filename = time() . '_' . $filename;

            $upload = Storage::disk('public')->put($path . $new_filename, (string) file_get_contents($file));

            if ($upload) {
                $post = new Post();
                $post->author_id = auth()->id();
                $post->category_id = $request->post_category;
                $post->post_title = $request->post_title;
                $post->post_slug = Str::slug($request->post_title);
                $post->post_content = $request->post_content;
                $post->featured_image = $new_filename;
                $saved = $post->save();

                if ($saved) {
                    // $this->emit('show-toast', ['message' => 'Đã thêm thành công!']);
                } else {
                    // $this->emit('show-toast', ['message' => 'Lỗi cmnr!']);
                }
            } else {
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\PostRequest;
use App\Http\Requests\Posts\PostUpdateRequest;
use App\Http\Resources\Posts\PostIndexResource;
use App\Http\Resources\Posts\PostResource;
use App\Jobs\UploadImage;
use App\Models\Post;
use App\Repositories\Contracts\PostInterface;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $posts;

    public function __construct(PostInterface $posts)
    {
        $this->middleware('auth:api')->only('store');

        $this->posts = $posts;
    }
    
    public function index()
    {
        $posts = $this->posts->paginate(5);

        return PostIndexResource::collection($posts);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function store(PostRequest $request)
    {  
        //get the post image 
        $image = $request->file('image');
        $image_path = $image->getPathName();
        
        //get the original file and replace any spaces with _
        $filename = time()."_".preg_replace('/\s+/','_',strtolower($image->getClientOriginalName()));
        
        //move the image to the temporary location
        $temp = $image->storeAs('uploads/original',$filename, 'temp');

        //create a record to the database for the post before any jobs
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'title' => $title = $request->title,
            'slug' => str_slug( time()."-".$title),
            'body' => $request->body,
            'image' => $filename,
            'disk' => config('site.upload_disk'),
        ]);

        //adding tags
        $post->tag($request->tags);

    //dispatch a job to handle the image manipulation
    $this->dispatch(new UploadImage($post));
    return new PostResource($post);
    }

    public function update(PostUpdateRequest $request, $post)
    {
        $post = Post::find($post);
        $this->authorize('update', $post);

        $post->update([
            'title'=>$request->title,
            'body' => $request->body,
            'is_live' => ! $post->upload_successful ? false : $request->is_live 
        ]);

        //adding tags
        $post->retag($request->tags);


        return new PostResource($post);
    }

    public function destroy($post){
        $post = Post::findOrFail($post);
        $this->authorize('delete',$post);

       

        //delete the images associated to the post
        foreach(['thumbnail','large','original'] as $size){
            //check if the images exist in the database 
            if(Storage::disk($post->disk)->exists("uploads/posts/{$size}/".$post->image)){
                Storage::disk($post->disk)->delete("uploads/posts/{$size}/".$post->image);
            }
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted'],200);
    }

}

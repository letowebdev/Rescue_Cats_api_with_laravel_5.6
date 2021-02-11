<?php

namespace App\Jobs;

use Image;
use File;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $disk = $this->post->disk;
        $filename = $this->post->image;
        $original_file = storage_path() . '/uploads/original/'. $filename;

        try{
            // create the Large Image and save to tmp disk
            Image::make($original_file)
                ->fit(800, 600, function($constraint){
                    $constraint->aspectRatio();
                })
                ->save($large = storage_path('uploads/large/'. $filename));

            // Create the thumbnail image
            Image::make($original_file)
                ->fit(250, 200, function($constraint){
                    $constraint->aspectRatio();
                })
                ->save($thumbnail = storage_path('uploads/thumbnail/'. $filename));
            
            // store images to permanent disk
            // original image
            if(Storage::disk($disk)
                ->put('uploads/posts/original/'.$filename, fopen($original_file, 'r+'))){
                    File::delete($original_file);
                }

            // large images
            if(Storage::disk($disk)
                ->put('uploads/posts/large/'.$filename, fopen($large, 'r+'))){
                    File::delete($large);
                }

            // thumbnail images
            if(Storage::disk($disk)
                ->put('uploads/posts/thumbnail/'.$filename, fopen($thumbnail, 'r+'))){
                    File::delete($thumbnail);
                }
            
            // Update the database record with success flag
            $this->post->update([
                'upload_successful' => true
            ]);

        } catch(\Exception $e){
            \Log::error($e->getMessage());
        }

    }
}
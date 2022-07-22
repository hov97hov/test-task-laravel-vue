<?php

namespace App\Service\Post;

use App\Interfaces\Post\PostInterface;
use App\Models\Post;

class PostService implements PostInterface
{
    /**
     * @param $data
     * @return mixed|void
     */
   public function createPost($data)
   {
        $post = Post::create([
            'title' => $data->title,
            'description' => $data->description,
        ]);
        if($data->file('image')){
           $file= $data->file('image');
           $filename= date('YmdHi').$file->getClientOriginalName();
           $file-> move(public_path('public/Image'), $filename);
           $post['image']= $filename;
       }
       $post->save();
   }

    /**
     * @param $data
     * @return mixed|void
     */
    public function editPost($data)
    {
        $post = Post::update([
            'title' => $data->title,
            'description' => $data->description,
        ]);
//        if($data->file('image')){
//            $file= $data->file('image');
//            $filename= date('YmdHi').$file->getClientOriginalName();
//            $file-> move(public_path('public/Image'), $filename);
//            $post['image']= $filename;
//        }
//        $post->save();
    }
}

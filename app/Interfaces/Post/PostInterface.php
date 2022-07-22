<?php

namespace App\Interfaces\Post;

/**
 * Interface CategoryServiceInterface
 * @package App\Interfaces
 */
interface PostInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function createPost($data);

    /**
     * @param $data
     * @return mixed
     */
    public function editPost($data);
}

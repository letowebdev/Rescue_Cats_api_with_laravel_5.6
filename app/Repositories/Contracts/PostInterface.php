<?php

namespace App\Repositories\Contracts;

interface PostInterface {

    public function addTags($id, array $data);

    public function reTags($id, array $data);

    public function like($id);

    public function wasLikedByUser($id);







}
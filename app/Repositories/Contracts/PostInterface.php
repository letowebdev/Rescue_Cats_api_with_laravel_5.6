<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface PostInterface {

    public function addTags($id, array $data);

    public function reTags($id, array $data);

    public function like($id);

    public function wasLikedByUser($id);

    public function search(Request $request);







}
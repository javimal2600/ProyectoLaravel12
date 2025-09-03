<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    //creating, created, updating, updated, saving, saved, deleting, deleted, restoring, restored
    public function updating(Post $post)
    {
        if ($post->is_published == 1 && !$post->published_at) {
            $post->published_at = now();
        }
    }
}

<?php

namespace Modules\Like\Traits;

Use Modules\Like\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Likes {

    public function likes(): MorphMany {
        return $this->morphMany(Like::class, 'likeable');
    }

}

<?php

namespace Modules\Like\Http\Requests;

use Modules\Like\Http\Requests\LikeRequest;

class UnlikeRequest extends LikeRequest {

    public function authorize() {
        return $this->user()->can('unlike', $this->likeable());
    }

}

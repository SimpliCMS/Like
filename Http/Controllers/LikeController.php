<?php

namespace Modules\Like\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Controller;
use Modules\Like\Models\Like;
use Modules\Like\Http\Requests\LikeRequest;
use Modules\Like\Http\Requests\UnlikeRequest;

class LikeController extends Controller {

    public function like(LikeRequest $request) {
        $request->user()->like($request->likeable());

        if ($request->ajax()) {
            return response()->json([
                        'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }

    public function unlike(UnlikeRequest $request) {
        $request->user()->unlike($request->likeable());

        if ($request->ajax()) {
            return response()->json([
                        'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }

}

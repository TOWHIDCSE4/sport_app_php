<?php

namespace App\Http\Controllers\API\Like;

use App\Http\Controllers\API\BaseController;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Validator;
use Illuminate\Http\Request;

class LikeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $like = false;
        $validator = Validator::make($request->all(), [
            'target_id' => 'required',
            'target_type' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error);
        }
        $target_id = $request->input('target_id');
        $target_type  = $request->input('target_type');
        $source_id = auth()->user()->id;
        try {
            if ($target_type == 'post') {
                $post = Post::where('id', $target_id)->first();
                if (empty($post)) {
                    return response()->json(['success' => false], 404);
                }
            } else if ($target_type == 'comment') {
                $comment = Comment::where('id', $target_id)->first();
                if (empty($comment)) {
                    return response()->json(['success' => false], 404);
                }
            } else {
                return response()->json(['success' => false], 404);
            }
            $like = Like::updateOrCreate([
                'source_id' =>  $source_id,
                'source_type' =>  'user',
                'target_id' => $target_id,
                'target_type' => $target_type,
            ]);
        } catch (\Throwable $th) {
            // throw $th;
        }
        if ($like) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $target_id)
    {
        // $remove = false;
        $validator = Validator::make($request->all(), [
            'target_type' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error);
        }
        $target_type  = $request->input('target_type');
        try {
            $remove = Like::where('target_id', $target_id)
                ->where('target_type', $target_type)
                ->where('source_id', auth()->user()->id)
                ->where('source_type', 'user')
                ->first();
            if (auth()->user()->id != $remove->source_id) {
                return $this->sendError('User does not have permission.');
            }
            $remove = Like::where('target_id', $target_id)
                ->where('target_type', $target_type)
                ->where('source_id', auth()->user()->id)
                ->where('source_type', 'user')
                ->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
        if ($remove) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
}

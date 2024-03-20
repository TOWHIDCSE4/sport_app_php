<?php

namespace App\Http\Controllers\API\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\API\Help\HelpController;
use App\Http\Requests\API\Post\PostRequest;
use App\Http\Resources\CommentListResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use App\Repositories\EloquentCommentRepository;
use App\Repositories\EloquentPostRepository;
use Validator;
use phpDocumentor\Reflection\Types\Null_;

define('TYPE_USER', 'user');
define('TYPE_TEAM', 'team');

class PostController extends BaseController
{
    public function __construct(
        private EloquentPostRepository $_postRepository,
        private EloquentCommentRepository $_commentRepository,
        )
    {
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createPost(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'content' => ['required', 'String'],
            'team_id' => ['sometimes', 'numeric'],
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error);
        }

        $team_id = null;
        $creator_id = auth()->user()->id;
        $creator_type = 'user';

        if (isset($input['team_id'])) {
            if (Team::where('id', $input['team_id'])->exists()) {
                $team = Team::where('id', $input['team_id'])->first();
                // return $team->members;
                $help = new HelpController();
                $dataCheckPermission = $help->getPermissionRole($team->id);
                // return $dataCheckPermission;
                if (!in_array('team_post_management', $dataCheckPermission)) {
                    return $this->sendError('User does not have permission.');
                }
                $team_id = $team->id;
                $creator_id = $team->id;
                $creator_type = 'team';
            } else {
                return $this->sendError('Team doesn\'t exist!');
            }
        }

        $dataInsert = [
            'content' => $input['content'],
            'team_id' => $team_id,
            'creator_id' => $creator_id,
            'creator_type' => $creator_type,
        ];

        $postCreated = null;
        try {
            $postCreated = Post::create($dataInsert);
        } catch (\Throwable $th) {
            return $this->sendError($th);
        }

        return $this->sendResponse(new PostResource($postCreated), 'success');
    }

    public function getDetailPost($id)
    {
        $port = null;
        try {
            $port = Post::find($id);

            if (empty($port)) {
                return $this->sendError('Post not found.');
            }
        } catch (\Throwable $th) {
            return $this->sendError('An error occurred');
        }

        return $this->sendResponse(new PostResource($port), 'success');
    }

    public function updatePost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'sometimes|required',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return $this->sendError($error);
        }
        $input = $request->all();

        $user = null;
        try {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            if (empty($user)) {
                return $this->sendError('User Not Found!');
            }
            $post = Post::find($id);
            if (empty($post)) {
                return $this->sendError('Post not found.');
            }

            if (
                $post->creator_type == TYPE_USER &&
                $post->creator_id != $user_id
            ) {
                return $this->sendResponse(
                    [],
                    'User does not have permission.'
                );
            }

            if ($post->creator_type == TYPE_TEAM) {
                // check permission
                $help = new HelpController();
                $dataCheckPermission = $help->getPermissionRole(
                    $post->creator_id
                );
                if (!in_array('team_post_management', $dataCheckPermission)) {
                    return $this->sendError('User does not have permission.');
                }
            }
            $res = $post->update([
                'content' => $input['content'],
            ]);
            if ($res) {
                return $this->sendResponse(new PostResource($post), 'success');
            }
        } catch (\Throwable $th) {
            return $this->sendError('An error occurred');
        }
        return response()->json(['success' => false], 404);
    }

    public function removePost($id)
    {
        try {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            if (empty($user)) {
                return $this->sendError('User Not Found!');
            }
            $post = Post::find($id);
            if (empty($post)) {
                return $this->sendError('Post not found.');
            }

            if (
                $post->creator_type == TYPE_USER &&
                $post->creator_id != $user_id
            ) {
                return $this->sendResponse(
                    [],
                    'User does not have permission.'
                );
            }

            if ($post->creator_type == TYPE_TEAM) {
                // check permission
                $help = new HelpController();
                $dataCheckPermission = $help->getPermissionRole(
                    $post->creator_id
                );
                if (!in_array('team_post_management', $dataCheckPermission)) {
                    return $this->sendError('User does not have permission.');
                }
            }

            $res = $post->delete();
            if ($res) {
                return response()->json(['success' => true], 200);
            }
        } catch (\Throwable $th) {
            return $this->sendError('An error occurred');
        }

        return response()->json(['success' => false], 404);
    }

    public function comments (Post $post, Request $request) {
        $user = $request->user();
        $user_id = $user->id;
        $teamIds = $request->user()->memberTeams()
        ->whereHas('teamMember', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
            $q->whereHas('member_role.permissions', function ($q) {
                $q->where('title', 'team_post_management');
            });
        })
        ->get()->pluck('id')->toArray();
        $request->teamIds = $teamIds;
        $limit = $request->input('perPage', 20);

        $comments = $this->_postRepository->getComents($post, [
            'limit' => $limit
        ]);

        return $this->sendResponse(CommentListResource::collection($comments), 'success');
    }
    public function reply (Post $post, Comment $comment, Request $request) {
        $user = $request->user();
        $user_id = $user->id;
        $teamIds = $request->user()->memberTeams()
        ->whereHas('teamMember', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
            $q->whereHas('member_role.permissions', function ($q) {
                $q->where('title', 'team_post_management');
            });
        })
        ->get()->pluck('id')->toArray();
        $request->teamIds = $teamIds;
        $limit = $request->input('perPage', 20);

        $comments = $this->_commentRepository->getReply($comment, [
            'limit' => $limit
        ]);

        return $this->sendResponse(CommentListResource::collection($comments), 'success');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $usersWithPostsAndComments = User::with('posts.comments')->get();
        $usersWithSpecificPostAndComments = User::with('post_comments')->get();
        $usersWithCountOfPostComments = User::withCount('post_comments')->get();

        $today = Carbon::now();
        $yesterday = Carbon::yesterday();
        $usersWithMostRecentPostComments = User::withCount([
            'post_comments' => function ($q) use ($today, $yesterday) {
                $q->whereBetween('created_at', [$yesterday, $today]);
            }
        ]);

        return response()->json([
            'usersWithPostsAndComments' => $usersWithPostsAndComments,
            'usersWithSpecificPostAndComments' => $usersWithSpecificPostAndComments,
            'usersWithCountOfPostComments' => $usersWithCountOfPostComments,
            'usersWithMostRecentPostComments' => $usersWithMostRecentPostComments,
        ], 200);
    }
}

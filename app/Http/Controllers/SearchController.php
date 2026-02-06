<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class SearchController extends Controller
{
    public function find(Request $request): View
    {
        $request->validate([
            'username' => ['required', 'string'],
        ]);

        $user = User::where('username', $request->username)->first();

        return view('pages.search', compact('user'));
    }

}

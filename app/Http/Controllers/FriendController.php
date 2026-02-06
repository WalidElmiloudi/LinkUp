<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Models\Friendship;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\View\View;

class FriendController extends Controller
{   
    public function show(User $user): View
    {
        $sentFriendRequests = $user->sentFriendRequests;
        $ReceivedFriendRequests = $user->receiveFriendRequests;
        $friends = $user->friends;
        return view('pages.friends',['sentRequests' => $sentFriendRequests,'receivedRequests' => $ReceivedFriendRequests,'friends' => $friends]);
    }

    public function send(Request $request){
        $userId = $request->reciever_id;
        auth()->user()->sendFriendRequestTo($userId);
        return back();
    }

    public function accept(FriendRequest $friendRequest)
    {
       abort_if($friendRequest->reciever_id !== auth()->id(), 403);

        DB::transaction(function () use ($friendRequest) {

        // create friendship BOTH ways
        Friendship::create([
            'user_id' => $friendRequest->sender_id,
            'friend_id' => $friendRequest->reciever_id,
        ]);

        Friendship::create([
            'user_id' => $friendRequest->reciever_id,
            'friend_id' => $friendRequest->sender_id,
        ]);
        $friendRequest->accept();

        });

        return back()->with('success', 'Demande acceptée');
    }

    public function reject(FriendRequest $friendRequest){
        if ($friendRequest->reciever_id !== auth()->id()) {
            abort(403);
        }
        $friendRequest->reject();
        return back()->with('success', 'Demande refusée');
    }

    public function cancel(FriendRequest $friendRequest){
        if ($friendRequest->sender_id !== auth()->id()) {
            abort(403);
        }
        $friendRequest->cancel();
        return back()->with('success', 'Demande annulée');
    }

    public function remove(User $user){
        $authUser = auth()->user();
        if (! $authUser->isFriendWith($user->id)) {
            return back()->with('error', 'Vous n’êtes pas amis.');
        }
        $authUser->removeFriend($user->id);
        return back()->with('success', 'Ami supprimé avec succès.');
    }
}

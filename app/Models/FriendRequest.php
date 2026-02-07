<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class FriendRequest extends Model
{
    protected $fillable = ['reciever_id' , 'sender_id' , 'stat'];

    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function reciever(){
        return $this->belongsTo(User::class, 'reciever_id');
    }
    
    public function accept(): void
    {
        $this->delete();
    }

    public function reject(): void
    {
        $this->delete();
    }

    public function cancel(): void
    {
        $this->delete();
    }
}

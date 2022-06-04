<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventsInvitedUsers extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'event_id',
        'user_id',
        'created_by',
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function event(){
        return $this->belongsTo('App\Models\Events', 'event_id', 'id');
    }

}

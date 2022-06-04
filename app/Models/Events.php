<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model
{
    use HasFactory, SoftDeletes;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'description',
        'created_by',
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function eventsInvitedUsers(){
        return $this->hasMany('App\Models\EventsInvitedUsers', 'id', 'event_id');
    }


}

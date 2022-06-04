<?php

namespace App\Repositories;

use App\Models\EventsInvitedUsers;
use Illuminate\Support\Facades\Auth;

class EventsInvitedUsersRepository
{

    protected $model;

    /**
     * Create a new Model instance.
     *
     * @param  Models\EventsInvitedUsers $model
     */
    public function __construct(EventsInvitedUsers $model)
    {
        $this->model = $model;
    }

     /**
     * created/update events.
     *
     * @param  $request
     * @return object
     */

    public function store($inputs){
        return $this->model->create($inputs);
    }

      /**
     * Get single events details
     *
     * @param $id
     * @return object
     */
    public function getById($id){
        return $this->model->find($id);
    }

     /**
     * Remove event
     *
     * @param $id
     * @return object
     */
    public function destroy($id){
        return $this->model->find($id)->delete();
    }
    public function destroyByEventId($eventId){
        return $this->model->where('event_id',$eventId)->delete();
    }

    /**
     * get all user events
     *
     * @param Auth::id
     * @return object
     */
    public function getMyEventId($eventId){
        return $this->model->where('event_id',$eventId)
        ->with(['user'=>function($que){
            return $que->select('id','first_name','last_name','email');
        }])
        ->get();
    }

    public function alreadyExists($inputs){
        return $this->model
        ->where('event_id',$inputs['event_id'])
        ->where('user_id',$inputs['user_id'])
        ->count();
    }


}

<?php

namespace App\Repositories;

use App\Models\Events;
use App\Models\EventsInvitedUsers;
use Illuminate\Support\Facades\Auth;

class EventsRepository
{

    protected $model, $invitedUsers;

    /**
     * Create a new Model instance.
     *
     * @param  Models\Events $model
     * @param  Models\EventsInvitedUsers $invitedUsers
     */
    public function __construct(Events $model,EventsInvitedUsers $invitedUsers)
    {
        $this->model = $model;
        $this->invitedUsers = $invitedUsers;
    }
   
     /**
     * created/update events.
     *
     * @param  $request
     * @return object
     */

    public function store($inputs){
        return $this->model->updateOrCreate(['id' => $inputs['id']], $inputs);
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

    /**
     * get all user events
     *
     * @param Auth::id
     * @return object
     */
    public function getMyEvents(){
        return $this->model->where('created_by',\Auth::id())->get();
    }

    /**
     * get all events
     *
     * @param Auth::id
     * @return object
     */

    public function getAllEvents(){
        return $this->model->all();
    }



}

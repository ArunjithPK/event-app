<?php

namespace App\Repositories;

use App\Models\Events;
use App\Models\EventsInvitedUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventsRepository
{

    protected $model, $invitedUsers;

    /**
     * Create a new Model instance.
     *
     * @param  Models\Events $model
     * @param  Models\EventsInvitedUsers $invitedUsers
     */
    public function __construct(Events $model, EventsInvitedUsers $invitedUsers)
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

    public function store($inputs)
    {
        return $this->model->updateOrCreate(['id' => $inputs['id']], $inputs);
    }

    /**
     * Get single events details
     *
     * @param $id
     * @return object
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Remove event
     *
     * @param $id
     * @return object
     */
    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * get all user events
     *
     * @param Auth::id
     * @return object
     */
    public function getMyEvents()
    {
        return $this->model->where('created_by', \Auth::id())->get();
    }

    /**
     * get all events
     *
     * @param Auth::id
     * @return object
     */

    public function getAllEvents()
    {
        return $this->model->all();
    }

    public function getAllWithPaginate($inputs)
    {
        return $this->model
            ->when((isset($inputs['search']) && (!empty($inputs['search']))), function ($query) use ($inputs) {
                return $query->where(function ($que) use ($inputs) {
                    return $que->where('name', 'like', '%' . $inputs['search'] . '%')
                        ->orWhere('description', 'like', '%' . $inputs['search'] . '%');
                });
            })
            ->when((isset($inputs['start_date']) && (!empty($inputs['start_date']))), function ($query) use ($inputs) {
                return $query->where('start_date', '>=', $inputs['start_date']);
            })
            ->when((isset($inputs['end_date']) && (!empty($inputs['end_date']))), function ($query) use ($inputs) {
                return $query->where('end_date', '<=', $inputs['end_date']);
            })
            ->orderBy('start_date', 'DESC')
            ->paginate($inputs['per_page']);
    }

    public function getCreatedWiseReports()
    {
        return $this->model
            ->select('created_by', \DB::raw('count(*) as total'))
            ->groupBy('created_by')
            ->with(['user' => function ($que) {
                return $que->select('id', 'first_name', 'last_name');
            }])
            ->get();
    }

    public function getEventsRepots()
    {
        return \DB::table('events')
            ->leftjoin('events_invited_users', 'events.id', '=', 'events_invited_users.event_id')
            ->where('events.deleted_at',null)
            ->where('events_invited_users.deleted_at',null)
            ->select('events.id', 'name', DB::raw('count(events_invited_users.id) as invites_count'))
            ->groupBy('id', 'name')
            ->get();
    }
    public function getUserRepots()
    {
        return \DB::table('users')
            ->leftjoin('events', 'users.id', '=', 'events.created_by')
            ->where('events.deleted_at',null)
            ->where('users.deleted_at',null)
            ->select('users.id', 'first_name','last_name', DB::raw('count(events.id) as event_count'))
            ->groupBy('id')
            ->get();
    }
}

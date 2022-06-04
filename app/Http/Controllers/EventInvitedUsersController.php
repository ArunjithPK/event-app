<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HelperService;
use App\Repositories\EventsRepository;
use App\Repositories\EventsInvitedUsersRepository;
use App\Http\Requests\EventsInvitedUsersRequest;
use App\Models\User;

class EventInvitedUsersController extends Controller
{
    protected $repository, $eventsRepository;

    public function __construct(EventsInvitedUsersRepository $repository, EventsRepository $eventsRepository){
        $this->repository = $repository;
        $this->eventsRepository = $eventsRepository;
    }

    public function index($eventId){
        $event = $this->eventsRepository->getById($eventId);
        return view('events.invited-users',compact('event'));
    }

    public function store(EventsInvitedUsersRequest $request){
        try {
            $users = User::where('email',$request->email)->first();
            if($users){
                $inputs['event_id'] = $request->event_id;
                $inputs['user_id'] = $users->id;
                $isExists = $this->repository->alreadyExists($inputs);
               if($isExists > 0){
                    $msg = 'User already invited.';
                }else{
                    if(!$request->filled('id')){
                        $inputs['created_by'] = \Auth::id();
                    }
                    $this->repository->store($inputs);
                    return response()->json(HelperService::returnTrueResponse());
                }
            }else{
                $msg = 'Given email not registred to our system.';
            }
            return response()->json(HelperService::returnFalseResponse($msg));
        } catch (\Exception $e) {
            return response()->json(HelperService::returnFalseResponse($e));
        }
    }

    public function getAll($eventId){
        return datatables()->of($this->repository->getMyEventId($eventId))->addIndexColumn()->toJson();
    }

       /**
     * Remove .
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->destroy($id);
            return response()->json(HelperService::returnTrueResponse());
        } catch (\Exception $e) {
            return response()->json(HelperService::returnFalseResponse($e));
        }
    }

}

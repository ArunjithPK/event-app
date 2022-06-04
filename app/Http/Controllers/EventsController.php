<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EventsRepository;
use App\Repositories\EventsInvitedUsersRepository;
use App\Http\Requests\EventRequest;
use App\Services\HelperService;

class EventsController extends Controller
{

    protected $repository, $invitedUsersRepository;

    public function __construct(EventsRepository $repository,
    EventsInvitedUsersRepository $invitedUsersRepository)
    {
        $this->repository = $repository;
        $this->invitedUsersRepository = $invitedUsersRepository;
    }

    public function index(){
        return view('events.list');
    }

    public function store(EventRequest $request){
        try {
            $inputs = $request->all();
            if(!$request->filled('id')){
                $inputs['created_by'] = \Auth::id();
            }
            $this->repository->store($inputs);
            return response()->json(HelperService::returnTrueResponse());
        } catch (\Exception $e) {
            return response()->json(HelperService::returnFalseResponse($e));
        }

    }

    public function getMyEvents(){
        return datatables()->of($this->repository->getMyEvents())->addIndexColumn()->toJson();
    }

    public function getById($id){
        return $this->repository->getById($id);
    }

     /**
     * Remove .
     * @return Response
     */
    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $this->repository->destroy($id);
            $this->invitedUsersRepository->destroyByEventId($id);
            \DB::commit();
            return response()->json(HelperService::returnTrueResponse());
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(HelperService::returnFalseResponse($e));
        }
    }

    public function getDashboardData(Request $request){
        $inputs = $request->all();
        $inputs['per_page'] = 9;
        $events = $this->repository->getAllWithPaginate($inputs);
        return view('welcome', [
            'events' => $events,
            'params'=>$inputs
        ]);
    }

    public function reportPage(){
    //    $createdWise = $this->repository->getCreatedWiseReports();
    //    $invitedWise = $this->invitedUsersRepository->getInvitedWiseReports();

       $events = $this->repository->getEventsRepots();
       $users = $this->repository->getUserRepots();
    //    return $events;
        return view('events.reports', [
            'users' => $users,
            'events' => $events
        ]);
    }

}


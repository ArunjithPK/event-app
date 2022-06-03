<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Services\HelperService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegistraionController extends Controller
{
    public function index()
    {
        return view('user.register');
    }

    public function store(UserRequest $request)
    {
        try {
            $inputs = $request->all();
            $inputs['password'] = Hash::make($request->password);
            User::create($inputs);
            return response()->json(HelperService::returnTrueResponse());
        } catch (\Exception $e) {
            return response()->json(HelperService::returnFalseResponse($e));
        }
    }

    public function loginPage()
    {
        return view('user.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(HelperService::returnTrueResponse());
        }else{
            $message = 'These credentials do not match with our records.';
            return response()->json(HelperService::returnFalseResponse($message));
        }

    }
}

<?php

namespace App\Http\Controllers;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\EventController;
use App\User;
use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Profilecollection;
use App\Http\Resources\ProfileResource;
class ProfileController extends Controller
{
    public function index()
    {
        $user=User::all();
        return response()->json(Profilecollection::Collection($user));

    }

    public function show($id)
    {

         $user=User::findOrFail($id);
        return new ProfileResource($user);

    }
}

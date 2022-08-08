<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function me() {
        return (new UserResource(request()->user()));
    }
}

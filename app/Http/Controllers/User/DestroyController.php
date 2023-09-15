<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DestroyController extends Controller
{
    public function __invoke(User $user)
    {
        $user->delete();
        return response([]);
    }
}

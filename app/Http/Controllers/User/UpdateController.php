<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

class UpdateController extends Controller
{
    public function __invoke(User $user, UpdateRequest $request)
    {
        $new_data = $request->validated();
        $user->update($new_data);
        return response([]);
    }
}

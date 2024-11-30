<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateEmailUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // public function show(User $user)
    // {
    //     //
    // }

    // public function update(Request $request, User $user)
    // {
    //     //
    // }

    public function updateEmail(UpdateEmailUserRequest $request)
    {
        $request->user()->update(['email' => $request->email]);

        return new JsonResponse([
            'message' => 'updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

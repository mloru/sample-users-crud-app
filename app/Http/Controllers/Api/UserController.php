<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Schema\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /** @var Validator $validator */
        $validator = ValidatorFacade::make(
            $request->all(),
            [
                'name' => 'required|min:1|max:' . Builder::$defaultStringLength,
                'email' => 'required|email|unique:users|max:' . Builder::$defaultStringLength,
                'password' => 'required|confirmed|min:8|max:' . Builder::$defaultStringLength,
            ]
        );

        if ($validator->fails()) {
            return new Response(
                $validator->messages(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        /** @var User $user */
        $user = User::create($validator->validated());

        return new Response(
            $user,
            HttpFoundationResponse::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /** @var User|null $user */
        $user = User::where('id', $id)
                    ->first();

        if (!$user) {
            return new Response(
                'User not found',
                HttpFoundationResponse::HTTP_NOT_FOUND
            );
        }

        return new Response(
            $user,
            HttpFoundationResponse::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /** @var Validator $validator */
        $validator = ValidatorFacade::make(
            $request->all(),
            [
                'name' => 'nullable|max:' . Builder::$defaultStringLength,
                'email' => 'nullable|email|unique:users,email,' . $id . '|max:' . Builder::$defaultStringLength,
                'password' => 'nullable|min:8|confirmed|max:' . Builder::$defaultStringLength,
            ]
        );

        if ($validator->fails()) {
            return new Response(
                $validator->messages(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        /** @var User|null $user */
        $user = User::where('id', $id)
                    ->first();

        if (!$user) {
            return new Response(
                'User not found',
                HttpFoundationResponse::HTTP_NOT_FOUND
            );
        }

        $user->update($validator->validated());

        return new Response(
            $user,
            HttpFoundationResponse::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /** @var User|null $user */
        $user = User::where('id', $id)
                    ->first();

        if (!$user) {
            return new Response(
                'User not found',
                HttpFoundationResponse::HTTP_NOT_FOUND
            );
        }

        $user->delete();

        return new Response(
            'User deleted successfully.',
            HttpFoundationResponse::HTTP_NO_CONTENT
        );
    }
}

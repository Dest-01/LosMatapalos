<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Return the user data
     *
     * @return \Illuminate\Http\Response
     */
    public function perfil()
    {
        $response = [
            'success' => true,
            'data'    => auth('api')->user(),
            'message' => 'Perfil Usuario',
        ];
        return response()->json($response, 200);
    }


    /**
     * Update the profile by users
     *
     * @param  \App\Http\Requests\Users\ProfileUpdateRequest  $request
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function actualizarPerfil(ProfileUpdateRequest $request)
    {
        $user = auth('api')->user();

        $user->update($request->all());

        $response = [
            'success' => true,
            'data'    => $user,
            'message' => 'Perfil actualizado!',
        ];
        return response()->json($response, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\ChangePasswordRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function cambiarPassword(ChangePasswordRequest $request)
    {
        User::find(auth('api')->user()->id)->update(['password' => Hash::make($request->new_password)]);

        $response = [
            'success' => true,
            'data'    => [],
            'message' => 'Contraseña actualizada!',
        ];
        return response()->json($response, 200);
    }
}
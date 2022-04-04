<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Users\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Users\ChangePasswordRequest;
use App\Http\Requests\Users\ProfileUpdateRequest;


class UserController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        $this->middleware('auth:api');
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return $this->sendResponse($users, 'Lista de usuarios!');
    }

    public function mostrar(Request $request)
    {
        $filtro = $request->valor;

        $users = User::latest()->paginate($filtro);

        return $this->sendResponse($users, 'Lista de usuarios!');
    }

    public function list()
    {
        $users = User::get();

        return $this->sendResponse($users, 'Lista de usuarios!');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request)
    {
        $this->authorize('isAdmin');


        if ($request->image) {
            $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos ($request->image, ';')))[1])[1];
            (!file_exists(public_path().'/images/usuarios/')) ? mkdir(public_path().'/images/usuarios/',0777,true) : null;

            \Image::make($request->image)->save(public_path('images/usuarios/') . $name);
            $request->merge(['image' => $name]);

        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'image' => $request['image'],
            'password' => Hash::make($request['password']),
            'type' => $request['type'],
        ]);

        return $this->sendResponse($user, 'Usuario creado!');
    }

    /**
     * Update the resource in storage
     *
     * @param  \App\Http\Requests\Users\UserRequest  $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(UserRequest $request, $id)
    {
        $this->authorize('isAdmin');

        $user = User::findOrFail($id);


        $currentPhoto = $user->image;

        if ($request->image != $currentPhoto) {
            $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];

            \Image::make($request->image)->save(public_path('images/usuarios/') . $name);
            $request->merge(['image' => $name]);

            $userPhoto = public_path('images/usuarios/') . $currentPhoto;
            if (file_exists($userPhoto)) {
                @unlink($userPhoto);
            }
        }

        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        $user->update($request->all());

        return $this->sendResponse($user, 'Se actualizo el usuario!');
    }

    public function actualizarPerfil(ProfileUpdateRequest $request, $id)
    {
        $user = auth('api')->user();

        $user = User::findOrFail($id);

        $user->update($request->all());

        $response = [
            'success' => true,
            'data'    => $user,
            'message' => 'Perfil actualizado',
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');

        

        $user = User::findOrFail($id);
        // delete the user

        if (file_exists('images/usuarios/' . $user->image) and !empty($user->image)) {
            unlink('images/usuarios/' . $user->image);
        }

        $user->delete();

        return $this->sendResponse([$user], 'Se elimino el usuario!');
    }
}

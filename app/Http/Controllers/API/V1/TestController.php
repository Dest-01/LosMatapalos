<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\Test\TestRequest;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends BaseController
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Test $test)
    {
        $this->middleware('auth:api');
        $this->test = $test;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = $this->test->latest()->paginate(10);

        return $this->sendResponse($tests, 'Test list');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $tests = $this->test->pluck('name', 'id');

        return $this->sendResponse($tests, 'Test list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        if($request->photo){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos
            ($request->photo, ';')))[1])[1];
            
           \Image::make($request->photo)->save(public_path('images/productos/').$name);
           $request->merge(['photo' => $name]);

        }

        $tag = $this->test->create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'photo' => $request->get('photo')
        ]);
        return $this->sendResponse($tag, 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = $this->test->findOrFail($id);

        $currentPhoto = $tag->photo;


        if($request->photo != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('images/productos/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('images/productos/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }

        }

        $tag->update($request->all());

        return $this->sendResponse($tag, 'Test Information has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $this->authorize('isAdmin');

        $test = Test::FindOrFail($id);  
        if(file_exists('images/productos/'.$test->photo) AND !empty($test->photo)){ 
              unlink('images/productos/'.$test->photo);
           } 
              try{
  
                  $test->delete();
                  $bug = 0;
              }
              catch(\Exception $e){
                  $bug = $e->errorInfo[1];
              } 
              if($bug==0){
                  echo "success";
              }else{
                  echo 'error';
              }
    }
}

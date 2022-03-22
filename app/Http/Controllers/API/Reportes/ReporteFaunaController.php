<?php

namespace App\Http\Controllers\API\Reportes;


use App\Models\Fauna;
use Illuminate\Http\Request;
use DB;

class ReporteFaunaController extends BaseController
{

    protected $fauna = '';

    public function __construct(Fauna $fauna)
    {
        $this->middleware('auth:api');
        $this->fauna = $fauna;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function solo10()
    {
        $fauna = $this->fauna->latest()->paginate(10);

        return $this->sendResponse($fauna, 'Últimos 10');
    }
    public function todo()
    {
        $fauna = $this->fauna->get();

        return $this->sendResponse($fauna, 'Lista de todas las personas');
    }
    public function solo25()
    {
        $fauna = $this->fauna->latest()->paginate(25);

        return $this->sendResponse($fauna, 'Últimos 25');
    }
    public function solo50()
    {
        $fauna = $this->fauna->latest()->paginate(50);

        return $this->sendResponse($fauna, 'Últimos 50');
    }
    public function solo75()
    {
        $fauna = $this->fauna->latest()->paginate(75);

        return $this->sendResponse($fauna, 'Últimos 75');
    }
    public function solo100()
    {
        $fauna = $this->fauna->latest()->paginate(100);

        return $this->sendResponse($fauna, 'Últimos 100');
    }

}

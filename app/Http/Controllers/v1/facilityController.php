<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\facilitiesService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\facility;



class facilityController extends Controller
{


    protected $facilities;
    public function __construct(facilitiesService $service)
    {
        $this->facilities = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->facilities->getFacilities();
        return response()
            ->json($data);

    }

    public function departments(){
        $data = $this->facilities->getDepartments();
        return response()->json($data);

    }

    public function showDepartment($code){
        $data = $this->facilities->showDepartment($code);
        return response()->json($data);

    }

    public function storeDepartment(Request $request){
        $data = $this->facilities->postDepartment($request);
    }

    public function updateDepartment(Request $request,$code){
        $data = $this->facilities->putDepartment($request,$code);
        return $data;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $data = $this->facilities->storeFacilities($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = $this->facilities->showFacility($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

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
        return response()->json($data);

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
        $data = $this->facilities->createFacilities($request);
        return response()->json($data);
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
        $data = $this->facilities->updateFacility($request,$id);
        return response()->json($data);
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

    /**
     * Adds facility and managers id to pivot tables managementts.
     *
     * @param  int  $fid, $mid
     * @return \Illuminate\Http\Response
     */
    public function managerToFacility($fid,$mid){

        $data = $this->facilities->addManager($fid,$mid);
        return response()->json($data);

    }

    /**
     * Fetches all managers associated to a specific facility.
     *
     * @param  int  $id,
     * @return \Illuminate\Http\Response
     */
    public function facilitiesManagers($id){
        $data = $this->facilities->getFacilitiesManagers($id);
        return response()->json($data);
    }

    /**
     * Removes manager id and facility id references in managements table.
     *
     * @param  int  $fid,$mid
     * @return \Illuminate\Http\Response
     */
    public function facilitiesManagerRemove($fid,$mid){
        $data = $this->facilities->removeFacilitiesManager($fid,$mid);
        return response()->json($data);
    }


    public function facilitiesManagerRemoveAll($fid){
        $data = $this->facilities->removeFacilitiesManagerAll($fid);
        return response()->json($data);
    }

    public function facilitiesWithManager(){
        $data = $this->facilities->facilitiesWithManager();
        return response()->json($data);
    }


}

<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\activityService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class activityController extends Controller
{
    protected $activites;
    public function __construct(activityService $service)
    {
        $this->activites = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->activites->getActivities();
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
        $data = $this->activites->storeActivity($request);
        return response()->json($data);

    }

    public function counselorApproved($id)
    {
        $data = $this->activites->counselorApproved($id);
        return response()->json($data);
    }

    public function counselorDenied($id)
    {
        $data = $this->activites->counselorDenied($id);
        return response()->json($data);
    }

    public function managerApproved($id)
    {
        $data = $this->activites->managerApproved($id);
        return response()->json($data);
    }

    public function managerDenied($id)
    {
        $data = $this->activites->managerDenied($id);
        return response()->json($data);
    }

    public function adminApproved($id)
    {
        $data = $this->activites->adminApproved($id);
        return response()->json($data);
    }

    public function adminDenied($id)
    {
        $data = $this->activites->adminDenied($id);
        return response()->json($data);
    }

    public function hasFood(Request $request,$id)
    {
        $data = $this->activites->hasFood($request,$id);
        return response()->json($data);
    }

    public function updateType(Request $request,$id){
        $data = $this->activites->updateType($request,$id);
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
        $data = $this->activites->getActivity($id);
        return response()->json($data);
    }

    public function showByUserEmail($email){
        $data = $this->activites->getActivityByUser($email);
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

    public function countPending(){

        $data = $this->activites->getPending();
        return response()->json($data);

    }

    public function countApproved(){
        $data = $this->activites->getApproved();
        return response()->json($data);

    }

    public function countDenied(){
        $data = $this->activites->getDenied();
        return response()->json($data);
    }

    public function getTypes(){
        $data = $this->activites->getTypes();
        return response()->json($data);
    }



}

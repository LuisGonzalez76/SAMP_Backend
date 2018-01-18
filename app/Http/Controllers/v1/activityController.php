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

    public function storeByAdmin(Request $request){
        $data = $this->activites->storeByAdmin($request);
        return response()->json($data);
    }

    public function counselorApproved(Request $request,$id)
    {
        $data = $this->activites->counselorApproved($request,$id);
        return response()->json($data);
    }

    public function counselorDenied(Request $request,$id)
    {
        $data = $this->activites->counselorDenied($request,$id);
        return response()->json($data);
    }

    public function managerApproved(Request $request,$id)
    {
        $data = $this->activites->managerApproved($request,$id);
        return response()->json($data);
    }

    public function managerDenied(Request $request,$id)
    {
        $data = $this->activites->managerDenied($request,$id);
        return response()->json($data);
    }

    public function adminApproved(Request $request,$id)
    {
        $data = $this->activites->adminApproved($request,$id);
        return response()->json($data);
    }

    public function adminDenied(Request $request,$id)
    {
        $data = $this->activites->adminDenied($request,$id);
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

    public function countPending(Request $request){

        $data = $this->activites->getPending($request);
        return response()->json($data);

    }

    public function countApproved(Request $request){
        $data = $this->activites->getApproved($request);
        return response()->json($data);

    }

    public function countDenied(Request $request){
        $data = $this->activites->getDenied($request);
        return response()->json($data);
    }

    public function getTypes(){
        $data = $this->activites->getTypes();
        return response()->json($data);
    }

    public function report(Request $request){
        $data = $this->activites->getReport($request);
        return response()->json($data);

    }

    public function FacilityRequests(Request $request){
        $data = $this->activites->getRequested($request);
        return response()->json($data);
    }

    public function ActivitiesStatus(Request $request){
        $data = $this->activites->getStatuses($request);
        return response()->json($data);
    }

    public function activityByOrg($id){
        $data = $this->activites->activityByOrg($id);
        return response()->json($data);
    }

    public function activityByFacility($id){
        $data = $this->activites->activityByFacility($id);
        return response()->json($data);
    }

    public function updateType(Request $request,$id){
        $data = $this->activites->changeType($request,$id);
        return response()->json($data);
    }




}

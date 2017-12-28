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


}

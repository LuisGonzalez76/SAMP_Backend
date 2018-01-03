<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\userService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class staffController extends Controller
{
    protected $staff;
    public function __construct(userService $service)
    {
        $this->staff = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    public function staffIndex(){
        $data = $this->staff->getStaffs();

        return response()->json($data);
    }

    public function adminIndex(){
        $data = $this->staff->getAdmins();

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
    public function storeStaff(Request $request)
    {
        //
        $data = $this->staff->storeStaff($request);

        return response()->json($data);
    }

    public function storeAdmin(Request $request)
    {
        //
        $data = $this->staff->storeAdmin($request);

        return response()->json($data);
    }

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

    }

    public function showStaff($id)
    {
        //
        $data = $this->staff->getStaff($id);

        return response()->json($data);
    }

    public function showAdmin($id)
    {
        //
        $data = $this->staff->getAdmin($id);

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
        $data = $this->staff->updateStaff($request,$id);

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
}

<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\organizationsService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;



class organizationController extends Controller
{

    protected $organizations;

    public function __construct(organizationsService $service)
    {
        $this->organizations = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->organizations->getOrganizations();

        return response()->json($data);
    }

    public function allOrganizationTypes()
    {
        $data = $this->organizations->getOrganizationTypes();
        return response()->json($data);

    }

    public function showOrganizationType($code){
        $data = $this->organizations->showOrganizationType($code);
        return response()->json($data);
    }

    public function storeOrganizationType(Request $request){
        $data = $this->organizations->postOrganizationType($request);
        return response()->json($data);

    }

    public function updateOrganizationType(Request $request, $code){
        $data = $this->organizations->putOrganizationType($request,$code);
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
        $data = $this->organizations->storeOrganization($request);

        return response()->json($data);

    }

    public function getByUser($email)
    {
        //
        $data = $this->organizations->getOrganizationsByUser($email);

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
        $data = $this->organizations->showOrganization($id);
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

        $data = $this->organizations->updateOrganization($request,$id);
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

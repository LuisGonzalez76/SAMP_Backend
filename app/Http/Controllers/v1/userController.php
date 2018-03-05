<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\userService;
use App\user;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class userController extends Controller
{
    protected $users;
    public function __construct(userService $service)
    {
        $this->users = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->users->getUsers();
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
    public function show($email)
    {
        //
        $data = $this->users->getUser($email);
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

    public function sendEmailCM($email){
        $user = user::where('userEmail',$email)->get()->first();

        Mail::send('emails.test',[],
            function ($message) use ($user)
            {
                $message->from('dsca.uprm@gmail.com','DSCA');
                $message->to($user->userEmail)->subject('Notificación de Actividad Pendiente');
            });
        return response()->json(['message' => 'Request completed']);
    }

    public function sendEmailStudentAp($email){

        $user = user::where('userEmail',$email)->get()->first();
        Mail::send('emails.studentAp',[],
            function ($message) use ($user)
            {
                $message->from('dsca.uprm@gmail.com','DSCA');
                $message->to($user->userEmail)->subject('Notificación de Actividad Aprobada');
            });
        return response()->json(['message' => 'Request completed']);
    }

    public function sendEmailStudentDen($email){
        $user = user::where('userEmail',$email)->get()->first();

        Mail::send('emails.studentDen',[],
            function ($message) use ($user)
            {
                $message->from('dsca.uprm@gmail.com','DSCA');
                $message->to($user->userEmail)->subject('Notificación de Actividad Rechazada');
            });
        return response()->json(['message' => 'Request completed']);
    }

    public function sendEmailText($email){

        $user = user::where('userEmail', $email)->get()->first();

        Mail::send('welcome',[],
            function ($message) use ($user)
            {
                $message->from('dsca.uprm@gmail.com','DSCA');
                $message->to($user->userEmail)->subject('Notificación de Actividad Rechazada');
            });

        //        Mail::raw('Text to e-mail', function ($message) use ($user) {
        //            $message->from('dsca.uprm@gmail.com','DSCA');
        //            $message->to($user->userEmail)->subject('Notificación de Actividad Rechazada');
        //        });
        return response()->json(['message' => 'Request completed']);
    }
}

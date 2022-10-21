<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvisionServer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function verify(Request $request)
    {
        $data = DB::connection('mysql')->table('usuarios')->where('nom_user','=',$request['email'])->first();
        if($data == null){
            return redirect('/')->with('alerts', 'El usuario no existe');
        }else{
            return redirect('/dashboard');
        }   
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\District;


/**
 * Class AppController
 *
 * @package App\Http\Controllers
 */
class AppController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getStates() {
        return State::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDistricts($id){
        return District::where('state_id', $id)->get();
    }
}

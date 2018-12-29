<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\District;


class AppController extends Controller
{
    public function getStates() {
        return State::all();
    }

    public function getDistricts($id){
        return District::where('state_id', $id)->get();
    }
}

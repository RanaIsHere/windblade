<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulationController extends Controller
{
    /**
     * Return the view of the simulation page with page_name passed in.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('simulation.index', ['page_name' => 'Simulation']);
    }
}

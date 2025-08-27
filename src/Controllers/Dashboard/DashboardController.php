<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Index function
     *
     * @return void
     */
    public function index()
    {
        $this->view('user.dashboard.index');
    }

    /**
     * Get for profile requests
     *
     * @return array request
     */
    public function show()
    {
        // get balance from current user in session and store
        $res = 0;
        // return response
        echo $res;
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
{
    public function add($name,$cnp)
    {
        $cnp = (int)$cnp;

        DB::insert("INSERT INTO `customers` (`name`,`cnp`) VALUES (?,?)",[$name,$cnp]);

        echo DB::connection()->getPdo()->lastInsertId();

    }
}

<?php


namespace biscuit\package\Http\Controllers;


use Illuminate\Routing\Controller;

class testController extends Controller
{
    public function index()
    {
        return 'from controller';
    }
}
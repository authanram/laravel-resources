<?php

namespace Resources\Http\Controllers;

class ResourcesController extends Controller
{
    public function index(): string
    {
        return __CLASS__ . '@' . __FUNCTION__;
    }
}

<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    public function show()
    {
        return response()->json(
            ['number' => rand(request('max'), request('min'))
        ]
        );
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RubricController;
use Illuminate\Http\Request;

class ClientRubricController extends Controller
{
    public function index(Request $request)
    {
        return (new RubricController)->index($request, 'pages.client.rubric.index');
    }

    public function show(int $id)
    {
        return (new RubricController)->show($id, 'pages.client.rubric.show');
    }
}

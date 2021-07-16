<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;

class AboutsController extends Controller
{
    public function show(About $about)
    {
        return AboutResource::make($about);
    }
}

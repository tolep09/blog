<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\ApiResponseController;

class CategoryController extends ApiResponseController
{
    public function all()
    {
        return $this->successResponse(Category::all());
    }

    public function index()
    {
        return $this->successResponse(Category::paginate(10));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\HotelPhoto;
use Illuminate\Http\Request;
use App\Services\PhotoService;


class HotelPhotoController extends Controller
{
    public function __construct(private PhotoService $PhotoService)
    {
        $this->PhotoService = $PhotoService;
    }

    public function storeFile(Request $request)
    {
        $photo = $this->PhotoService->storeFile($request);
        return response()->json($photo);
    }
}

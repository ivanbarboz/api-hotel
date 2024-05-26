<?php

namespace App\Http\Controllers;

use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use App\Models\HotelPhoto;
use App\Services\HotelService;
use App\Services\PhotoService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function __construct(private HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index()
    {
        $hotels = Hotel::all();
        return HotelResource::collection($hotels);
    }
    
    public function create(Request $request)
    {
        $request->validate([
            // Validación de otros campos del hotel
            'hotel_fotos' => 'required|array',
            'hotel_fotos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Utilizar el servicio para crear el hotel y cargar las fotos
        $hotel = $this->hotelService->createHotelWithPhotos($request->all());
        return response()->json(['message' => 'Hotel y fotos creados correctamente.', 'hotel' => $hotel]);
    }



    public function update(Hotel $hotel, Request $request)
    {
        $hotel->update($request->all());
        return response()->json(['reponse' => 'hotel actaulizado correctamente']);
    }

    public function delete(Hotel $hotel)
    {
        $hotel->delete();
        return response()->json(['response' => 'hotel eliminado correctamente']);
    }


    /*
    public function actualizar($id, Request $request)
    {
        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['error' => 'Hotel no encontrado'], 404);
        }
        $hotel->fill($request->all());
        $hotel->save();
        return response()->json(['response' => 'Hotel actualizado correctamente']);
    }*/
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use App\Models\HotelPhoto;
use App\Services\HotelService;
use App\Services\PhotoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    
    public function store(Request $request)
    {
        $hotel = Hotel::create($request->all());
        foreach ($request->photos as $base64Photo) {
            $decodedImage = base64_decode($base64Photo);
            $fileName = uniqid() . '.jpg'; // Usa una extensión válida (ajústala según el tipo de imagen)

            Storage::put('public/hotels/' . $fileName, $decodedImage);
            HotelPhoto::create([
                'uri' => 'hotels/' . $fileName, // Almacena solo la ruta relativa
                'hotel_id' => $hotel->id
            ]);
        }

        return response()->json(['hotel' => $hotel, 'message' => 'Hotel creado con éxito'], 201);
    }



    public function create(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'address' => 'required|string|max:255',
        'price' => 'required|numeric',
        'roomType' => 'required|string|max:255',
        'phoneNumber' => 'required|string|max:20',
        'department_id' => 'required|integer|exists:departments,id',
        'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar archivos de imagen
    ]);

    $hotel = Hotel::create($request->all());

    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            $filePath = $photo->store('public/hotels');
            $fileName = basename($filePath);

            HotelPhoto::create([
                'uri' => 'hotels/' . $fileName,
                'hotel_id' => $hotel->id
            ]);
        }
    }

    return response()->json(['hotel' => $hotel, 'message' => 'Hotel creado con éxito'], 201);
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

<?php
namespace App\Services;

use App\Models\Hotel;
use App\Models\HotelPhoto;

class HotelService{

    public function create(array $data)
    {
        $hotel = Hotel::create($data);
        return response()->json($hotel);
    }


    public function createHotelWithPhotos($data)
{
    // Crear el hotel con los nuevos campos
    $hotel = Hotel::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'address' => $data['address'],
        'price' => $data['price'],
        'roomType' => $data['roomType'],
        'phoneNumber' => $data['phoneNumber'],
        'department_id' => $data['department_id'],
    ]);

    // Subir las fotos y guardar las rutas en la base de datos
    foreach ($data['hotel_fotos'] as $foto) {
        $uri = $foto->store('hotels/public');
        HotelPhoto::create([
            'uri' => $uri,
            'hotel_id' => $hotel->id,
        ]);
    }

    return $hotel;
}


    

}
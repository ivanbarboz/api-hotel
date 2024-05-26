<?php
namespace App\Services;
use App\Models\HotelPhoto;
use Illuminate\Http\Request;

class PhotoService{
    public function storeFile(Request $request)
    {
        $photo = $request->file('photo');
        $filename = $photo->getClientOriginalName();

        $photo->storeAs('hotels', $filename, 'public');

        $hotelPhoto = HotelPhoto::create([
            'uri' => 'hotels/' . $filename,
            'hotel_id' => $request->hotel_id,
        ]);

        return response()->json(['exito' => $hotelPhoto->id]);
    }
}
?>
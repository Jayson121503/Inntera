<?php

namespace App\Http\Controllers;

use App\Http\Traits\FiltersFillableData;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    use FiltersFillableData;

    /**
     * List hotels with counts and room types.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Hotel::query();

        if ($request->has('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        $hotels = $query
            ->withCount(['rooms', 'bookings'])
            ->with('roomTypes:room_type_id,hotel_id,name,base_price,max_occupancy,bed_type')
            ->get();

        return response()->json(['success' => true, 'data' => $hotels]);
    }

    /**
     * Show a single hotel with full details.
     *
     * Optimized: Removed redundant `rooms.roomType` eager load —
     * room type data is already available via `roomTypes` relation.
     * Clients can join rooms to their types using room_type_id.
     */
    public function show(Hotel $hotel): JsonResponse
    {
        $hotel->load([
            'roomTypes.amenities',
            'roomTypes.rates',
            'rooms:room_id,hotel_id,room_type_id,room_number,floor,status,notes',
            'staff.user:id,name,email',
        ]);

        return response()->json(['success' => true, 'data' => $hotel]);
    }

    /**
     * Create a new hotel.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'star_rating' => 'nullable|integer|min:1|max:5',
            'image_url' => 'nullable|string',
            'opens_at' => 'nullable|string|max:100',
            'closes_at' => 'nullable|string|max:100',
        ]);

        $hotel = Hotel::create(array_merge($validated, [
            'display_id' => 'HTL-' . strtoupper(bin2hex(random_bytes(4))),
            'country' => $validated['country'] ?? 'Philippines',
            'email' => $validated['email'] ?? 'contact@hotel.com',
            'total_rooms' => 0,
            'available_rooms' => 0,
        ]));

        // Create Default Room Types for the new hotel
        $defaultTypes = [
            ['name' => 'Standard Single (1st Floor)', 'base_price' => 1200, 'max_occupancy' => 1, 'bed_type' => 'Single'],
            ['name' => 'Standard Double (2nd Floor)', 'base_price' => 2500, 'max_occupancy' => 2, 'bed_type' => 'Double'],
            ['name' => 'Deluxe Double (3rd Floor)', 'base_price' => 4500, 'max_occupancy' => 2, 'bed_type' => 'Double'],
            ['name' => 'Executive Suite (4th Floor)', 'base_price' => 12000, 'max_occupancy' => 4, 'bed_type' => 'Double'],
        ];

        foreach ($defaultTypes as $type) {
            $hotel->roomTypes()->create(array_merge($type, [
                'description' => "Standard default {$type['name']} for {$hotel->name}",
            ]));
        }

        return response()->json(['success' => true, 'data' => $hotel->load('roomTypes')], 201);
    }

    /**
     * Update a hotel.
     */
    public function update(Request $request, Hotel $hotel): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'address' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'sometimes|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'phone' => 'sometimes|string|max:255',
            'email' => 'nullable|email|max:255',
            'star_rating' => 'nullable|integer|min:1|max:5',
            'image_url' => 'nullable|string',
            'opens_at' => 'nullable|string|max:100',
            'closes_at' => 'nullable|string|max:100',
            'total_rooms' => 'sometimes|integer|min:0',
            'available_rooms' => 'sometimes|integer|min:0',
        ]);

        $hotel->update($this->filterUpdateData($validated));

        return response()->json(['success' => true, 'data' => $hotel->refresh()]);
    }

    /**
     * Delete a hotel.
     */
    public function destroy(Hotel $hotel): JsonResponse
    {
        $hotel->delete();

        return response()->json(['success' => true, 'message' => 'Hotel deleted']);
    }
}

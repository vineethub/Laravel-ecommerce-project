<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses()->orderByDesc('created_at')->get();

        return AddressResource::collection($addresses);
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        $address = Address::create([
            'user_id' => Auth::id(),
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
        ]);

        return new AddressResource($address);
    }

    public function show(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return new AddressResource($address);
    }

    public function update(Request $request, Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'address_line_1' => 'sometimes|required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'state' => 'sometimes|required|string|max:255',
            'postal_code' => 'sometimes|required|string|max:20',
            'country' => 'sometimes|required|string|max:255',
        ]);

        $address->update($request->only([
            'address_line_1',
            'address_line_2',
            'city',
            'state',
            'postal_code',
            'country',
        ]));

        return new AddressResource($address);
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $address->delete();

        return response()->json(['message' => 'Address deleted']);
    }
}

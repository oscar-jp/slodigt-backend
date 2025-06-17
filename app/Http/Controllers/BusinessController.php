<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    /**
     * Listar negocios disponibles.
     */
    public function index()
    {
        $businesses = Business::all();

        return response()->json(['businesses' => $businesses]);
    }

    /**
     * Mostrar un negocio en particular.
     */
    public function show(Business $business)
    {
        $this->authorize('view', $business);

        return response()->json(['business' => $business]);
    }

    /**
     * Registrar un nuevo negocio para el usuario autenticado.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Business::class);

        $data = $request->validate([
            'name'          => 'required|string|max:100',
            'description'   => 'nullable|string',
            'logo_url'      => 'nullable|string|max:255',
            'address1'      => 'nullable|string|max:255',
            'address2'      => 'nullable|string|max:255',
            'city_id'       => 'nullable|exists:cities,id',
            'region_id'     => 'nullable|exists:regions,id',
            'country_id'    => 'nullable|exists:countries,id',
            'latitude'      => 'nullable|numeric|between:-90,90',
            'longitude'     => 'nullable|numeric|between:-180,180',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'website_url'   => 'nullable|url',
        ]);

        $data['user_id'] = $request->user()->id;
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(5);

        $business = Business::create($data);

        return response()->json(['business' => $business], 201);
    }

    /**
     * Actualizar información de un negocio existente.
     */
    public function update(Request $request, Business $business)
    {
        $this->authorize('update', $business);

        $data = $request->validate([
            'name'          => 'sometimes|string|max:100',
            'description'   => 'nullable|string',
            'logo_url'      => 'nullable|string|max:255',
            'address1'      => 'nullable|string|max:255',
            'address2'      => 'nullable|string|max:255',
            'city_id'       => 'nullable|exists:cities,id',
            'region_id'     => 'nullable|exists:regions,id',
            'country_id'    => 'nullable|exists:countries,id',
            'latitude'      => 'nullable|numeric|between:-90,90',
            'longitude'     => 'nullable|numeric|between:-180,180',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'website_url'   => 'nullable|url',
        ]);

        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']).'-'.Str::random(5);
        }

        $business->update($data);

        return response()->json(['business' => $business]);
    }
}

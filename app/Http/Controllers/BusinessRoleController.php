<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessUserRole;
use Illuminate\Http\Request;

class BusinessRoleController extends Controller
{
    public function store(Request $request, Business $business)
    {
        $this->authorize('update', $business);

        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:manager,staff',
        ]);

        $role = BusinessUserRole::updateOrCreate(
            ['business_id' => $business->id, 'user_id' => $data['user_id']],
            ['role' => $data['role']]
        );

        return response()->json(['role' => $role], 201);
    }

    public function update(Request $request, Business $business, BusinessUserRole $role)
    {
        $this->authorize('update', $business);

        if ($role->business_id !== $business->id) {
            abort(404);
        }

        $data = $request->validate([
            'role' => 'required|in:manager,staff',
        ]);

        $role->update($data);

        return response()->json(['role' => $role]);
    }

    public function destroy(Request $request, Business $business, BusinessUserRole $role)
    {
        $this->authorize('update', $business);

        if ($role->business_id !== $business->id) {
            abort(404);
        }

        $role->delete();

        return response()->json([], 204);
    }
}

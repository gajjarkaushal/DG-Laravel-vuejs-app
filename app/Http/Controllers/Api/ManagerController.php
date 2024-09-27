<?php

namespace App\Http\Controllers\Api;

use App\Models\Manager; // Make sure you have this model
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ManagerController extends Controller
{
    public function index()
    {
        return Manager::all(); // Get all managers
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:managers,email',
                'role' => 'required|string|in:Editor,Administrator',
                'status' => 'required|string|in:Pending,Active,Disabled',
            ]);

            $manager = Manager::create($validated); // Create a new manager

            return response()->json($manager, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        return Manager::findOrFail($id); // Get a specific manager
    }

    public function update(Request $request, $id)
    {
        $manager = Manager::findOrFail($id); // Find the manager by ID

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|string|in:Editor,Administrator',
            'status' => 'required|string|in:Pending,Active,Disabled',
        ]);

        $manager->update($validated); // Update the manager

        return response()->json($manager, 200);
    }

    public function destroy($id)
    {
        $manager = Manager::findOrFail($id); // Find the manager by ID
        $manager->delete(); // Delete the manager

        return response()->json(null, 204);
    }
}

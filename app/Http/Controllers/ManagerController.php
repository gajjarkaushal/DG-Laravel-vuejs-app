<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = Manager::all();
        return Inertia::render('Manager/Manager', compact('managers'));
    }

    public function create()
    {
        return Inertia::render('Manager/Managers/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:managers',
            'phone' => 'nullable|string|max:15',
        ]);

        Manager::create($request->all());
        return redirect()->route('managers.index')->with('success', 'Manager created successfully.');
    }

    public function edit(Manager $manager)
    {
        return Inertia::render('Managers/Edit', compact('manager'));
    }

    public function update(Request $request, Manager $manager)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:managers,email,' . $manager->id,
            'phone' => 'nullable|string|max:15',
        ]);

        $manager->update($request->all());
        return redirect()->route('managers.index')->with('success', 'Manager updated successfully.');
    }

    public function destroy(Manager $manager)
    {
        $manager->delete();
        return redirect()->route('managers.index')->with('success', 'Manager deleted successfully.');
    }
}

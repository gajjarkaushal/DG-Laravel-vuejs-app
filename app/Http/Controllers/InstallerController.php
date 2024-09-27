<?php 

namespace App\Http\Controllers;

use App\Models\Installer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class InstallerController extends Controller
{
    public function index()
    {
        $installers = Installer::all();
        return Inertia::render('Installers/Installers', [
            'installers' => $installers,
        ]);
    }
    public function Create()
    {
        return Inertia::render('Installers/InstallerForm');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'website_url' => 'nullable|url',
            'address_1' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'status' => 'required|in:Pending,Active,Disabled',
        ]);

        $validated['url'] = Str::slug($request->business_name); // Auto-generate URL

        $installer = Installer::create($validated);

        return redirect()->route('installers.index')->with('success', 'Installer created successfully.');
    }

    public function show($id)
    {
        $installer = Installer::findOrFail($id);
        return Inertia::render('InstallerEdit', [
            'installers' => $installer,
        ]);
    }

    public function update(Request $request, $id)
    {
        $installer = Installer::findOrFail($id);

        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'website_url' => 'nullable|url',
            'address_1' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'status' => 'required|in:Pending,Active,Disabled',
        ]);

        $validated['url'] = Str::slug($request->business_name); // Auto-generate URL

        $installer->update($validated);

        return redirect()->route('installers.index')->with('success', 'Installer updated successfully.');
    }

    public function destroy($id)
    {
        $installer = Installer::findOrFail($id);
        $installer->delete();

        return redirect()->route('installers.index')->with('success', 'Installer deleted successfully.');
    }
}

?>
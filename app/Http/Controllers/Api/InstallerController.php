<?php 

namespace App\Http\Controllers\Api;

use App\Models\Installer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class InstallerController extends Controller
{
    public function index()
    {
        return Installer::all();
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'business_name' => 'required|string|max:255',
                'email' => 'required|email|unique:installers,email',
                'phone_number' => 'required|string|max:20',
                'website_url' => 'nullable|url',
                'address_1' => 'required|string',
                'city' => 'required|string',
                'postcode' => 'required|string',
                'status' => 'required|in:Pending,Active,Disabled',
            ]);

            $validated['url'] = Str::slug($request->business_name); // Auto-generate URL from business name

            $installer = Installer::create($validated);

            return response()->json($installer, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        return Installer::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $installer = Installer::findOrFail($id);

        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|numeric|digits_between:11,17',
            'website_url' => 'nullable|url',
            'address_1' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'status' => 'required|in:Pending,Active,Disabled',
        ]);

        $validated['url'] = Str::slug($request->business_name); // Auto-generate URL from business name

        $installer->update($validated);

        return response()->json($installer, 200);
    }

    public function destroy($id)
    {
        $installer = Installer::findOrFail($id);
        $installer->delete();

        return response()->json(null, 204);
    }
}
?>
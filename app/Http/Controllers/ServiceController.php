<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }

    public function show($id)
    {
        // Retrieve a single service by
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        return response()->json($service);
    }

    public function findByName(Request $request)
    {
        // Get the 'name' parameter from the query string
        $name = $request->input('name');
        
        // Check if 'name' is provided
        if (!$name) {
            return response()->json(['message' => 'Please provide a service name'], 400);
        }

        // Perform the search by name, using 'LIKE' for partial matching
        $services = Service::where('name', 'like', '%' . $name . '%')->get();

        // If no services found, return a 404 response
        if ($services->isEmpty()) {
            return response()->json(['message' => 'No services found with that name'], 404);
        }

        // Return the found services as a JSON response
        return response()->json($services);
    }
}

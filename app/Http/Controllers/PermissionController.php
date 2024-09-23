<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function managePermission()
    {
        // This should be called only once or as part of a seeder.
        $this->seedPermissions();
    }

    private function seedPermissions()
    {
        // Create roles and permissions logic here (as shown above).
    }

    public function checkAdmin()
    {
        $user = Auth::user();
    
        if ($user && $user->hasRole('admin')) {
            return response()->json(['message' => 'User is an admin']);
        }
    
        return response()->json(['message' => 'Access denied'], 403);
    }
    
    public function getUserPermissions()
    {
        $user = Auth::user();
    
        if ($user) {
            $permissions = $user->getAllPermissions()->pluck('name');
            return response()->json($permissions);
        }
    
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    
}

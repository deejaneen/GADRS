<?php

namespace App\Http\Controllers;

use App\Models\DateRestriction;
use App\Models\DormCart;
use App\Models\Gym;
use App\Models\GymCart;
use App\Models\Dorm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gymsPendingCount = Gym::where('status', 'Pending')->count();
        $dormsPendingCount = Dorm::where('status', 'Pending')->count();
        $totalPendingCount = $gymsPendingCount + $dormsPendingCount;

        $gymsForPaymentCount = Gym::where('status', 'For Payment')->count();
        $dormsForPaymentCount = Dorm::where('status', 'For Payment')->count();
        $totalForPaymentCount = $gymsForPaymentCount + $dormsForPaymentCount;

        $gymsReservedCount = Gym::where('status', 'Reserved')->count();
        $dormsReservedCount = Dorm::where('status', 'Reserved')->count();
        $totalReservedCount = $gymsReservedCount + $dormsReservedCount;

        return view('admin.admindashboard', [
            'gymsPendingCount' => $gymsPendingCount,
            'dormsPendingCount' => $dormsPendingCount,
            'totalPendingCount' => $totalPendingCount,
            'gymsForPaymentCount' => $gymsForPaymentCount,
            'dormsForPaymentCount' => $dormsForPaymentCount,
            'totalForPaymentCount' => $totalForPaymentCount,
            'gymsReservedCount' => $gymsReservedCount,
            'dormsReservedCount' => $dormsReservedCount,
            'totalReservedCount' => $totalReservedCount
        ]);
    }

    public function test()
    {
        return view('admin.test');
    }

    public function users()
    {
        $users = User::where('role', '!=', 'Admin')->get();
        return view('admin.adminuser', ['users' => $users]);
    }

    public function updateUser(User $user)
    {
        // Validate input
        $validated = request()->validate([
            'first_name' => 'required|min:3|max:40',
            'middle_name' => 'required|min:1|max:255',
            'last_name' => 'required|min:1|max:255',
            'contact_number' => 'nullable|min:1|max:255',
            'email' => 'required|email',
            'role' => 'required',
            // 'profile_image' => 'image',
        ]);

        // Update the user with the validated data
        $user->update($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'User updated successfully!');
    }

    public function editUser(Request $request)
    {
        $userId = $request->query('id'); // Use query() to retrieve the id parameter
        $user = User::findOrFail($userId); // Assuming you have a User model

        // You can return the modal content as a view
        return view('admin.adminedituser', compact('user'));
    }


    public function reservations()
    {
        $gymDateRestrictions = DateRestriction::where('type', 'Gym')->get();
        $dormDateRestrictions = DateRestriction::where('type', 'Dorm')->get();

        return view('admin.adminreservation', [
            'gymDateRestrictions' => $gymDateRestrictions,
            'dormDateRestrictions' => $dormDateRestrictions
        ]);
    }
    public function gym()
    {
        $gyms = Gym::all();
        $carts = GymCart::all();

        return view('admin.admingym', ['gyms' => $gyms, 'carts' => $carts]);
    }

    public function dorm()
    {
        $dorms = Dorm::all();
        $carts = DormCart::all();

        return view('admin.admindorm', ['dorms' => $dorms, 'carts' => $carts]);
    }
    public function profile()
    {
        return view('admin.adminprofile');
    }

    public function showUser()
    {
    }

    public function destroyUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function destroyDateRestriction($id)
    {
        $dateRestriction = DateRestriction::where('id', $id)->first();
        $dateRestriction->delete();

        return redirect()->back()->with('success', 'Date deleted successfully!');
    }


    public function storeDateRestriction(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'dateRestriction' => 'required|date',
            'type' => 'required', // Add validation for 'type'
        ]);

        try {
            // Check if a record with the same type and date restriction already exists
            $existingRecord = DateRestriction::where('type', $validatedData['type'])
                ->where('restricted_date', $validatedData['dateRestriction'])
                ->first();

            // If a record already exists, display error message
            if ($existingRecord) {
                return redirect()->back()->with('error', 'Date Restriction already exists for the specified type and date.');
            }

            // Store the date restriction in the database
            $dateRestriction = new DateRestriction();
            $dateRestriction->restricted_date = $validatedData['dateRestriction'];
            $dateRestriction->description = $request->details;
            $dateRestriction->type = $validatedData['type'];
            $dateRestriction->save();

            // If storing is successful, redirect back with success message
            return redirect()->back()->with('success', 'Date Restriction added successfully!');
        } catch (\Exception $e) {
            // If an error occurs during the storing process, redirect back with error message
            return redirect()->back()->with('error', 'Date Restriction was not successful');
        }
    }
}

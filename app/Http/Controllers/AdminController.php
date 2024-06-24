<?php

namespace App\Http\Controllers;

use App\Models\DateRestriction;
use App\Models\DormCart;
use App\Models\Gym;
use App\Models\GymCart;
use App\Models\Dorm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
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
        return redirect()->route('adminusers')->with('success', 'User updated successfully!');
    }

    public function editUser(User $user)
    {
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

    public function storeUser()
    {
        //validate
        $validated = request()->validate([
            'last_name' => 'required|min:3|max:40',
            'first_name' => 'required|min:3|max:40',
            'middle_name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        try {
            //create the user
            $user = User::create([
                'last_name' => $validated['last_name'],
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->save();

            //redirect to dashboard
            return redirect()->back()->with('success', "User created successfully!");
        } catch (\Exception $e) {
            // If an error occurs during user creation, redirect back with error message
            return redirect()->back()->withInput()->withErrors(['error' => 'User creation failed.'])->withInput();
        }
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

            // Check for existing reservations based on the type
            if ($validatedData['type'] === 'Gym') {
                $checkDate = Gym::where('reservation_date', $validatedData['dateRestriction'])
                    ->whereIn('status', ['Reserved', 'Received'])
                    ->exists();
            } elseif ($validatedData['type'] === 'Dorm') {
                $checkDate = Dorm::where('reservation_start_date', '<=', $validatedData['dateRestriction'])
                    ->where('reservation_end_date', '>=', $validatedData['dateRestriction'])
                    ->whereIn('status', ['Reserved', 'Received'])
                    ->exists();
            } else {
                return redirect()->back()->with('error', 'Invalid type specified.');
            }

            // If there are existing reservations, redirect with error message
            if ($checkDate) {
                return redirect()->back()->with('error', 'Date Restriction overlaps with existing reservations.');
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

    public function updatePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password matches the one provided
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();


        return redirect()->route('adminprofile')->with('success', 'Password updated successfully.');
    }
}

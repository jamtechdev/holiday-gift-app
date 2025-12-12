<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $usersQuery = User::where('role', 'user')->orderBy('name');

        // Full search across multiple fields
        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('street_address', 'like', "%{$search}%")
                    ->orWhere('apt_suite_unit', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('zip', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%");
            });
        }

        $users = $usersQuery->paginate(20)->withQueryString();

        // Return JSON only for actual AJAX requests (not direct URL visits with ajax=1)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('admin.users.partials.table', compact('users'))->render(),
                'pagination' => view('partials.admin.pagination', [
                    'paginator' => $users,
                    'itemLabel' => 'users'
                ])->render(),
            ]);
        }

        return view('admin.users.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'street_address' => 'nullable|string|max:255',
            'apt_suite_unit' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => trim($request->first_name . ' ' . $request->last_name), // Keep name for backward compatibility
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'street_address' => $request->street_address,
            'apt_suite_unit' => $request->apt_suite_unit,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'role' => 'user'
        ]);

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,user',
            'street_address' => 'nullable|string|max:255',
            'apt_suite_unit' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['first_name', 'last_name', 'email', 'role', 'street_address', 'apt_suite_unit', 'city', 'state', 'zip', 'country']);
        $data['name'] = trim($request->first_name . ' ' . $request->last_name); // Keep name for backward compatibility

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('status', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    public function export(Request $request)
    {
        try {
            $search = $request->query('search');
            return Excel::download(new UsersExport($search), 'users.xlsx');
        } catch (\Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Export failed: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->route('admin.users.index')
                ->with('error', 'Export failed: ' . $e->getMessage());
        }
    }

    public function importStore(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv|max:10240' // Max 10MB
            ]);

            // Import users - admin users will be skipped automatically during import
            Excel::import(new UsersImport, $request->file('file'));

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Users imported successfully!'
                ]);
            }

            return redirect()->route('admin.users.index')->with('status', 'Users imported successfully!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];

            foreach ($failures as $failure) {
                $row = $failure->row();
                $errors = $failure->errors();
                $attribute = $failure->attribute();

                foreach ($errors as $error) {
                    $errorMessages[] = "Row {$row} ({$attribute}): {$error}";
                }
            }

            $errorMessage = 'Import validation failed:<br>' . implode('<br>', $errorMessages);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 422);
            }

            return redirect()->route('admin.users.index')
                ->with('error', $errorMessage);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessage = 'Validation failed: ' . implode(', ', $e->validator->errors()->all());

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 422);
            }

            return redirect()->route('admin.users.index')
                ->withErrors($e->validator)
                ->with('error', $errorMessage);
        } catch (\Exception $e) {
            $errorMessage = 'Import failed: ' . $e->getMessage();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 500);
            }

            return redirect()->route('admin.users.index')
                ->with('error', $errorMessage);
        }
    }
}

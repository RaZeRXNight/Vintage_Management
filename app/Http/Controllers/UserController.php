<?php

namespace App\Http\Controllers;

use auth;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{   
    //-----------------------------------------------
    // User Verification
    // Verifies The User and Checks if they're an Administrator // 
    // Verifies The User // 
    public static function VerifyUser(string $Role) {
        $message = 'VERIFYING USER...';
        echo("<script>console.log('" . addslashes($message) . "')</script>");

        if (auth()->user() === null) {
            $message = 'UNABLE TO VERIFY USER...';
            echo("<script>console.log('" . addslashes($message) . "')</script>");

            return redirect('/')->with('error', 'You do not have permission to access this page.');
        }
        else {
            $message = 'VERIFIED USER...' . auth()->user()->role;
            echo("<script>console.log('" . addslashes($message) . "')</script>");

            return auth()->user()->role;
        };
    }

    public static function VerifyUser_Admin() {
        $message = 'VERIFYING...';
        echo("<script>console.log('" . addslashes($message) . "')");

        $user = self::VerifyUser();

        if ($user instanceof \Illuminate\Http\RedirectResponse) {
            return $user;
        }

        $message = 'VERIFYING...' . $user;
        echo("<script>console.log('" . addslashes($message) . "')");

        if ($user !== 'admin') {
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        };
    }

    // Verifies The User and their Product Role and Checks if they're an Administrator // 
    public static function VerifyUser_Inventory() {
        $message = 'VERIFYING...';
        echo("<script>console.log('" . addslashes($message) . "')");

        $user = self::VerifyUser();

        if ($user instanceof \Illuminate\Http\RedirectResponse) {
            return $user;
        }

        $message = 'VERIFYING...' . $user;
        echo("<script>console.log('" . addslashes($message) . "')");

        if (!($user === 'admin' || $user ===  'inventory')) {
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        };
    }

    // Verifies The User and their Sales Role and Checks if they're an Administrator // 
    public static function VerifyUser_Sales() {
        $message = 'VERIFYING...';
        echo("<script>console.log('" . addslashes($message) . "')");

        $user = self::VerifyUser();

        if ($user instanceof \Illuminate\Http\RedirectResponse) {
            return $user;
        }

        $message = 'VERIFYING...' . $user;
        echo("<script>console.log('" . addslashes($message) . "')");

        if (!($user === 'admin' || $user === 'user')) {
            return redirect('/')->with('error', 'You do not have permission to access this page.');
        };
    }

    // -----------------------------------------------
    // Laravel Automatically matches up the name of Controller, Model and Database to conduct its search.
    // User Management Routes
    // View All Users
    public function create_user_management_view() {
        self::VerifyUser_Admin();

        $users = User::all();
        return view('management.user.user_management', ['users' => $users]);
    }

    public function update_user(User $user) {
        self::VerifyUser_Admin();
        return view('management.user.update_user', ['user' => $user]);
    }

    public function view_user(User $user) {
        return view('management.user.view_user', ['user' => $user]);
    }

    public function update_user_post(Request $request, User $user) {
        self::VerifyUser_Admin();

        $incomingfields = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'min:3', 'max:30'],
            'password' => ['required', 'max: 20']
        ]);
        
        $incomingfields['password'] = bcrypt($incomingfields['password']);
        $user->update($incomingfields);
        
        return redirect('/management/user/view_user/' . $user->id);
    }

    public function create_user() {
        self::VerifyUser_Admin();
        return view('management.user.create_user');
    }

    public function store_user(Request $request) {
        self::VerifyUser_Admin();

        $incomingfields = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'min:3', 'max:50'],
            'role' => ['required', 'min:3', 'max:50'],
            'password' => ['required', 'max: 20']
        ]);
        
        $incomingfields['password'] = bcrypt($incomingfields['password']);
        $user = User::create($incomingfields);
        
        return redirect('/user_management/view_user/view_user/' . $user->id);
    }

    // Regisers the User adding their Name, Email and Password to the Database.
    public function register(Request $request) {

        // Incoming Fields will validate the information submitted in the Request, comparing it to the rules we declare.
        $incomingfields = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'min:3', 'max:30'],
            'password' => ['required', 'max: 20']
        ]);
        
        // The Password is encrpted based on the bcrypt algorithm, and passed into the database.  The Request Data is them submitted into the Database, creating a new user.
        $incomingfields['password'] = bcrypt($incomingfields['password']);
        $user = User::create($incomingfields);

        // The User is then Logged in (Method from the UserFactory.php File), using the built-in Authenitcation Method, and Redirected.
        auth()->login($user);
        
        return redirect('/');
    }

    // Logs in a user based on the email and password, using Laravel's built in Authentication methods.
    public function login(Request $request) {
        $incomingfields = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (auth()->attempt(['email' => $incomingfields['email'],'password' => $incomingfields['password']])) {
            $request->session()->regenerate();
        } 
        return redirect('/');
    }

    // Logs the User out.
    public function logout(Request $request) {
        auth()->logout();
        return redirect('/');
    }
}

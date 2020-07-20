<?php
namespace  App\Http\Controllers;

use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // MOVE THIS TO AN ADMIN PAGE... ONLY ADMINS CAN ADD USERS
    public function postSignUp(Request $request)
    {
        // this is for validating the form
        /*try { // can be used but gotta do something to print the errors on html */
            $this->validate($request, [
                'names' => 'max:120|required',
                'lastNames' => 'max:120|required',
                'type' => 'required',
                'email' => 'email|unique:users|required',
                'username' => 'max:10|required',
                'password' => 'required'
            ]);
        /*} catch (ValidationException $e) {
            return \response($e->errors(),400);
        }*/

        $lastSignIn = "2020-01-01 10:10:10";
        $names = $request['names'];
        $lastNames = $request['lastNames'];
        //$queryResult = DB::select('select * from user_types where id = :id',
        //    ['id' => $request['type']]);
        $type = UserType::find($request['type']);
        $email = $request['email'];
        $username = $request['username'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->last_sign_in = $lastSignIn;
        $user->names = $names;
        $user->last_names = $lastNames;
        $user->email = $email;
        $user->username = $username;
        $user->password = $password;

        $message = "Error desconocido!";
        // Regarding Eloquent relations (belongto) the father creates the new son
        // this is why the retrieved usertype should call its sons method (users()) and save it,
        // otherwise on a normal save, the object to save should call the save method
        // $user->save()
        if ($type->users()->save($user))
        {
            $message = "El usuario ha sido agregado exitosamente!";
        }

        return redirect()->route('users')->with(['message' => $message]);
    }

    public function postUpdateUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'names' => 'max:120',
            'lastNames' => 'max:120',
            'email' => 'email',
        ]);

        $id = $request['id'];
        $names = $request['names'];
        $lastNames = $request['lastNames'];
        $type = UserType::find($request['type']);
        $email = $request['email'];
        $password = $request['password'] ? bcrypt($request['password']) : null;

        $user = User::where('id', $id)->first();
        if ($names && $names != $user->names)
            $user->names = $names;
        if ($lastNames && $lastNames != $user->last_names)
            $user->last_names = $lastNames;
        if ($email && $email != $user->email)
            $user->email = $email;
        if ($password)
            $user->password = bcrypt($request['password']);

        // This validates if the column has changed
        //$var1 = $user->isDirty('names'); // true

        $message = "Error desconocido!";

        // Need to validate if the realtionship is modified first
        // So on one side, update as usual the user, on the other
        // use Eloquent to change the relationship between models/tables
        if ($type->id === $user->userType->id)
        {
            if($user->isDirty())
            {
                if ($user->update())
                {
                    $message = "El usuario ha sido actualizado exitosamente!";
                    return response()->json(['message' => $message, 'newNames' => $user->names,
                        'newLastNames' => $user->last_names, 'newUserTypeId' => $type->id,
                        'newUserType' => $type->name, 'newEmail' => $user->email], 200);
                }
            }
            else {
                $message = "No hay cambios en los datos! Revise que en efecto este cambiando algun dato.";
            }
        }
        else{
            // This is for a belongsTo case in which the belonged modifies to whom belongs
            $user->userType()->associate($type);
            if ($user->save())
            {
                $message = "El usuario ha sido actualizado exitosamente!";
                return response()->json(['message' => $message, 'newNames' => $user->names,
                    'newLastNames' => $user->last_names, 'newUserTypeId' => $type->id,
                    'newUserType' => $type->name, 'newEmail' => $user->email], 200);
            }
        }

        return response()->json(['message' => $message], 500);
    }

    public function getDeleteUser($userId)
    {
        $user = User::where('id', $userId)->first();

        $message = "Error desconocido!";

        if ($user->delete())
        {
            $message = "El usuario ha sido eliminado exitosamente!";
        }
        return redirect()->route('users')->with(['message' => $message]);
    }

    // this method is using laravel dependency injection automatically
    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'username' => 'max:10|required',
            //'password' => 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-6])(?=.*[\d\x])(?=.*[!$#%]).*$/|required'
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'username' => $request['username'],
            'password' => $request['password']
        ]))
        {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    public function getDashboard()
    {
        return view('dashboard');
    }

    public function getUsersView()
    {
        $users = User::all();
        $userTypes = UserType::all();
        return view('users/users', ['users' => $users,
            'userTypes' => $userTypes]);
    }
}

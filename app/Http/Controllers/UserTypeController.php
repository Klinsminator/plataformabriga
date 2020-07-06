<?php
namespace  App\Http\Controllers;

use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserTypeController extends Controller
{
    public function postCreateUserType(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:120|required'
        ]);

        $name = $request['name'];

        $userType = new UserType();
        $userType->name = $name;
        $message = "Error desconocido!";
        if ($userType->save())
        {
            $message = "El tipo de usuario ha sido agregado exitosamente!";
        }
        return redirect()->route('users')->with(['message' => $message]);
    }
}

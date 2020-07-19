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

    public function postUpdateUserType(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'max:120|required'
        ]);

        $id = $request['id'];
        $name = $request['name'];

        $userType = UserType::where('id', $id)->first();
        $userType->name = $name;

        $message = "Error desconocido!";
        if ($userType->update())
        {
            $message = "El tipo de usuario ha sido actualizado exitosamente!";
            return response()->json(['message' => $message, 'newName' => $userType->name], 200);
        }

        return response()->json(['message' => $message], 500);

    }

    public function getDeleteUserType($userTypeId)
    {
        $message = "Error desconocido!";

        // This if validates if the requested usertype related users on DB
        if (!UserType::has('users')->find($userTypeId))
        {
            if (UserType::destroy($userTypeId))
            {
                $message = "El tipo de usuario ha sido eliminado exitosamente!";
            }
        }
        else {
            $message = "El tipo de usuario aun esta ligado a uno o mas usuarios!";
        }

        return redirect()->route('users')->with(['message' => $message]);
    }
}

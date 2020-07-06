<?php
namespace  App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OfficeController extends Controller
{
    public function postCreateOffice(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:120|required',
            'phonePrimary' => 'min:8|max:12|required',
            'phoneSecondary' => 'min:8|max:12|required',
            'email' => 'email|unique:users|unique:professionals|required',
            'address' => 'max:200|required'
        ]);

        $name = $request['name'];
        $phonePrimary = $request['phonePrimary'];
        $phoneSecondary = $request['phoneSecondary'];
        $email = $request['email'];
        $address = $request['address'];

        $user = new Office();
        $user->name = $name;
        $user->phone_primary = $phonePrimary;
        $user->phone_secondary = $phoneSecondary;
        $user->email = $email;
        $user->address = $address;

        $message = "Error desconocido!";
        if ($user->save()) {
            $message = "El Consultorio ha sido agregado exitosamente!";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }
}

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

    public function postUpdateOffice(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'max:120',
            'phonePrimary' => 'min:8|max:12',
            'phoneSecondary' => 'min:8|max:12',
            'email' => 'email',
            'address' => 'max:200'
        ]);

        $id = $request['id'];
        $name = $request['name'];
        $phonePrimary = $request['phonePrimary'];
        $phoneSecondary = $request['phoneSecondary'];
        $email = $request['email'];
        $address = $request['address'];

        $office = Office::where('id', $id)->first();
        if ($name && $name != $office->name)
            $office->name = $name;
        if ($phonePrimary && $phonePrimary != $office->phone_primary)
            $office->phone_primary = $phonePrimary;
        if ($phoneSecondary && $phoneSecondary != $office->phone_secondary)
            $office->phone_secondary = $phoneSecondary;
        if ($email && $email != $office->email)
            $office->email = $email;
        if ($address && $address != $office->address)
            $office->address = $address;

        $message = "Error desconocido!";
        if($office->isDirty())
        {
            if ($office->update())
            {
                $message = "El Consultorio ha sido actualizado exitosamente!";
                return response()->json(['message' => $message, 'newName' => $office->name,
                    'newPhonePrimary' => $office->phone_primary,
                    'newPhoneSecondary' => $office->phone_secondary,
                    'newEmail' => $office->email,
                    'newAddress' => $office->address], 200);
            }
        }
        else {
            $message = "No hay cambios en los datos! Revise que en efecto este cambiando algun dato.";
        }

        return response()->json(['message' => $message], 500);

    }

    public function getDeleteOffice($officeId)
    {
        $office = Office::find($officeId);

        $message = "Error desconocido!";
        $full = 0;
        foreach ($office->professional as $ofi)
        {
            $full ++;
        }

        if($full>0)
        {
            $message = "Error, el consultorio aun se encuentra ligado a uno o mas profesionales!";
        }
        else {
            $office->professional()->detach();
            if ($office->delete())
            {
                $message = "El consultorio ha sido eliminado exitosamente!";
            }
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }
}

<?php
namespace  App\Http\Controllers;

use App\Applicant;
use App\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ApplicantController extends Controller
{
    public function postCreateApplicant(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:120|required',
            'email' => 'email|unique:applicants|required',
        ]);

        $name = $request['name'];
        $email = $request['email'];

        $applicant = new Applicant();
        $applicant->name = $name;
        $applicant->email = $email;

        $message = "Error desconocido!";
        if ($applicant->save()) {
            $message = "El Aplicante ha sido agregado exitosamente!";
        }

        return redirect()->route('applicants')->with(['message' => $message]);
    }

    public function postUpdateApplicant(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'max:120',
            'email' => 'email|unique:applicants',
        ]);

        $id = $request['id'];
        $name = $request['name'];
        $email = $request['email'];

        $applicant = Applicant::where('id', $id)->first();
        if ($name && $name != $applicant->name)
            $applicant->name = $name;
        if ($email && $email != $applicant->email)
            $applicant->email = $email;

        $message = "Error desconocido!";
        if($applicant->isDirty())
        {
            if ($applicant->update())
            {
                $message = "El Aplicante ha sido actualizado exitosamente!";
                return response()->json(['message' => $message, 'newName' => $applicant->name,
                    'newEmail' => $applicant->email], 200);
            }
        }
        else {
            $message = "No hay cambios en los datos! Revise que en efecto este cambiando algun dato.";
        }

        return response()->json(['message' => $message], 500);

    }

    public function getDeleteApplicant($applicantId)
    {
        $message = "Error desconocido!";

        if (!Applicant::has('profiles')->find($applicantId))
        {
            if (Applicant::destroy($applicantId))
            {
                $message = "El Aplicante ha sido eliminado exitosamente!";
            }
        }
        else {
            $message = "El Aplicante aun esta ligado a uno o mas usuarios!";
        }

        return redirect()->route('applicant')->with(['message' => $message]);
    }
}

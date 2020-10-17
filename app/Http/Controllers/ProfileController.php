<?php
namespace  App\Http\Controllers;

use App\User;
use App\Profile;
use App\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\Integer;

class ProfileController extends Controller
{
    public function postCreateProfile(Request $request)
    {
        /*
            State:
                0: open
                1: open and assigned to user
                2: resolved
                3: on feedback process
                4: closed
        */
        $this->validate($request, [
            'age' => 'min:0|max:99|required',
            'gender' => 'max:120|required',
            'state' => 'min:0|max:1|required',
            'applicantId' => 'required',
            'userId' => 'required'
        ]);

        $age = $request['age'];
        $gender = $request['gender'];
        $state = $request['state'];
        $applicant = Applicant::find($request['applicantId']);
        $user = User::find($request['userId']);

        $profile = new Profile();
        $profile->age = $age;
        $profile->gender = $gender;
        $profile->state = $state;

        $message = "Error desconocido!";
        if ($profile->save())
        {
            $message = " El Perfil ha sido creado exitosamente!"; 
        }

        if($applicant)
        {
            $profile->applicant()->associate($applicant);
            $message .= " El Aplicante ha sido asociado exitosamente!";
        }

        if($user)
        {
            $profile->user()->associate($user);
            $message .= " El Usuario ha sido asociado exitosamente!";
        }

        return response()->json(['message' => $message], 200);
    }

    public function postUpdateProfileState(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'state' => 'min:0|max:4|required',
        ]);

        $id = $request['id'];
        $state = $request['state'];

        $profile = Profile::where('id', $id)->first();
        if ($state && $state != $profile->state)
            $profile->state = $state;

        $message = "Error desconocido!";
        if($profile->isDirty())
        {
            if ($profile->update())
            {
                $message = "El estado del Perfil ha sido actualizado exitosamente!";
                return response()->json(['message' => $message, 'newState' => $profile->state], 200);
            }
        }
        else {
            $message = "No hay cambios en los datos! Revise que en efecto este cambiando algun dato.";
        }
    
        return response()->json(['message' => $message], 500);
    }

    public function postAssignUserToProfile(Request $request)
    {
        $this->validate($request, [
            'profileId' => 'required',
            'userId' => 'required'
        ]);

        $profileId = $request['profileId'];
        $user = User::find($request['userId']);

        $profile = Profile::where('id', $id)->first();

        $message = "Error desconocido!";
        if ($user->id !== $profile->user->id)
        {
            // This is for a belongsTo case in which the belonged modifies to whom belongs
            $profile->user()->associate($user);
            if ($profile->save())
            {
                $message = "El Perfil ha sido agregado al Usuario exitosamente!";
                return response()->json(['message' => $message, 'newNames' => $user->names], 200);
            }
        }
        else
        {
            $message = "No hay cambios en los datos! Revise que en efecto este cambiando algun dato.";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }

    public function getDashboard()
    {
        $activeProfile = Profile::whereIn('state', [0, 1, 3]);
        $inactiveProfile = Profile::whereNotIn('state', [0, 1, 3]);
        return view('dashboard', ['activeProfiles' => $activeProfile, 
            'inactiveProfiles' => $inactiveProfile]);
    }
}

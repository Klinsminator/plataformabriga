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

    public function postCreateProfileFromForm(Request $request)
    {
        //https://www.youtube.com/watch?v=-OfXvb7GY1s
        $this->validate($request, [
            'name' => 'max:120',
            'email' => 'email',
            'state' => 'min:0|max:1|required',
            'age' => 'min:0|max:99|required',
            'gender' => 'max:120|required',
            'diagnostic' => 'required',
            'treatment' => 'required',
            'commentary' => 'max:250|required',
            'cry' => 'required',
            'noises' => 'required',
            'walk' => 'required',
            'visual' => 'required',
            'inattention' => 'required',
            'movements' => 'required',
            'instructions' => 'required',
            'rituals' => 'required',
            'language' => 'required',
            'eco' => 'required',
            'social' => 'required',
            'jokes' => 'required',
            'agresive' => 'required',
        ]);
        $message = "Error desconocido!";

        // Applicant creation
        $name = $request['name'];
        $email = $request['email'];

        $applicant = Applicant::where('id', $id)
            ->where('name', $name)->first();
        
        if (!$applicant) 
        {
            $applicant = new Applicant();
            $applicant->name = $name;
            $applicant->email = $email;
            if ($applicant->save())
            {
                $message = "El Aplicante ha sido creado exitosamente!";
            }
        }
        else {
            $message = "El Aplicante ha sido encontrado exitosamente!";
        }
        
        // Profile creation
        $state = $request['state'];
        $age = $request['age'];
        $gender = $request['gender'];
        $diagnostic = $request['diagnostic'];
        $treatment = $request['treatment'];
        $commentary = $request['commentary'];

        $profile = new Profile();
        $profile->state = $state;
        $profile->age = $age;
        $profile->gender = $gender;
        $profile->prev_diagnostic = $diagnostic;
        $profile->prev_treatment = $treatment;
        $profile->commentary = $commentary;

        if ($applicant->profile()->save($profile))
        {
            $message .= " El Perfil ha sido creado exitosamente!";

            //Assigning symptoms to profile
            $data = $request->all();
            $index = 0;
            $symptomsAttached = 0;
            foreach ($data as $key => $value) {
                $index = $loop->index;
                if ($index > 7 && $value === 'si')
                {
                    $profile->symptom()->attach($index - 1);
                    if ($profile->symptom()->where('profile_id', $profile))
                    {
                        $symptomsAttached += 1;
                    }
                }
            }

            if ($symptomsAttached > 0) 
            {
                $message .= " Los sintomas han sido ligados al perfil!";
            }
            return response()->json(['message' => $message], 200);
        }
        else{
            $message .= " El Perfil no se ha podido crear!"; 
            return response()->json(['message' => $message], 500);
        }
    }

    public function getDashboard()
    {
        $activeProfile = Profile::whereIn('state', [0, 1, 3])->get();
        $inactiveProfile = Profile::whereIn('state', [2, 4])->get();
        return view('dashboard', ['activeProfiles' => $activeProfile, 
            'inactiveProfiles' => $inactiveProfile]);
    }

    /*public function getApplicantProfileView($id)
    {
        $applicantProfile = Profile::where('id', $id)->get();
        $users = User::all();
        $recommendation = Recommendation::all();
        $recommendationArea = RecommendationArea::all();
        return view('profiles/applicantProfile', ['id' => $applicantProfile,
        'recommendation' => $recommendation, 'recommendationArea' => $recommendationArea]);
    }*/

    public function getApplicantProfileView()
    {
        return view('profiles/applicantProfile');
    }
}

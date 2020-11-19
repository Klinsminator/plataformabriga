<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Profile;
use App\Applicant;
use App\Symptom;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'name' => 'max:120',
            'email' => 'email',
            'state' => 'min:0|max:1|required',
            'age' => 'min:0|max:99|required',
            'gender' => 'max:120|required',
            'diagnostic' => 'required',
            'treatment' => 'required',
            'commentary' => 'max:250|required',
            'llora' => 'required',
            'ruidos' => 'required',
            'puntillas' => 'required',
            'visual' => 'required',
            'habla' => 'required',
            'movimientos' => 'required',
            'instrucciones' => 'required',
            'rituales' => 'required',
            'lenguaje' => 'required',
            'eco' => 'required',
            'socializa' => 'required',
            'bromas' => 'required',
            'agresiva' => 'required',
        ]);
        $transactionState = false;
        $message = "Error desconocido!";

        // Applicant creation
        $name = $request['name'];
        $email = $request['email'];

        $applicant = new Applicant();
        $applicant->name = $name;
        $applicant->email = $email;

        if ($applicant->save())
        {
            // Profile creation
            $state = $request['state'];
            $age = $request['age'];
            $gender = $request['gender'];
            $diagnostic = $request['diagnostic'] === 'si' ? true : false;
            $treatment = $request['treatment'] === 'si' ? true : false;
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
                $transactionState = true;

                //Assigning symptoms to profile
                //Using Ninja Forms + Webhooks (add-on) allows to call this post
                //also it allows to define the key and values for each pair
                //to facilitate everything, webhooks key must partially match symptom name from DB
                $data = $request->all();
                $symptomsAttached = 0;
                foreach ($data as $key => $value) {
                    if ($value === 'si')
                    {
                        $symptom = Symptom::where('name', 'LIKE', '%'.$key.'%')->first();
                        $profile->symptom()->attach($symptom->id);
                        if ($profile->symptom()->where('profile_id', $profile))
                        {
                            $symptomsAttached += 1;
                        }
                    }
                }

                if ($symptomsAttached > 0) 
                {
                    return (new ProfileResource($profile))
                    ->response()->setStatusCode(Response::HTTP_CREATED);
                }
                else{
                    $message .= " Los sintomas no se han podido asignar!"; 
                    return (new ProfileResource($profile))
                    ->response()->setStatusCode(Response::HTTP_CREATED);
                }
            }
            else{
                $message .= " El Perfil no se ha podido crear!"; 
                return (new ApplicantResource($applicant))
                ->response()->setStatusCode(Response::HTTP_CONFLICT);
            }
        }

        return (new ApplicantResource($applicant))
        ->response()->setStatusCode(Response::HTTP_CONFLICT);     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}

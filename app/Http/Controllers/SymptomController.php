<?php
namespace  App\Http\Controllers;

use App\Symptom;
use App\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SymptomController extends Controller
{
    public function postCreateSymptom(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:120|required',
            'description' => 'max:200|required'
        ]);

        $name = $request['name'];
        $description = $request['description'];

        $symptom = new Symptom();
        $symptom->name = $name;
        $symptom->description = $description;

        $message = "Error desconocido!";
        if ($symptom->save()) {
            $message = "El Sintoma ha sido agregado exitosamente!";
        }

        return redirect()->route('symptoms')->with(['message' => $message]);
    }

    public function postUpdateSymptom(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'max:120',
            'description' => 'max:200'
        ]);

        $id = $request['id'];
        $name = $request['name'];
        $description = $request['description'];

        $symptom = Symptom::where('id', $id)->first();
        if ($name && $name != $symptom->name)
            $symptom->name = $name;
        if ($description && $description != $symptom->description)
            $symptom->description = $description;

        $message = "Error desconocido!";
        if($symptom->isDirty())
        {
            if ($symptom->update())
            {
                $message = "El Sintoma ha sido actualizado exitosamente!";
                return response()->json(['message' => $message, 'newName' => $symptom->name,
                    'newDescription' => $symptom->description], 200);
            }
        }
        else {
            $message = "No hay cambios en los datos! Revise que en efecto este cambiando algun dato.";
        }

        return response()->json(['message' => $message], 500);

    }

    public function getDeleteSymptom($symptomId)
    {
        $symptom = Symptom::find($symptomId);

        $message = "Error desconocido!";
        $full = 0;
        foreach ($symptom->profile as $symp)
        {
            $full ++;
        }

        if($full>0)
        {
            $message = "Error, el Sintoma aun se encuentra ligado a uno o mas perfiles!";
        }
        else {
            $symptom->profile()->detach();
            if ($symptom->delete())
            {
                $message = "El Sintoma ha sido eliminado exitosamente!";
            }
        }

        return redirect()->route('symptoms')->with(['message' => $message]);
    }

    public function getSymptomsView()
    {
        $symptoms = Symptom::all();
        $recommendations = Recommendation::all();
        //Log::debug('Some message.');
        return view('symptoms/symptoms', ['symptoms' => $symptoms,
            'recommendations' => $recommendations]);
    }
}

<?php
namespace  App\Http\Controllers;

use App\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RecommendationController extends Controller
{
    public function postCreateRecommendation(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:120|required',
            'description' => 'max:200|required'
        ]);

        $name = $request['name'];
        $description = $request['description'];

        $recommendation = new Recommendation();
        $recommendation->name = $name;
        $recommendation->description = $description;

        $message = "Error desconocido!";
        if ($recommendation->save()) {
            $message = "La Recomendacion ha sido agregada exitosamente!";
        }

        return redirect()->route('symptoms')->with(['message' => $message]);
    }

    public function postUpdateRecommendation(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'max:120',
            'description' => 'max:200'
        ]);

        $id = $request['id'];
        $name = $request['name'];
        $description = $request['description'];

        $recommendation = Recommendation::where('id', $id)->first();
        if ($name && $name != $recommendation->name)
            $recommendation->name = $name;
        if ($description && $description != $recommendation->description)
            $recommendation->description = $description;

        $message = "Error desconocido!";
        if($recommendation->isDirty())
        {
            if ($recommendation->update())
            {
                $message = "La Recomendacion ha sido actualizada exitosamente!";
                return response()->json(['message' => $message, 'newName' => $recommendation->name,
                    'newRecommendation' => $recommendation->description], 200);
            }
        }
        else {
            $message = "No hay cambios en los datos! Revise que en efecto este cambiando algun dato.";
        }

        return response()->json(['message' => $message], 500);

    }

    public function getDeleteRecommendation($recommendationId)
    {
        $recommendation = Recommendation::find($recommendationId);

        $message = "Error desconocido!";
        $full = 0;
        foreach ($recommendation->profile as $recom)
        {
            $full ++;
        }

        if($full>0)
        {
            $message = "Error, La Recomendacion aun se encuentra ligada a uno o mas perfiles!";
        }
        else {
            $recommendation->profile()->detach();
            if ($recommendation->delete())
            {
                $message = "La recomendacion ha sido eliminada exitosamente!";
            }
        }

        return redirect()->route('symptoms')->with(['message' => $message]);
    }
}

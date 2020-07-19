<?php
namespace  App\Http\Controllers;

use App\RecommendationArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RecommendationAreaController extends Controller
{
    public function postCreateRecommendationArea(Request $request)
    {
        $this->validate($request, [
            'name' => 'max:120|required',
            'description' => 'max:254|required'
        ]);

        $name = $request['name'];
        $description = $request['description'];

        $recommendationArea = new RecommendationArea();
        $recommendationArea->name = $name;
        $recommendationArea->description = $description;

        $message = "Error desconocido!";
        if ($recommendationArea->save())
        {
            $message = "El area de recomendacion ha sido agregada exitosamente!";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }

    public function postUpdateRecommendationArea(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'max:120',
            'description' => 'max:254'
        ]);

        $id = $request['id'];
        $name = $request['name'];
        $description = $request['description'];

        $recommendationArea = RecommendationArea::where('id', $id)->first();
        if ($name && $name != $recommendationArea->name)
            $recommendationArea->name = $name;
        if ($description && $description != $recommendationArea->description)
            $recommendationArea->description = $description;

        $message = "Error desconocido!";
        if ($recommendationArea->update())
        {
            $message = "El area de recomendacion ha sido actualizada exitosamente!";
            return response()->json(['message' => $message, 'newName' => $recommendationArea->name,
                'newDescription' => $recommendationArea->description], 200);
        }

        return response()->json(['message' => $message], 500);

    }

    public function getDeleteRecommendationArea($recommendationAreaId)
    {
        $message = "Error desconocido!";

        // This if validates if the requested usertype related users on DB
        if (!RecommendationArea::has('professionals')->find($recommendationAreaId))
        {
            if (RecommendationArea::destroy($recommendationAreaId))
            {
                $message = "El area de recomendacion ha sido eliminada exitosamente!";
            }
        }
        else {
            $message = "El area de recomendacion aun esta ligada a uno o mas profesionales!";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }
}

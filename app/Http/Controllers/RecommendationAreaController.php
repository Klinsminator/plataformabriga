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
            $message = "El Area ha sido agregada exitosamente!";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }
}

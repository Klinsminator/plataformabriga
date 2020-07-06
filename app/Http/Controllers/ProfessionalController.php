<?php
namespace  App\Http\Controllers;

use App\Office;
use App\Professional;
use App\RecommendationArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\Integer;

class ProfessionalController extends Controller
{
    public function postCreateProfessional(Request $request)
    {
        $this->validate($request, [
            'names' => 'max:120|required',
            'lastNames' => 'max:120|required',
            'title' => 'max:120|required',
            'profession' => 'max:120|required',
            'email' => 'email|unique:professionals|unique:users|required',
            'phone' => 'min:8|max:12|required',
            'recommendationAreaId' => 'numeric',
            'officeId' => 'numeric'
        ]);

        $names = $request['names'];
        $lastNames = $request['lastNames'];
        $title = $request['title'];
        $profession = $request['profession'];
        $personalEmail = $request['email'];
        $personalPhone = $request['phone'];
        $RecommendationAreaId = $request['recommendationAreaId'];
        $officeId = $request['officeId'];

        $user = new Professional();
        $user->names = $names;
        $user->last_names = $lastNames;
        $user->title = $title;
        $user->profession = $profession;
        $user->email = $personalEmail;
        $user->phone = $personalPhone;
        if($RecommendationAreaId == null || $RecommendationAreaId == 0)
            $user->recommendation_area_id = 0;
        else
            $user->recommendation_area_id = $RecommendationAreaId;
        if($officeId == null || $officeId == 0)
            $user->office_id = 0;
        else
            $user->office_id = $officeId;

        $message = "Error desconocido!";
        if ($user->save())
        {
            $message = "El Profesional ha sido agregado exitosamente!";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }

    public function postAssignAreaToProfessional(Request $request)
    {
        $this->validate($request, [
            'areaId' => 'required',
            'professionalID' => 'required'
        ]);

        $areaId = $request['areaId'];
        $professionalID = $request['professionalID'];

        $professional = Professional::find($professionalID);
        $professional->recommendation_area_id = $areaId;

        $message = "Error desconocido!";
        if ($professional->update())
        {
            $message = "El Profesional ha sido actualizado exitosamente!";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }

    public function postAssignOfficeToProfessional(Request $request)
    {
        $this->validate($request, [
            'officeId' => 'required',
            'professionalID' => 'required'
        ]);

        $officeId = $request['officeId'];
        $professionalID = $request['professionalID'];

        $professional = Professional::find($professionalID);
        $professional->office_id = $officeId;

        $message = "Error desconocido!";
        if ($professional->update())
        {
            $message = "El Profesional ha sido actualizado exitosamente!";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }

    public function getProfessionalsView()
    {
        $recommendationAreas = RecommendationArea::all();
        $professionals = Professional::all();
        $offices = Office::all();
        return view('professionals/professionals', ['recommendationAreas' => $recommendationAreas,
            'professionals' => $professionals, 'offices' => $offices]);
    }
}

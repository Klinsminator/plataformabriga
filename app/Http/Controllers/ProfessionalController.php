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
            'phone' => 'min:8|max:15|required',
            'recommendationAreaId' => 'required',
            'officeId' => 'required'
        ]);

        $names = $request['names'];
        $lastNames = $request['lastNames'];
        $title = $request['title'];
        $profession = $request['profession'];
        $personalEmail = $request['email'];
        $personalPhone = $request['phone'];
        $recommendationArea = RecommendationArea::find($request['recommendationAreaId']);
        $office = Office::find($request['officeId']);

        $professional = new Professional();
        $professional->names = $names;
        $professional->last_names = $lastNames;
        $professional->title = $title;
        $professional->profession = $profession;
        $professional->email = $personalEmail;
        $professional->phone = $personalPhone;

        $message = "Error desconocido!";
        if($office && $recommendationArea)
        {
            if ($professional->save())
            {
                // All this flow is for the manytomany relationship
                $professional->office()->attach($office);
                $professional->recommendationArea()->attach($recommendationArea);

                $message = "El Profesional ha sido agregado exitosamente!";
                if($professional->recommendationArea()->where('professional_id', $professional) &&
                    $professional->office()->where('proffesional_id', $professional))
                {
                    $message .= " El area de recomendacion y la oficina se agregaron exitosamente!";
                }
                else {
                    $message .= " ERROR: El area de recomendacion y/o la oficina no ha
                    podido ser agregado por un error desconocido!";
                }
            }
        }
        else {
            $message = "La oficina o el area de recomendacion no se ha encontrado!";
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

        $message = "Error desconocido!";
        $full = 0;
        foreach ($professional->recommendationArea as $area)
        {
            $full ++;
        }

        if($full>0)
        {
            $message = "Error, el profesional ya se encuentra ligado a un area de recomendacion!";
        }
        else {
            $professional->recommendationArea()->attach($areaId);
            if ($professional->recommendationArea()->where('professional_id', $professional))
            {
                $message = "El Profesional ha sido actualizado exitosamente!";
            }
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

        $message = "Error desconocido!";
        $full = 0;
        foreach ($professional->office as $office)
        {
            $full ++;
        }

        if($full>0)
        {
            $message = "Error, el profesional ya se encuentra ligado a una oficina!";
        }
        else {
            $professional->office()->attach($officeId);
            if ($professional->office()->where('professional_id', $professional))
            {
                $message = "El Profesional ha sido actualizado exitosamente!";
            }
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }

    public function getProfessionalsView()
    {
        $recommendationAreas = RecommendationArea::all();
        $professionals = Professional::all()->load(['recommendationArea', 'office']);
        $offices = Office::all();
        //Log::debug('Some message.');
        return view('professionals/professionals', ['recommendationAreas' => $recommendationAreas,
            'professionals' => $professionals, 'offices' => $offices]);
    }
}

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
                    $message .= " El area de recomendacion y el consultorio se agregaron exitosamente!";
                }
                else {
                    $message .= " ERROR: El area de recomendacion y/o el consultorio no ha
                    podido ser agregado por un error desconocido!";
                }
            }
        }
        else {
            $message = "El area de recomendacion y/o el consultorio no se ha encontrado!";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }

    public function postUpdateProfessional(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'names' => 'max:120',
            'lastNames' => 'max:120',
            'title' => 'max:120',
            'profession' => 'max:120',
            'email' => 'email',
            'phone' => 'min:8|max:15'
        ]);

        $id = $request['id'];
        $names = $request['names'];
        $lastNames = $request['lastNames'];
        $title = $request['title'];
        $profession = $request['profession'];
        $personalEmail = $request['email'];
        $personalPhone = $request['phone'];
        $recommendationArea = RecommendationArea::find($request['recommendationArea']);
        $office = Office::find($request['office']);

        $professional = Professional::where('id', $id)->first();
        if ($names && $names != $professional->names)
            $professional->names = $names;
        if ($lastNames && $lastNames != $professional->last_names)
            $professional->last_names = $lastNames;
        if ($title && $title != $professional->title)
            $professional->title = $title;
        if ($profession && $profession != $professional->profession)
            $professional->profession = $profession;
        if ($personalEmail && $personalEmail != $professional->email)
            $professional->email = $personalEmail;
        if ($personalPhone && $personalPhone != $professional->phone)
            $professional->phone = $personalPhone;

        // Need to extract the models from the manytomany relationship
        $professionalRecommendationArea = null;
        $professionalOffice = null;

        foreach ($professional->recommendationArea as $area)
        {
            $professionalRecommendationArea = $area;
        }
        foreach ($professional->office as $ofi)
        {
            $professionalOffice = $ofi;
        }

        $message = "Error desconocido!";
        if ($recommendationArea->id === $professionalRecommendationArea->id
            && $office->id === $professionalOffice->id)
        {
            if($professional->isDirty())
            {
                if ($professional->update())
                {
                    $message = "El profesional ha sido actualizado exitosamente!";
                    return response()->json(['message' => $message, 'newTitle' => $professional->title,
                        'newNames' => $professional->names, 'newLastNames' => $professional->last_names,
                        'newRecommendationArea' => $recommendationArea->name, 'newProfession' => $professional->profession,
                        'newEmail' => $professional->email, 'newPhonePrimary' => $professional->phone,
                        'newOffice' => $office->name, 'newRecommendationAreaId' => $recommendationArea->id,
                        'newOfficeId' => $office->id], 200);
                }
            }
            else {
                $message = "No hay cambios en los datos! Revise que en efecto este cambiando algun dato.";
            }
        }
        else{
            // This is for a manytomany case in which the belonged modifies to whom belongs
            // If it is changed, detach current and attach new one
            if ($recommendationArea->id !== $professionalRecommendationArea->id)
            {
                $professional->recommendationArea()->detach($professionalRecommendationArea->id);
                $professional->recommendationArea()->attach($recommendationArea->id);
            }
            if ($office->id !== $professionalOffice->id)
            {
                $professional->office()->detach($professionalOffice->id);
                $professional->office()->attach($office->id);
            }

            if ($professional->save())
            {
                $message = "El profesional ha sido actualizado exitosamente!";
                return response()->json(['message' => $message, 'newTitle' => $professional->title,
                    'newNames' => $professional->names, 'newLastNames' => $professional->last_names,
                    'newRecommendationArea' => $recommendationArea->name, 'newProfession' => $professional->profession,
                    'newEmail' => $professional->email, 'newPhonePrimary' => $professional->phone,
                    'newOffice' => $office->name, 'newRecommendationAreaId' => $recommendationArea->id,
                    'newOfficeId' => $office->id], 200);
            }
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
            $message = "Error, el profesional ya se encuentra ligado a un consultorio!";
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

    public function getDeleteProfessional($professionalId)
    {
        $professional = Professional::find($professionalId);

        $message = "Error desconocido!";

        $professional->recommendationArea()->detach();
        $professional->office()->detach();
        if ($professional->delete())
        {
            $message = "El profesional ha sido eliminado exitosamente!";
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

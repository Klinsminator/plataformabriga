<?php
namespace  App\Http\Controllers;

use App\Commentary;
use App\User;
use App\Applicant;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\Integer;

class CommentaryController extends Controller
{
    public function postCreateCommentary(Request $request)
    {
        $this->validate($request, [
            'comment' => 'max:200|required',
            'profileId' => 'required',
            'applicantId' => 'required',
            'userId' => 'required'
        ]);

        $comment = $request['comment'];
        $profile = Profile::find($request['profileId']);
        $applicant = Applicant::find($request['applicantId']);
        $user = User::find($request['userId']);

        $commentary = new Commentary();
        $commentary->comment = $comment;

        $message = "Error desconocido!";
        if ($commentary->save())
        {
            $message = " El Comentario ha sido creado exitosamente!"; 
        }

        if($profile)
        {
            $commentary->profile()->associate($profile);
            $message .= " El Perfil ha sido asociado exitosamente!";
        }

        if($applicant)
        {
            $commentary->applicant()->associate($applicant);
            $message .= " El Aplicante ha sido asociado exitosamente!";
        }

        if($user)
        {
            $commentary->user()->associate($user);
            $message .= " El Usuario ha sido asociado exitosamente!";
        }

        return redirect()->route('professionals')->with(['message' => $message]);
    }
}

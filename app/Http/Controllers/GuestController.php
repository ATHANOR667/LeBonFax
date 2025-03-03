<?php

namespace App\Http\Controllers;


use App\Http\Requests\Guest\ContactUsRequest;
use App\Mail\Collab;
use App\Mail\CollabFeedBack;
use App\Models\Certif;
use App\Models\Event;
use App\Models\Pack;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;


class GuestController extends Controller
{

    /**
     * Afficher la liste des packages et des certifs
     *
     * @return JsonResponse
     */
    public function package_certif_list(): \Illuminate\Http\JsonResponse
    {
        try {
            $packages = Pack::withoutTrashed()->with('certifs')->withCount('certifs as nombre_de_certifs');


            $certifs = Certif::withoutTrashed()->get()->groupBy('categorie');

            return response()->json(
                [
                    'status' => 200,
                    'packages' => $packages->get(),
                    'certifs' => $certifs,
                ]
                ,200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 500,
                    'message' => "Erreur interne",
                    'error' => $e->getMessage()
                ]
                ,500
            );
        }
    }

    /**
     * Envoie un message après validation.
     *
     * @param ContactUsRequest $request
     * @return JsonResponse
     */
    public function contactUs(ContactUsRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $validatedData = $request->validated();

            Mail::to(env('MAIL_SUPPORT'))->send(new Collab($validatedData['name'], $validatedData['subject'], $validatedData['message'],$validatedData['pays'],$validatedData['contact']));

            Mail::to($validatedData['email'])->send(new CollabFeedBack($validatedData['name'], $validatedData['subject'], $validatedData['message'],$validatedData['pays'],$validatedData['contact']));

            return response()->json([
                'status' => 200,
                'message' => 'Proposition soumise avec succès, consultez vos mails pour le feedback'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 200,
                'message' => 'Erreur lors de l\'envoi du mail, veuillez réessayer plus tard' ,
                'error' => $e->getMessage()
            ], 500);
        }
    }




    /**
     * Afficher la liste des évènements
     *
     * @return JsonResponse
     */
    public function event_list(): \Illuminate\Http\JsonResponse
    {
        try {
            $event = Event::withoutTrashed();

            return response()->json(
                [
                    'status' => 200,
                    'events' => $event->get(),
                ]
                ,200
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 500,
                    'message' => "Erreur interne",
                    'error' => $e->getMessage()
                ]
                ,500
            );
        }
    }



}

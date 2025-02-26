<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guest\PaymentRequest;
use App\Models\Pack;
use App\Models\Certif;
use App\Models\Payment;
use App\Services\CinetPayService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    /**
     * Initialiser un paiement et générer le lien de paiement.
     *
     * @param PaymentRequest $request
     * @return JsonResponse
     */
    public function initPayment(PaymentRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['customer_email'] = $validated['email'];

        try {
            if ($validated['pack_id'] != null  && $validated['certif_id'] != null) {
                return response()->json([
                    'status' => 401 ,
                    'message' => 'Le pack_id ou le certif_id doit etre null .'
                ]);
            }elseif ($validated['certif_id'] != null) {
                $certif =  Certif::find($validated['certif_id']);
                $montant = $certif->prix;
                $transID =   'Certif_' . $certif->id . '-' . $validated['email'] . '-' . now()->format('Y/m/d H:i:s');
            }elseif($validated['pack_id'] != null){
                $pack = Pack::find($validated['pack_id']);
                $montant = $pack->prix;
                $transID = 'Pack_' . $pack->id . '-' . $validated['email'] . '-' . now()->format('Y/m/d H:i:s');

            }


        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return response()->json([
                'status' => 500 ,
                'error' => $exception->getMessage() ,
                'message' => 'Erreur lors de la transaction',
            ]);
        }


        $formData = [
            'transaction_id' => $transID,
            'amount' => (int) $montant,
            'currency' => $validated['devise'],
            'customer_name' => $validated['nom'],
            'customer_surname' => $validated['prenom'],
            'description' => 'desc',
            'notify_url' => route('guest.notifyPayment'),
            'return_url' => route('guest.returnAfterPayment'),
            'channels' => [ 'MOBILE_MONEY', 'CREDIT_CARD', 'WALLET'],
            'invoice_data' => [],
            'customer_email' => $validated['customer_email'] ?? '',
            'customer_phone_number' => $validated['customer_phone_number'] ?? '',
            'customer_address' => $validated['customer_address'] ?? '',
            'customer_city' => $validated['customer_city'] ?? '',
            'customer_country' => $validated['customer_country'] ?? '',
            'customer_state' => $validated['customer_state'] ?? '',
            'customer_zip_code' => $validated['customer_zip_code'] ?? '',
        ];



        $cinetPay = new CinetPayService();

        try {
            $result = $cinetPay->generatePaymentLink($formData);


        }catch (GuzzleException $e){
            Log::error('Erreur lors de la génération du lien de payement : '.$e->getMessage());

            return response()->json(
                [
                    'status' => 500 ,
                    'error' => $e->getMessage(),
                    'message' => 'Erreur lors de la génération du lien de paiement'
                ],500
            );
        }

        if ($result['code'] === '201') {

            try {
                Payment::create([
                    'transaction_id' => $transID,
                    'montant' => $montant,
                    'token' => $result['data']['payment_token'],
                    'devise' => $validated['devise'],
                    'nom' => $validated['nom'],
                    'prenom' => $validated['prenom'],
                    'email' => $validated['email'],
                    'status' => 'pending',
                    'pack_id' => $validated['pack_id'] ?? null,
                    'certif_id' => $validated['certif_id'] ?? null,
                ]);
            }catch (\Exception $exception){
                Log::error('Erreur lors de la génération du lien de payement : '.$exception->getMessage());
                return response()->json([
                    'status' => 500 ,
                    'error' => $exception->getMessage() ,
                    'message' =>'Erreur lors de la génération du lien de payement'
                ]) ;
            }

            return response()->json([
                'status' => 201,
                'message' => 'Lien de paiement généré avec succès.',
                'data' => $result['data']
            ],201);
        }



        return response()->json([
            'status' => 500,
            'message' => 'Une erreur est survenue lors de la génération du lien de paiement.',
            'data' => $result,

        ], 500);
    }

    /**
     * Vérifier et mettre à jour le statut d'un payement
     *
     *
     * @param Request $request
     * @return RedirectResponse
     */

    public function returnAfterPayment( Request $request): RedirectResponse
    {
        $transID = $request->input('transaction_id');
        $token = $request->input('token');

        session([
            'transaction_id' => $transID,
            'token' => $token,
        ]);

        return redirect(env('RETURN_AFTER_PAYMENT'))->with([]);

    }

    public function notifyPayment(): JsonResponse
    {
        return response()->json([
            'status' => 200,
        ]);
    }

}

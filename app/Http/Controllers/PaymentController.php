<?php

namespace App\Http\Controllers;

use App\Http\Requests\Guest\PaymentRequest;
use App\Mail\PaymentFeedback;
use App\Models\Pack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use NotchPay\Exceptions\ApiException;
use NotchPay\Exceptions\InvalidArgumentException;
use NotchPay\Exceptions\NotchPayException;
use NotchPay\NotchPay;
use NotchPay\Payment;

class PaymentController extends Controller
{


    public function package_buy(PaymentRequest $request): \Illuminate\Http\JsonResponse
    {
        $apiKey = env('NOTCHPAY_API_KEY');


        $data = [
            'pack' => $request->input('pack_id') ,
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone'),
        ] ;

        $data = Crypt::encrypt($data);

        try {
            NotchPay::setApiKey($apiKey);
            $tranx = Payment::initialize([
                'amount' => Pack::find($request->input('pack_id'))->prix,
                'email' => $request->input('email'),
                'currency' => 'XAF',
                'callback' => route('guest.paymentStatus',$data),
                'reference' => $request->input('email') . '-' . now()->format('d-m-Y-H-i-s'),
            ]);

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Redirection vers la page de paiement.',
                    'authorization_url' => $tranx->authorization_url,
                ]
                ,200
            );
        } catch (NotchPayException $e) {
            return response()->json(
                [
                    'status' => 500,
                    'message' => 'Erreur lors de l\'initialisation du paiement.',
                    'error' => $e->getMessage(),
                ]
                , 500);
        }
    }

    public function verify(Request $request, string $data): \Illuminate\Http\JsonResponse
    {
        $apiKey = env('NOTCHPAY_API_KEY');

        try {
            $data = Crypt::decrypt($data);
        } catch (\Exception $e) {
            Log::error('Erreur lors du déchiffrement des données (pack , nom , prenom et email) : ' . $e->getMessage());
            return response()->json(
                [
                    'status' => 500,
                    'message' => 'Erreur de déchiffrement des données.',
                    'error' => $e->getMessage(),
                ]
                ,500
            );
        }

        $reference = $request->input('reference');
        if (!$reference) {
            return response()->json(
                [
                    'status' => 500,
                    'message' => 'Référence non fournie.',
                ]
                ,500
            );
        }

        try {
            NotchPay::setApiKey($apiKey);
            $tranx = Payment::verify($reference);

            if ($tranx->transaction->status === 'complete') {
                $existingTransaction = \App\Models\Payment::where('reference', $reference)->first();
                if ($existingTransaction) {
                    return response()->json(
                        [
                            'status' => 401,
                            'message' => 'Cette transaction a déjà été traitée.',
                        ]
                        ,401
                    );
                }

                try {
                    \App\Models\Payment::create([
                        'reference' => $reference,
                        'email' => $data['email'],
                        'pack_id' => $data['pack_id'],
                        'nom' => $data['nom'],
                        'prenom' => $data['prenom'],
                        'telephone' => $data['telephone'],
                    ]);

                    Mail::to($data['email'])->send(new PaymentFeedback(
                        Pack::find($data['pack_id']),
                        $reference,
                        $data['nom'],
                        $data['prenom'],
                    ));

                    return response()->json(
                        [
                            'status' => 200,
                            'message' => 'Paiement réussi et traité.',
                            'reference' => $reference,
                        ]
                        ,200
                    );
                } catch (\Exception $e) {
                    Log::error('Achat effectué mais non enregistré ou mail non envoyé : ' . $e->getMessage());
                    return response()->json(
                        [
                            'status' => 500,
                            'message' => 'Erreur lors de l\'enregistrement de la transaction ou de l\'envoi de l\'email.',
                            'error' => $e->getMessage(),
                        ]
                        ,500
                    );
                }
            } else {
                return response()->json(
                    [
                        'status' => 500,
                        'message' => 'Paiement échoué.',
                    ]
                    ,500
                );
            }
        } catch (ApiException $e) {
            Log::error('Erreur lors de la vérification du paiement : ' . $e->getMessage());
            return response()->json(
                [
                    'status' => 500,
                    'message' => 'Erreur lors de la vérification du paiement.',
                    'error' => $e->getMessage(),
                ]
                ,500
            );
        } catch (InvalidArgumentException $e) {
            return response()->json(
                [
                    'status' => 500,
                    'message' => 'Erreur interne ',
                    'error' => $e->getMessage(),
                ]
                ,500
            );
        }
    }


}

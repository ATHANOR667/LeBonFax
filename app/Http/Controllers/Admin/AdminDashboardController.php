<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Dashboard\FindPaymentRequest;
use App\Models\Certif;
use App\Models\Pack;
use App\Models\Payment;
use Carbon\Carbon;


class AdminDashboardController extends Controller
{

    public function findPayment(FindPaymentRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $field = $request->get('field');
            $search = $request->get('search');
            $payment = Payment::withTrashed()
                ->where($field,  'LIKE', "%$search%")
                ->with(['pack.certifs', 'certif'])
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $payment,
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'status'  => 500,
                'message' => 'Erreur interne',
                'error' => $exception->getMessage(),
            ]);
        }

    }
    public function getAchatCalendrier(): \Illuminate\Http\JsonResponse
    {
        try {
            $oldestPayment = Payment::whereNotNull('dateDisponibilite')
                ->orderBy('dateDisponibilite', 'asc')->first();
            if (!$oldestPayment) {
                return response()->json([]); // Aucun paiement trouvé
            }

            $startYear = Carbon::parse($oldestPayment->dateDisponibilite)->year;
            $startMonth = Carbon::parse($oldestPayment->dateDisponibilite)->month;
            $currentYear = Carbon::now()->year;
            $currentMonth = Carbon::now()->month;

            $result = [];

            for ($year = $startYear; $year <= $currentYear; $year++) {
                $monthStart = ($year == $startYear) ? $startMonth : 1;
                $monthEnd = ($year == $currentYear) ? $currentMonth : 12;

                for ($month = $monthStart; $month <= $monthEnd; $month++) {
                    $monthName = Carbon::create()->month($month)->translatedFormat('F');

                    $payments = Payment::whereYear('dateDisponibilite', $year)
                        ->whereMonth('dateDisponibilite', $month)
                        ->with(['pack.certifs', 'certif'])
                        ->get();

                    // Tableaux associatifs temporaires
                    $packs = [];
                    $certifs = [];

                    foreach ($payments as $payment) {
                        $acheteur = [
                            'nom'       => $payment->nom,
                            'prenom'    => $payment->prenom,
                            'email'     => $payment->email,
                            'telephone' => $payment->telephone,
                        ];

                        // Traitement pour les certificats
                        if ($payment->certif_id) {
                            $certif = $payment->certif;
                            if (!isset($certifs[$certif->id])) {
                                $certifs[$certif->id] = [
                                    'nom'         => $certif->nom,
                                    'description' => $certif->description,
                                    'prix'        => $certif->prix,
                                    'lien'        => $certif->lien,
                                    'acheteurs'   => [],
                                ];
                            }
                            $certifs[$certif->id]['acheteurs'][] = $acheteur;
                        }

                        // Traitement pour les packs
                        if ($payment->pack_id) {
                            $pack = $payment->pack;
                            if (!isset($packs[$pack->id])) {
                                $packs[$pack->id] = [
                                    'id'          => $pack->id,
                                    'nom'         => $pack->nom,
                                    'description' => $pack->description,
                                    'prix'        => $pack->prix,
                                    'reduction'   => $pack->reduction,
                                    'image'       => $pack->image,
                                    'certifs'     => $pack->certifs->map->format(),
                                    'acheteurs'   => [],
                                ];
                            }
                            $packs[$pack->id]['acheteurs'][] = $acheteur;
                        }
                    }

                    // Ajout du nombre d'acheteurs pour chaque entité

                    foreach ($certifs as &$certif) {
                        $certif['acheteurs_count'] = count($certif['acheteurs']);
                    }
                    unset($certif);
                    foreach ($packs as &$pack) {
                        $pack['acheteurs_count'] = count($pack['acheteurs']);
                    }
                    unset($pack);


                    // Préparation du résultat pour le mois
                    $monthlyData = [
                        'packs'   => array_values($packs),
                        'certifs' => array_values($certifs),
                    ];

                    $result[$year][$monthName] = $monthlyData;


                }
            }

            return response()->json([
                'status'  => 200,
                'data'    => $result,
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'status'  => 500,
                'message' => 'Erreur interne',
                'error' => $exception->getMessage(),
            ]);
        }

    }





    public function getPacksWithCertifsAndBuyers(): \Illuminate\Http\JsonResponse
    {
        try {
            $packs = Pack::withCount('commandes')
                ->with('commandes')
                ->with('certifs')
                ->get()
                ->map(function($pack) {
                    return [
                        'pack' => $pack->format(),
                        'nombre_acheteurs' => $pack->commandes_count,
                        'acheteurs' => $pack->commandes->map(function($payment) {
                            return $payment->format();
                        })
                    ];
                });

            return response()->json([
                'status'  => 200,
                'data'    => $packs,
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'status'  => 500,
                'message' => 'Erreur interne',
                'error' => $exception->getMessage(),
            ]);
        }

    }

    public function getCertifsWithBuyers(): \Illuminate\Http\JsonResponse
    {
        try {
            $certifs = Certif::withCount('commandes')
                ->with('commandes')
                ->get()
                ->map(function($certif) {
                    return [
                        'certif' => $certif->format(),
                        'nombre_acheteurs' => $certif->commandes_count,
                        'acheteurs' => $certif->commandes->map(function($payment) {
                            return $payment->format();
                        }),
                    ];
                });

            return response()->json([
                'status'  => 200,
                'data'    => $certifs,
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'status'  => 500,
                'message' => 'Erreur interne',
                'error' => $exception->getMessage(),
            ]);
        }

    }





}


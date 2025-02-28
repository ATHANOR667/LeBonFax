<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ManageCertif\AdminCreateCertifRequest;
use App\Http\Requests\Admin\ManageCertif\AdminDeleteCertifRequest;
use App\Http\Requests\Admin\ManageCertif\AdminUpdateCertifRequest;
use App\Models\Certif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGestionCertifController extends Controller
{
    public function certif_list(): \Illuminate\Http\JsonResponse
    {
        try {
            $certifs = Certif::withoutTrashed();
            $deletedCertifs = Certif::onlyTrashed();

            return response()->json([
                'status' => 200,
                'certifs' => $certifs->get()->groupBy('categorie'),
                'deletedCertifs' => $deletedCertifs->get(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Erreur interne",
                'error' => $e->getMessage()
            ]);
        }
    }


    public function certif_create(AdminCreateCertifRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();


        try {
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('certifs', 'public');
            }

            $certif = Certif::create($data);

            return response()->json([
                'status' => 201,
                'message' => 'Certif créé avec succès',
                'certif' => $certif
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Erreur interne lors de la création de la certif",
                'error' => $e->getMessage()
            ]);
        }
    }

    public function certif_edit(AdminUpdateCertifRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $certif = Certif::withoutTrashed()->where('id',$data['id']);

        if (!$certif->exists()) {
            return response()->json([
                'status' => 404,
                'message' => 'Certif inexistante ou supprimée'
            ]);
        }

        try {
            $certif = $certif->first();
            if ($request->hasFile('image')) {
                if ($certif->image && Storage::disk('public')->exists($certif->image)) {
                    Storage::disk('public')->delete($certif->image);
                }

                $data['image'] = $request->file('image')->store('certifs', 'public');
            }

            $certif->update($data);

            return response()->json([
                'status' => 200,
                'message' => 'Certif mise à jour avec succès',
                'certif' => $certif
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur interne lors de la mise à jour de la certif',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function certif_delete(AdminDeleteCertifRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $certif = Certif::withoutTrashed()->where('id',$data['id']);

        if (!$certif->exists()) {
            return response()->json([
                'status' => 404,
                'message' => 'Certif déja supprimée'
            ]);
        }


        try {
            $certif->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Certif supprimée'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur interne',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function certif_restore(AdminDeleteCertifRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $certif = Certif::onlyTrashed()->where('id',$data['id']);

        if (!$certif->exists()) {
            return response()->json([
                'status' => 404,
                'message' => 'Certif inexistante dans la liste des certifs supprimées'
            ]);
        }


        try {
            $certif->restore();

            return response()->json([
                'status' => 200,
                'message' => 'Certif restaurée'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur interne',
                'error' => $e->getMessage()
            ]);
        }
    }
}

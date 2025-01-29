<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ManagePackage\AdminAttachCertifRequest;
use App\Http\Requests\Admin\ManagePackage\AdminCreatePackageRequest;
use App\Http\Requests\Admin\ManagePackage\AdminUpdatePackageRequest;
use App\Http\Requests\Admin\ManagePackage\AdminDeletePackageRequest;
use App\Models\Certif;
use App\Models\Pack;
use Composer\Package\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGestionPackController extends Controller
{
    public function package_list(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $packages = Pack::withoutTrashed()->with('certifs')->withCount('certifs as nombre_de_certifs');
            $deletedPackages = Pack::onlyTrashed()->with('certifs')->withCount('certifs as nombre_de_certifs');

            return response()->json([
                'status' => 200,
                'packages' => $packages->get(),
                'deletedPackages' => $deletedPackages->get(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Erreur interne",
                'error' => $e->getMessage()
            ]);
        }
    }



    public function package_create(AdminCreatePackageRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $data['prix'] = 0;



        try {
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('packages', 'public');
            }

            $package = Pack::create($data);

            return response()->json([
                'status' => 201,
                'message' => 'Package créé avec succès',
                'package' => $package,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Erreur interne lors de la création du package",
                'error' => $e->getMessage()
            ]);
        }
    }

    public function package_edit(AdminUpdatePackageRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $package = Pack::withoutTrashed()->where('id',$data['id']);

        if (!$package->exists()) {
            return response()->json([
                'status' => 404,
                'message' => 'Package inexistant ou supprimé'
            ]);
        }

        try {
            $package = $package->first();
            if ($request->hasFile('image')) {
                if ($package->image && Storage::disk('public')->exists($package->image)) {
                    Storage::disk('public')->delete($package->image);
                }

                $data['image'] = $request->file('image')->store('packages', 'public');
            }

            $package->update($data);

            return response()->json([
                'status' => 200,
                'message' => 'Package mis à jour avec succès',
                'package' => $package
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur interne lors de la mise à jour du package',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function package_delete(AdminDeletePackageRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $package = Pack::withoutTrashed()->where('id',$data['id']);

        if (!$package->exists()) {
            return response()->json([
                'status' => 404,
                'message' => 'Package déja supprimé'
            ]);
        }


        try {
            $package->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Package supprimé'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur interne',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function package_restore(AdminDeletePackageRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $package = Pack::onlyTrashed()->where('id',$data['id']);

        if (!$package->exists()) {
            return response()->json([
                'status' => 404,
                'message' => 'Package inexistant dans la liste de package supprimé'
            ]);
        }


        try {
            $package->restore();

            return response()->json([
                'status' => 200,
                'message' => 'Package restauré'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur interne',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function attach_certif(AdminAttachCertifRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $certif = Certif::withoutTrashed()->where('id', $request->input('certif_id'));
            $pack = Pack::withoutTrashed()->where('id', $request->input('pack_id'));

            if(!$certif->exists() || !$pack->exists()) {
                return response()->json(
                    [
                        'status' => 404,
                        'message' => 'Pack ou certif introuvable'
                    ],404
                );
            }
            $certif = $certif->first();
            $pack = $pack->first();

            if ($pack->certifs()->where('certif_id', $certif->id)->exists()) {
                return response()->json(
                    [
                        'status' => 400,
                        'message' => 'Certif déjà attachée à ce Pack'
                    ], 400);
            }

            $pack->certifs()->attach($certif->id);
            $pack->prix = $pack->calculerPrix();
            $pack->save();

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Certif attachée au Pack avec succès'
                ], 200);

        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 500,
                    'message' => 'Erreur interne',
                    'error' =>  $e->getMessage()
                ], 500);
        }
    }

    public function detach_certif( AdminAttachCertifRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $certif = Certif::withoutTrashed()->where('id', $request->input('certif_id'));
            $pack = Pack::withoutTrashed()->where('id', $request->input('pack_id'));

            if(!$certif->exists() || !$pack->exists()) {
                return response()->json(
                    [
                        'status' => 404,
                        'message' => 'Pack ou certif introuvable'
                    ],404
                );
            }
            $certif = $certif->first();
            $pack = $pack->first();

            if (!$pack->certifs()->where('certif_id', $certif->id)->exists()) {
                return response()->json(
                    [
                        'status' => 400,
                        'message' => 'Certif non attachée à ce Pack'
                    ], 400);
            }

            $pack->certifs()->detach($certif->id);
            $pack->prix = $pack->calculerPrix();
            $pack->save();

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Certif détachée du Pack avec succès'
                ], 200);

        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 500,
                    'message' => 'Erreur interne',
                    'error' =>  $e->getMessage()
                ], 500);
        }

    }

}

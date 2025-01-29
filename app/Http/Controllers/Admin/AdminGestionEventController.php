<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ManageEvent\AdminCreateEventRequest;
use App\Http\Requests\Admin\ManageEvent\AdminDeleteEventRequest;
use App\Http\Requests\Admin\ManageEvent\AdminUpdateEventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class AdminGestionEventController extends Controller
{
    public function event_list(): \Illuminate\Http\JsonResponse
    {
        try {
            $events = Event::withoutTrashed()->get();
            $deletedEvents = Event::onlyTrashed()->get();

            return response()->json([
                'status' => 200,
                'events' => $events,
                'deletedEvents' => $deletedEvents,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Erreur interne",
                'error' => $e->getMessage()
            ]);
        }
    }

    public function event_create(AdminCreateEventRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('events', 'public');
            }

            $event = Event::create($data);

            return response()->json([
                'status' => 201,
                'message' => 'Événement créé avec succès',
                'event' => $event
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => "Erreur interne lors de la création de l'événement",
                'error' => $e->getMessage()
            ]);
        }
    }

    public function event_edit(AdminUpdateEventRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();


        try {
            $event = Event::withoutTrashed()->where('id', $data['id']);

            if (!$event->exists()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Événement inexistant ou supprimé'
                ]);
            }

            $event = $event->first();
            if ($request->hasFile('image')) {
                if ($event->image && Storage::disk('public')->exists($event->image)) {
                    Storage::disk('public')->delete($event->image);
                }

                $data['image'] = $request->file('image')->store('events', 'public');
            }

            $event->update($data);
            $event->save();

            return response()->json([
                'status' => 200,
                'message' => 'Événement mis à jour avec succès',
                'event' => $event
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur interne lors de la mise à jour de l\'événement',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function event_delete(AdminDeleteEventRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();


        try {
            $event = Event::withoutTrashed()->where('id', $data['id']);

            if (!$event->exists()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Événement déjà supprimé'
                ]);
            }

            $event = $event->first();
            $event->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Événement supprimé'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur interne',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function event_restore(AdminDeleteEventRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();


        try {
            $event = Event::onlyTrashed()->where('id', $data['id']);

            if (!$event->exists()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Événement inexistant dans la liste des événements supprimés'
                ]);
            }

            $event->first() ;

            $event->restore();

            return response()->json([
                'status' => 200,
                'message' => 'Événement restauré'
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

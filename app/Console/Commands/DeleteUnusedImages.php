<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Certif;
use App\Models\Pack;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DeleteUnusedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:images:delete-unused';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Supprime les images stockées mais non utilisées dans les champs image des modèles Certif,
     Pack et Event.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Exécute la commande.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            $usedImages = collect();

            $usedImages = $usedImages->merge(Certif::whereNotNull('image')->pluck('image'));
            $usedImages = $usedImages->merge(Pack::whereNotNull('image')->pluck('image'));
            $usedImages = $usedImages->merge(Event::whereNotNull('image')->pluck('image'));

            $usedFileNames = $usedImages->map(function ($image) {
                return basename($image);
            })->toArray();

            $certifFiles = Storage::disk('public')->files('certifs');
            $packFiles = Storage::disk('public')->files('packages');
            $eventFiles = Storage::disk('public')->files('events');

            $allFiles = array_merge($certifFiles, $packFiles, $eventFiles);

            Log::info('Fichiers dans public/certifs :', $certifFiles);
            Log::info('Fichiers dans public/packs :', $packFiles);
            Log::info('Fichiers dans public/events :', $eventFiles);
            Log::info('Fichiers utilisés (image) :', $usedFileNames);

            foreach ($allFiles as $file) {
                $fileName = basename($file);

                if (!in_array($fileName, $usedFileNames)) {
                    Storage::disk('public')->delete($file);
                    Log::info("Fichier supprimé : " . $fileName);
                }
            }

            $this->info('Nettoyage des images inutilisées terminé.');
        } catch (\Exception $e) {
            Log::error('Erreur lors du nettoyage des images : ' . $e->getMessage());
            $this->error('Une erreur est survenue lors de la suppression des images inutilisées.');
        }
    }
}

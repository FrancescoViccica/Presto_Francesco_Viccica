<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\Image\Image;
use Spatie\Image\Enums\ImageDriver;
use Spatie\Image\Enums\CropPosition;
use Spatie\Image\Enums\Unit;
use Spatie\Image\Enums\Fit; // 🌟 AGGIUNTO: Importazione fondamentale per il ridimensionamento proporzionale
use Spatie\Image\Enums\AlignPosition; // 🌟 AGGIUNTO: Importazione per decidere l'angolo del logo


class ResizeImage implements ShouldQueue
{
    use Queueable;

    // Proprietà private per memorizzare i dati passati dal costruttore
    
    private $w;
    private $h;
    private $fileName;
    private $path;

    /**
     * Create a new job instance.
     * 
     * Accetta il percorso del file (es: "articles/1/abcde.jpg"), la larghezza e l'altezza.
     */
    public function __construct($filePath, $w, $h)
    {
        // Separiamo la cartella dal nome del file
        $this->path = dirname($filePath);     // es: "articles/1"
        $this->fileName = basename($filePath); // es: "abcde.jpg"
        $this->w = $w;
        $this->h = $h;
    }

    /**
     * Execute the job.
     * Esegue l'elaborazione dell'immagine in background.
     */
    public function handle(): void
    {
        $w = $this->w;
        $h = $this->h;

        // Costruiamo i percorsi assoluti corretti puntando alla cartella storage/app/public/
        $srcPath = storage_path('app/public/' . $this->path . '/' . $this->fileName);
        
        // Il file croppato conterrà il prefisso "crop_300x300_" davanti al nome originale
        $destPath = storage_path('app/public/' . $this->path . '/crop_' . $w . 'x' . $h . '_' . $this->fileName);

        // Verifichiamo che il file originale esista per evitare che il Job vada in errore (crash)
        if (file_exists($srcPath)) {
            
            // Versione pulita senza vincoli di pixel per forzare la stampa nativa
                       Image::useImageDriver(ImageDriver::Gd)
                ->load($srcPath)
                ->fit(\Spatie\Image\Enums\Fit::Contain, $w, $h) 
                ->watermark(
                    base_path('resources/img/watermark.png'), 
                    position: AlignPosition::BottomRight, // Nell'angolo in basso a destra
                    paddingX: 10, // 10 pixel di distanza dal bordo
                    paddingY: 10,
                    width: 50,    // 🌟 FORZATO: 50 pixel di larghezza
                    height: 50    // 🌟 FORZATO: 50 pixel di altezza
                )
                ->save($destPath);



            // (Opzionale ma consigliato) Elimina il file originale non croppato per non intasare il server
            // if (file_exists($destPath) && $srcPath !== $destPath) {
            //     unlink($srcPath);
            // }
        }
    }
}

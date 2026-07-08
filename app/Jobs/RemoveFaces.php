<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Google Vision
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\Image as VisionImage;

// Spatie
use Spatie\Image\Image as SpatieImage;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\AlignPosition;

class RemoveFaces implements ShouldQueue
{
use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

private $article_image_id;

public function __construct($article_image_id)
{
$this->article_image_id = $article_image_id;
}

public function handle(): void
{
$imageModel = Image::find($this->article_image_id);

if (!$imageModel) {
return;
}

// Percorso dell'immagine ORIGINALE (come nella dispensa)
$srcPath = storage_path('app/public/' . $imageModel->path);

if (!file_exists($srcPath)) {
logger("RemoveFaces: immagine non trovata -> {$srcPath}");
return;
}

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

$client = new ImageAnnotatorClient();

$visionImage = new VisionImage([
'content' => file_get_contents($srcPath),
]);

$feature = new Feature();
$feature->setType(Type::FACE_DETECTION);

$request = new AnnotateImageRequest();
$request->setImage($visionImage);
$request->setFeatures([$feature]);

$batchRequest = new BatchAnnotateImagesRequest();
$batchRequest->setRequests([$request]);

$batchResponse = $client->batchAnnotateImages($batchRequest);

$responses = $batchResponse->getResponses();

if (count($responses) === 0) {
$client->close();
return;
}

$response = $responses[0];

$faces = $response->getFaceAnnotations();

// LOG temporaneo
logger('Numero volti trovati: ' . count($faces));

if (count($faces) === 0) {
$client->close();
return;
}

$censuraPath = base_path('resources/img/censura.png');

if (!file_exists($censuraPath)) {
logger("RemoveFaces: immagine censura non trovata -> {$censuraPath}");
$client->close();
return;
}

$image = SpatieImage::load($srcPath);

foreach ($faces as $face) {

$vertices = $face->getBoundingPoly()->getVertices();

if (count($vertices) < 4) {
continue;
}

$x = $vertices[0]->getX();
$y = $vertices[0]->getY();

$width = $vertices[1]->getX() - $vertices[0]->getX();
$height = $vertices[3]->getY() - $vertices[0]->getY();


logger('X: ' . $x);
logger('Y: ' . $y);
logger('Width: ' . $width);
logger('Height: ' . $height);

$image->watermark(
$censuraPath,
position: AlignPosition::TopLeft,
paddingX: $x,
paddingY: $y,
width: $width,
height: $height,
fit: Fit::Stretch
);
}

$image->save($srcPath);


// Recuperiamo il percorso fisico del file del crop 300x300 generato da ResizeImage
$cropPath = dirname($srcPath) . '/crop_300x300_' . basename($srcPath);

// Se il file del crop esiste, lo rigeneriamo partendo dall'originale appena censurato
if (file_exists($cropPath)) {
SpatieImage::load($srcPath)
->fit(\Spatie\Image\Enums\Fit::Contain, 300, 300) // 🌟 Ridimensiona in scala l'immagine censurata
->save($cropPath);

logger("RemoveFaces: Crop rigenerato con successo con la censura.");
}
// 👆 FINE DEL NUOVO BLOCCO

$client->close();
}
}
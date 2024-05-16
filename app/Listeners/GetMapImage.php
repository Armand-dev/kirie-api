<?php

namespace App\Listeners;

use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class GetMapImage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $property = $event->property;

        $config = config('google');

        // Create a GuzzleHttp client
        $client = new Client();

        $mapImageUrl = "https://maps.googleapis.com/maps/api/staticmap?center={$property->street},{$property->streetNumber}&zoom={$config['zoom']}&size={$config['size']}&maptype=roadmap&markers=color:red%7Clabel:A%7C{$property->street},{$property->streetNumber}&key={$config['api_key']}";
        $streetViewImageUrl = "https://maps.googleapis.com/maps/api/streetview?size={$config['size']}&location={$property->street},{$property->street_number}&fov=90&heading=235&pitch=10&key={$config['api_key']}";


        // Download the image
        $mapImageContent = $client->get($mapImageUrl)->getBody()->getContents();
        $streetViewImageContent = $client->get($streetViewImageUrl)->getBody()->getContents();

        // Define a unique name for the file
        $mapFileName = 'images/' . uniqid('map_') . '.png';
        $streetViewFileName = 'images/' . uniqid('street_view_') . '.png';

        // Use Storage facade to store the image to the 'spaces' disk
        Storage::disk('spaces')->put($mapFileName, $mapImageContent);
        Storage::disk('spaces')->put($streetViewFileName, $streetViewImageContent);

        // Get the full URL of the stored image
        $mapImageFullUrl = Storage::disk('spaces')->url($mapFileName);
        $streetViewImageFullUrl = Storage::disk('spaces')->url($streetViewFileName);

        // Save the full URL in map_image
        $property->map_image = $mapImageFullUrl;
        $property->street_view_image = $streetViewImageFullUrl;

        // Save changes
        $property->save();
    }
}

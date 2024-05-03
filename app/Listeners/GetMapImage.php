<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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

        $mapImage = "https://maps.googleapis.com/maps/api/staticmap?center={$property->street},{$property->streetNumber}&zoom={$config['zoom']}&size={$config['size']}&maptype=roadmap&markers=color:red%7Clabel:A%7C{$property->street},{$property->streetNumber}&key={$config['api_key']}";
        $streetViewImage = "https://maps.googleapis.com/maps/api/streetview?size={$config['size']}&location={$property->street},{$property->street_number}&fov=90&heading=235&pitch=10&key={$config['api_key']}";

        $property->map_image = $mapImage;
        $property->street_view_image = $streetViewImage;
        $property->save();
    }
}

<?php


namespace App\Traits;

trait UploadTrait
{
    private function imageUpload($images, $imageColum = null)
    {
        $uploadedImages = [];

        if (is_array($images) ) {

            foreach ($images as $image) {
                if (!is_null($imageColum)) {
                    $uploadedImages[] = [$imageColum => $image->store('podutos', 'public')];
                }
            }

        } else {
            $uploadedImages = $images->store('logo', 'public');
        }

        return $uploadedImages;
    }
}

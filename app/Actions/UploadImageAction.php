<?php


namespace App\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UploadImageAction
{
    public function execute(Request $request)
    {
        $image = $request->image;
        $fileName = Str::random(25) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('storage/images/');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 755, true);
        }

        Image::make($image->getRealPath())
            ->fit(700, 900)
            ->save($destinationPath . $fileName);

        Image::make($image->getRealPath())
            ->fit(100, 100)
            ->save($destinationPath . 'thumbnail' . $fileName);

        Image::make($image->getRealPath())
            ->fit(500, 600)
            ->save($destinationPath . 'medium' . $fileName);

        return [
            'imagePath' => 'storage/images/' . $fileName,
            'thumbnail' => 'storage/images/thumbnail' . $fileName,
            'mediumImagePath' => 'storage/images/medium' . $fileName
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Components\FlashMessages;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use FlashMessages;

    public function tags($object, $request)
    {

        $tags = explode(',', str_replace(' ', '', $request->tags));
        foreach ($tags as $tag) {
            $find_tag = Tag::where('name', strtolower($tag))->first();
            if ($find_tag){
                $object->tags()->attach($find_tag->id);
            } else {
                $new_tag = Tag::create(['name' => strtolower($tag)]);
                $object->tags()->attach($new_tag->id);
            }
        }
    }
}

<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\ArticleForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Gallery;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;

class GalleryItemController extends Controller
{
    public function getPublicPath($id, $width, $height, $objectFit) {
        $item = GalleryItem::with([])->findOrFail($id);
        return response()->json(['url' => renderImage($item->url, $width, $height, $objectFit)]);
    }

    public function store($gallery_id) {

        request()->validate([
            'files' => 'required',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480'
        ]);

        $gallery = Gallery::with([])->findOrFail($gallery_id);

        $files = request()->file('files');
        $name = request()->post('name', '');
        $type = request()->post('type', 'item');
        $text = request()->post('text', '');
        $active = (boolean) request()->post('active', true);


        try {
            foreach ($files as $file) {
                $path = Storage::disk('public')->put('gallery_item/'.$gallery_id, $file);

                $item = new GalleryItem([
                    'url' => 'public/'.$path,
                    'name' => $name,
                    'type' => $type,
                    'text' => $text,
                    'active' => $active,
                ]);
                $item->gallery()->associate($gallery);
                $item->save();

                $item->position = $item->getKey();
                $item->save();
            }
        }
        catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }

        return response()->json(['status' => 200]);
    }

    public function update($id) {
        request()->validate([
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:6144',
        ]);

        $files = request()->file('files');
        $name = request()->post('name', '');
        $type = request()->post('type', 'item');
        $text = request()->post('text', '');
        $active = request()->post('active', true);


        $item = GalleryItem::with([])->findOrFail($id);

        try {
            $path = $item->url;
            if($files) {
                foreach ($files as $file) {
                    if(Storage::exists($item->url)) {
                        Storage::delete($item->url);
                    }
                    $path = Storage::disk('public')->put('gallery_item/'.$item->gallery_id, $file);
                    $path = 'public/'.$path;
                }
            }

            $item->update([
                'url' => $path,
                'name' => $name,
                'type' => $type,
                'text' => $text,
                'active' => $active,
            ]);
            $item->save();
        }
        catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }

        return response()->json(['status' => 200, 'item' => request()->post()]);
    }

    public function delete($gallery_item_id) {
        if(!$gallery_item_id) {
            return response()->json(['status' => 404, 'message' => 'Gallery item with id !'.$gallery_item_id.' not exist!']);
        }

        $item = GalleryItem::with([])->findOrFail($gallery_item_id);

        if(Storage::exists($item->url)) {
            Storage::delete($item->url);

            $filesArray = [];
            foreach (\File::allFiles('resized') as $file){
                if(str_contains(basename($file), '_public_gallery_item_'.$item->gallery_id.'_'.str_replace('public/gallery_item/'.$item->gallery_id.'/', '', $item->url))){
                    $filesArray[] = 'resized/'.basename($file);
                }
            }
            \File::delete($filesArray);
        }

        try {
            $item->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
        return response()->json(['status' => 200, 'message' => 'Gallery item has been removed.']);
    }
}

<?php

use App\Models\ConstField;
use App\Models\SiteLang;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Schema;

function renderImage($url, $width = null, $height = null, $objectFit = null)
{

    if (!is_dir(public_path('resized'))) {
        mkdir(public_path('resized'));
    }


    try {
        $storageImg = Storage::get($url);
    } catch (Exception $e) {
        $storageImg = public_path('image/utils/no-image.png');
        if (!$url) {
            $url = 'image/utils/no-image.png';
        }
    }


    $prefix = $width . 'x' . $height . '_' . $objectFit;
    $fileName = str_replace('/', '_', $url);
    $filePath = 'resized/' . $prefix . '_' . $fileName;

    if (!file_exists(public_path($filePath))) {
        $img = Image::make($storageImg);

        $extension = explode('.', $fileName);
        $extension = $extension[count($extension) - 1];

        if ($extension != 'svg') {
            switch ($objectFit) {
                case 'fit':
                {
                    $img->fit($width, $height);
                    break;
                }
                case 'resize':
                {
                    $img->resize($width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    break;
                }
            }
        }

        $img->save($filePath);
    }

    return asset($filePath);
}


function renderSmallCover($model)
{
    $gallery = $model->gallery;
    $url = '';
    if ($gallery) {
        $url = $gallery->coverUrl();
    }
    return renderImage($url, 50, 50, 'fit');
}


function getConstField($name)
{
    $value = '';
    $constField = ConstField::with([])->where('name', '=', $name)->where('lang', app()->getLocale())->first();
    if ($constField) {
        $value = $constField->value;
    }
    return $value;
}


function getLanguagesConfig()
{
    $host = env('DB_HOST');
    $dbName = env('DB_DATABASE');
    $username = env('DB_USERNAME');
    $password = env('DB_PASSWORD');

    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $connection = new Connection($pdo, $dbName);
    try {
        $result = $connection->select('SELECT name FROM site_lang WHERE active=1');
        $resultDefaultSiteLang = $connection->selectOne('SELECT name FROM site_lang WHERE default_site=1');
        $resultDefaultAdminLang = $connection->selectOne('SELECT name FROM site_lang WHERE default_admin=1');

        $langs = [];
        foreach ($result as $res) {
            $langs[] = $res->name;
        }

        return (object)[
            'langs' => $langs,
            'defaultSite' => $resultDefaultSiteLang->name,
            'defaultAdmin' => $resultDefaultAdminLang->name,
        ];
    } catch (Exception $e) {
        return (object)[
            'langs' => ['en', 'pl'],
            'defaultSite' => 'pl',
            'defaultAdmin' => 'pl',
        ];
    }
}


function getAdminLang()
{
    $lang = null;
    if (Schema::hasTable('site_lang')) {
        $lang = SiteLang::with([])
            ->where('default_site', '=', 1)
            ->where('active', '=', 1)
            ->first();
    }

    $default = 'en';
    if ($lang) {
        $default = $lang->name;
    }

    return session()->get('app_locale', $default);
}

function getPhoneLink($field = 'phone', $class = '', $icon = ''): string
{
    $constField = ConstField::with([])->where('name', '=', $field)->locale()->first();
    if($constField)
        if($constField->value)
            return '<a href="'.'tel:'.str_replace([' ', '-'], '', $constField->value).'" class="'.$class.'">'.$icon.$constField->value.'</a>';

    return '';
}

function getEmailLink($field = 'email', $class = '', $icon = ''): string
{
    $constField = ConstField::with([])->where('name', '=', $field)->locale()->first();
    if($constField)
        if($constField->value)
            return '<a href="'.'mailto:'.$constField->value.'" class="'.$class.'">'.$icon.$constField->value.'</a>';

    return '';
}

function getAddressString(): string
{
    $postCode = ConstField::with([])->where('name', '=', 'company_post_code')->locale()->first()->value;
    $city = ConstField::with([])->where('name', '=', 'company_city')->locale()->first()->value;
    $address = ConstField::with([])->where('name', '=', 'company_address')->locale()->first()->value;

    if($postCode || $city || $address){
        if($address){
            return $address.',<br>'.$postCode.' '.$city;
        } else {
            return $postCode.' '.$city;
        }
    }

    return '';
}

function getFooterCreator($name = 'Palmax', $url = 'https://palmax.com.pl/'): string
{
    return 'Strona stworzona przez: <a target="_blank" href="'.$url.'">'.$name.'</a>';
}

function aosElement($from = 'top', $duration = 1000, $delay = 0, $offset = 0): string
{
    $type = 'fade-down';
    switch ($from){
        case 'top':
            break;
        case 'bottom':
            $type = 'fade-up';
            break;
        case 'left':
            $type = 'fade-right';
            break;
        case 'right':
            $type = 'fade-left';
            break;
        case 'zoom':
            $type = 'zoom-in';
            break;
    }

    return 'data-aos='.$type.' data-aos-duration='.$duration.' data-aos-delay='.$delay.' data-aos-offset='.$offset;
}

function liToItems($string){
    $list = str_replace(['<ul>', '</ul>', '<li>'], '', $string);
    $list = explode('</li>', $list);
    array_pop($list);
    return $list;
}

//Dodaje &nbsp; po 1-2 pojedyńczych znakach
if (!function_exists('textRender')){
    function textRender($text) {
        $res = [];
        preg_match_all('/\s[AaĄąBbCcĆćDdEeĘęFfGgHhIiJjKkLlŁłMmNnŃńOoÓóPpRrSsŚśTtUuWwYyZzŹźŻż0-9.,:;"!?\']{1,2}\s/', $text, $res);
        foreach ($res[0] as $variant){
            $text = str_replace($variant, preg_replace('/ $/', '&nbsp;', $variant), $text);
        }

        return $text;
    }
}

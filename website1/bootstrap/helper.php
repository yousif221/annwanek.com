<?php

use App\Brand;
use App\Config;
use App\User;
use App\PackageNotification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Facades\App\Repository\ExchangeRates;

function updatePackageDetail($user_id , $package_id ,$coins){
    $update = New PackageNotification();
    $update->user_id = $user_id;
    $update->package_id = $package_id;
    $update->coins = $coins;    
    $update->save();
    return $update;
}

function getConfig($key) {
    return (Config::where('key', $key)->first())? Config::where('key', $key)->first()->value: '';
}
function upload($file, $width, $height, $dir = '') {
    $fileName = uniqid() . time() . '.' . $file->getClientOriginalExtension();
    $img = Image::make($file->getRealPath());
    $img->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
    });
    $img->stream();
    $image = 'images/' . $dir . '/'  . $fileName;
    Storage::disk('local')->put('public/'.$image, $img, 'public');
    return 'storage/'.$image;
}
function colorWeight($htmlCode)
{
    if($htmlCode[0] == '#')
        $htmlCode = substr($htmlCode, 1);
    if (strlen($htmlCode) == 3)
        $htmlCode = $htmlCode[0] . $htmlCode[0] . $htmlCode[1] . $htmlCode[1] . $htmlCode[2] . $htmlCode[2];
    $r = hexdec($htmlCode[0] . $htmlCode[1]);
    $g = hexdec($htmlCode[2] . $htmlCode[3]);
    $b = hexdec($htmlCode[4] . $htmlCode[5]);
    $RGB =  $b + ($g << 0x8) + ($r << 0x10);
    $r = 0xFF & ($RGB >> 0x10);
    $g = 0xFF & ($RGB >> 0x8);
    $b = 0xFF & $RGB;
    $r = ((float)$r) / 255.0;
    $g = ((float)$g) / 255.0;
    $b = ((float)$b) / 255.0;
    return (0.2126 * $r + 0.7152 * $g + 0.0722 * $b) / 255;
}
function getUser($id)
{
    return User::findorFail($id);
}
function getAccountType($key)
{
    $roles = [
        0 => 'Customer',
        1 => 'Administrator',
        2 => 'Business Developer',
        3 => 'Seller',
        4 => 'Manufacturer'
    ];
    return $roles[$key];
}
function getFee($role = 0) {
    return getConfig('signup_'.$role.'_fee');
}
function getCommissionPercent($role = 0) {
    switch($role) {
        case 2:
            return getConfig('junior_bd_signup_commission');
            break;
        case 3:
            return getConfig('seller_signup_commission');
            break;
        case 4:
            return getConfig('manufacturer_signup_commission');
            break;
        default:
            return getConfig('customer_signup_commission');
            break;
    }
}
function topBrands($count) {
    return Brand::where('is_active', 1)
        ->where('deleted_at', null)
        ->take($count)->get();
}

function getSize($size) {
    $sizes = [
        's' => 'Small',
        'm' => 'Medium',
        'l' => 'Large',
        'xl' => 'XL',
        'xxl' => 'XXL',
        'xxx' => 'XXXL',
    ];
    return $sizes[$size];
}

function currency($amount = 0) {
    $symbols = [
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        'JPY' => '¥',
        'AUD' => '$',
        'CAD' => '$',
    ];
    $exchangeRates = json_decode(ExchangeRates::rates());
    $currencyRate = $exchangeRates->{Session::get('currency')};
    $currencySymbol = $symbols[Session::get('currency')];
    $amount = str_replace(',','', $amount);
    return $currencySymbol.number_format(floatval($amount)*floatval($currencyRate),2,".",",");
}

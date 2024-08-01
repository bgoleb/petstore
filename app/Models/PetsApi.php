<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PetsApi
{
    use HasFactory;

    private $baseUrl;
    
    public function __construct()
    {
        // Url endpointu dodany jako zmienna w .env, póżniej pobrana do config/services żeby można było ją cachować 
        $this->baseUrl = config('services.petstore.api_url');
    }

    public function findByStatus($status) : array
    {
        $url = $this->baseUrl."/findByStatus?status=$status";

        $response = Http::get($url);

        return $response->json();
    }

    public function findByid($id)
    {
        $url = $this->baseUrl."/".$id;

        $response = Http::get($url);

        if ($response->successful() ) {
            return $response->json();
        }

        return null;
    }

    public function save() 
    {
        // crc32 zostało użyte bo api wymaga żeby id było int
        $category = [
            'id' => crc32(uniqid()),
            'name' => trim(request()->input('category'))
        ];

        $tags = explode(',', request()->input('tags'));
        $tags = array_map(function ($t) : array {
            return ['id' => crc32(uniqid()), 'name' => trim($t)];
        }, $tags);

        $photoUrls = explode("\n", request()->input('photoUrls'));;

        $response = Http::post($this->baseUrl, [
            "id" => crc32(uniqid()),
            "category" => $category,
            "name" => request()->input('name'),
            "photoUrls" => $photoUrls,
            "tags" => $tags,
            "status" => "available"
        ]);
    }

    public function update(int $id)
    {
        $category = [
            'id' => crc32(uniqid()),
            'name' => trim(request()->input('category'))
        ];

        $tags = explode(',', request()->input('tags'));
        $tags = array_map(function ($t) : array {
            return ['id' => crc32(uniqid()), 'name' => trim($t)];
        }, $tags);

        $photoUrls = explode("\n", request()->input('photoUrls'));;

        $response = Http::put($this->baseUrl, [
            "id" => $id,
            "category" => $category,
            "name" => request()->input('name'),
            "photoUrls" => $photoUrls,
            "tags" => $tags,
            "status" => request()->input('status')
        ]);        
    }

    public function delete($id)
    {
        $url = $this->baseUrl."/".$id;

        $response = Http::delete($url);

        if ($response->failed()) {
            return 'failed';
        }

        return null;
    }
}

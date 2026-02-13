<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WilayahController extends Controller
{
    protected $base;

    public function __construct()
    {
        $this->base = env('WILAYAH_BASE_URL', 'https://wilayah.id/api');
    }

    public function regencies($province)
{
    $key = "wilayah:regencies:{$province}";

    $data = Cache::remember($key, 60 * 24, function () use ($province) {
        $url = rtrim($this->base, '/') . "/regencies/{$province}.json";
        $res = Http::timeout(10)->get($url);

        if (!$res->successful()) return [];

        return collect($res->json()['data'])->map(function ($item) {
            return [
                'id' => str_replace('.', '', $item['code']), // 32.04 → 3204
                'name' => $item['name']
            ];
        })->values();
    });

    return response()->json($data);
}


    public function districts($regency)
{
    $key = "wilayah:districts:{$regency}";

    $data = Cache::remember($key, 60 * 24, function () use ($regency) {
        // Try fetching using provided regency, but some files use dotted code (e.g. 32.73.json)
        $baseUrl = rtrim($this->base, '/');
        $attempts = [];
        // first try as-is
        $attempts[] = "{$baseUrl}/districts/{$regency}.json";
        // if regency looks like digits without dot, try inserting dot after province code (2 chars)
        if (preg_match('/^\d{3,}$/', $regency)) {
            $alt = substr($regency, 0, 2) . '.' . substr($regency, 2);
            $attempts[] = "{$baseUrl}/districts/{$alt}.json";
        }

        foreach ($attempts as $url) {
            $res = Http::timeout(10)->get($url);
            if (!$res->successful()) continue;
            $json = $res->json();
            $items = is_array($json) ? ($json['data'] ?? $json) : ($json['data'] ?? []);
            if (empty($items)) continue;
            return collect($items)->map(function ($item) {
                return [
                    'id' => str_replace('.', '', ($item['code'] ?? $item['id'] ?? '')),
                    'name' => ($item['name'] ?? $item['nama'] ?? '')
                ];
            })->values();
        }

        return [];
    });

    return response()->json($data);
}


    public function villages($district)
{
    $key = "wilayah:villages:{$district}";

    $data = Cache::remember($key, 60 * 24, function () use ($district) {
        $baseUrl = rtrim($this->base, '/');
        $attempts = [];
        $attempts[] = "{$baseUrl}/villages/{$district}.json";
        // If district is numeric like 321303, try dotted variants: 32.1303 and 32.13.03
        if (preg_match('/^\d{3,}$/', $district)) {
            // dot after 2 digits: 32.1303
            $alt1 = substr($district, 0, 2) . '.' . substr($district, 2);
            $attempts[] = "{$baseUrl}/villages/{$alt1}.json";
            // if length exactly 6, try 32.13.03
            if (strlen($district) === 6) {
                $alt2 = substr($district, 0, 2) . '.' . substr($district, 2, 2) . '.' . substr($district, 4, 2);
                $attempts[] = "{$baseUrl}/villages/{$alt2}.json";
            }
        }

        foreach ($attempts as $url) {
            $res = Http::timeout(10)->get($url);
            if (!$res->successful()) continue;
            $json = $res->json();
            $items = is_array($json) ? ($json['data'] ?? $json) : ($json['data'] ?? []);
            if (empty($items)) continue;
            return collect($items)->map(function ($item) {
                return [
                    'id' => str_replace('.', '', ($item['code'] ?? $item['id'] ?? '')),
                    'name' => ($item['name'] ?? $item['nama'] ?? '')
                ];
            })->values();
        }

        return [];
    });

    return response()->json($data);
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ApiController extends Controller
{
    public function index(Request $request)
    {   
        $query = $request->query('query');
        $productsQuery = Product::query();

        if ($query) {
            $productsQuery->where(function($queryBuilder) use ($query) {
                $queryBuilder->where('name', 'like', '%' . $query . '%')
                             ->orWhere('name_fr', 'like', '%' . $query . '%')
                             ->orWhere('description', 'like', '%' . $query . '%')
                             ->orWhere('description_fr', 'like', '%' . $query . '%');
            });
        }

        $products = $productsQuery->paginate(10);

        $data = [];

        foreach ($products as $product) {
            $company = $product->company;

            $data[] = [
                'name' => [
                    'en' => $product->name,
                    'fr' => $product->name_fr,
                ],
                'description' => [
                    'en' => $product->description,
                    'fr' => $product->description_fr,
                ],
                'gtin' => $product->GTIN,
                'brand' => $product->brand_name,
                'countryOfOrigin' => $product->country,
                'weight' => [
                    'gross' => $product->gross,
                    'net' => $product->net,
                    'unit' => $product->unit,
                ],
                'company' => [
                    'companyName' => $company->name,
                    'companyAddress' => $company->address,
                    'companyTelephone' => $company->phone_number,
                    'companyEmail' => $company->email,
                    'owner' => [
                        'name' => $company->owner->name,
                        'mobileNumber' => $company->owner->phone_number,
                        'email' => $company->owner->email,
                    ],
                    'contact' => [
                        'name' => $company->contact->name,
                        'mobileNumber' => $company->contact->phone_number,
                        'email' => $company->contact->email,
                    ],
                ],
            ];
        }

        return response()->json([
            'data' => $data,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'total_pages' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
            ],
        ]);
    }

    public function show($gtin)
    {
        $product = Product::where('GTIN', $gtin)->first();

        if (!$product || $product->is_hidden) {
            return response()->json(['error' => 'Product not found or is hidden'], 404);
        }

        $company = $product->company;

        $data = [
            'name' => [
                'en' => $product->name,
                'fr' => $product->name_fr,
            ],
            'description' => [
                'en' => $product->description,
                'fr' => $product->description_fr,
            ],
            'gtin' => $product->GTIN,
            'brand' => $product->brand_name,
            'countryOfOrigin' => $product->country,
            'weight' => [
                'gross' => $product->gross,
                'net' => $product->net,
                'unit' => $product->unit,
            ],
            'company' => [
                'companyName' => $company->name,
                'companyAddress' => $company->address,
                'companyTelephone' => $company->phone_number,
                'companyEmail' => $company->email,
                'owner' => [
                    'name' => $company->owner->name,
                    'mobileNumber' => $company->owner->phone_number,
                    'email' => $company->owner->email,
                ],
                'contact' => [
                    'name' => $company->contact->name,
                    'mobileNumber' => $company->contact->phone_number,
                    'email' => $company->contact->email,
                ],
            ],
        ];

        return response()->json(['data' => $data]);
    }
}

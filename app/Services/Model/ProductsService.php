<?php

namespace App\Services\Model;

use App\Models\Siskop\SiskopAccountProduct;

class ProductsService
{
    public static function isProductExists($name)
    {
        return SiskopAccountProduct::whereClientId(auth()->user()->client_id)->whereName ($name)->exists();
    }

    public static function getAllProductsService()
    {
        return SiskopAccountProduct::all();
    }

    public static function createAllProducts($data)
    {
        $defaultData = [
            'client_id' => auth()->user()->client_id,
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);
        SiskopAccountProduct::create($mergedData);
    }

    public static function canUpdateProducts($id, $name)
    {
        $existingName = SiskopAccountProduct::whereClientId(auth()->user()->client_id)->whereName ($name);
        return !$existingName->exists() || $existingName->value('id') == $id;
    }

    public static function UpdateProducts($id, $data)
    {
        $defaultData = [
            'updated_at' => now(),
            'updated_by' => auth()->user()->name,
        ];

        $mergedData = array_merge($data, $defaultData);
        SiskopAccountProduct::whereId($id)->update($mergedData);
    }

    public static function deleteProducts($id)
    {
        SiskopAccountProduct::whereId($id)->delete();
    }

    public static function getProductsResult($searchQuery, $perPage = 10)
    {
        if($searchQuery == '')
        {
            return SiskopAccountProduct::whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('name','ASC')
            ->paginate($perPage);
        } else {
            return SiskopAccountProduct::where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', $searchQuery . '%')
                        ->orWhere('updated_by', 'like', '%' . $searchQuery . '%');
            })
            ->whereClientId(auth()->user()->client_id)
            ->orderBy('priority','ASC')
            ->orderBy('name','ASC')
            ->paginate($perPage);
        }
    }
}
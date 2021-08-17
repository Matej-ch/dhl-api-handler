<?php

namespace matejch\dhlApiHandler;

class Products
{

    public $productType = [
        101 => 'DHL Parcel Slovensko',
        102 => 'DHL Parcel Slovensko - dobierka',
        103 => 'DHL Parcel International',
        104 => 'DHL Parcel International - dobierka',
        109 => 'DHL Parcel Import',
        112 => 'DHL ParcelConnect',
        113 => 'DHL ParcelConnect - dobierka',
    ];

    public $productTypeWithCod = [
        101 => ['name'=>'DHL Parcel Slovensko','cod'=>0],
        102 => ['name'=>'DHL Parcel Slovensko - dobierka','cod'=>1],
        103 => ['name'=>'DHL Parcel International','cod'=>0],
        104 => ['name'=>'DHL Parcel International - dobierka','cod'=>1],
        109 => ['name'=>'DHL Parcel Import','cod'=>0],
        112 => ['name'=>'DHL ParcelConnect','cod'=>0],
        113 => ['name'=>'DHL ParcelConnect - dobierka','cod'=>1],
    ];

    public function getProductType(int $code): string
    {
        return $this->productType[$code];
    }

    public function getProductTypes(): array
    {
        return $this->productType;
    }

    public function getProductTypeWithCod(int $code): array
    {
        return $this->productTypeWithCod[$code];
    }

    public function getProductTypesWithCod(): array
    {
        return $this->productTypeWithCod;
    }
}
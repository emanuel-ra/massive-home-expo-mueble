<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductSheetDescription;
use App\Models\ProductSheetContent;
use App\Models\ProductSheetSpecifications;
use App\Models\ProductSheetSubSpecifications;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Http::post('https://massivehome.com.mx/api/v1/public/Products',[
            'Marca' => 'false',
            'Categoria' => 'false',
            'Gallery' => 'false',
            'dsProducts' => 'true'
        ])->json();

        foreach($products as $key)
        {
          
            $id = $key["id"];                   
            $code = ($key["product_code2"]!='') ? $key["product_code2"]:$key["product_code"];
            $name = $key["nameProduct"];
            $image = $key["Img"];
            $price1 = $key["priceRetail"];
            $price2 = $key["priceWoleSale"];
            $price3 = $key["priceDistribuitor"];
            $price4 = $key["box_price"];            
            $status_id = $key["statusId"];

            $gallery_products = $key["gallery_products"];
            $data_sheet_products_description = $key["data_sheet_products_description"];
            $data_sheet_products_content = $key["data_sheet_products_content"];
            $data_sheet_products_specifications = $key["data_sheet_products_specifications"];
            
            Product::create([
                'id' => $id ,
                'code' => $code ,
                'name' => $name ,
                'image' => $image ,
                'price1' => number_format($price1,2,'.','') ,
                'price2' => number_format($price2,2,'.','') ,
                'price3' => number_format($price3,2,'.','') ,
                'price4' => number_format($price4,2,'.','') ,
            ]);      
            

            if(count($gallery_products)>0)
            {
                foreach($gallery_products as $image)
                {
                    ProductGallery::create([                        
                        'product_id' => $id ,
                        'code' => $code ,
                        'image' => $image["img"]
                    ]);
                }
            }

            if($data_sheet_products_description!=null)
            {
                ProductSheetDescription::create([
                    "product_id" => $id ,
                    "code" => $code ,
                    "title" => $data_sheet_products_description["title"] ,
                    "description" => $data_sheet_products_description["desciption"] ,
                ]);
            }

            if(count($data_sheet_products_content)>0)
            {
                foreach($data_sheet_products_content as $content)
                {
                    ProductSheetContent::create([
                        "product_id" => $id ,
                        "code" => $code ,
                        "title" => $content["title"] ,
                        "description" => $content["content"] ,
                    ]);
                }
            }

            if(count($data_sheet_products_specifications)>0)
            {
                foreach($data_sheet_products_specifications as $specifications)
                {
                    $data_sheet_products_sub_specifications = $specifications["data_sheet_products_sub_specifications"];
                    $specifications_id = $specifications["id"];
                    ProductSheetSpecifications::create([
                        "id" => $specifications_id ,
                        "product_id" => $id ,
                        "code" => $code ,
                        "title" => $specifications["title"] ,
                    ]);

                    if(count($data_sheet_products_sub_specifications)>0)
                    {
                        foreach($data_sheet_products_sub_specifications as $sub_specifications)
                        {
                            ProductSheetSubSpecifications::create([
                                "product_id" => $id ,
                                "specifications_id" => $specifications_id ,
                                "code" => $code ,
                                "description" => $sub_specifications["desciption"] ,
                                "module" => $sub_specifications["iModulo"] ,
                                "order_number" => $sub_specifications["iOrden"] ,
                            ]);
                        }
                    }
                }                
            }
            
        }
    }
}

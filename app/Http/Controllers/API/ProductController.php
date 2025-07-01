<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Product;
Use Log;

class ProductController extends Controller
{
    public function getAll(){
        $data = Product::get();
        return response()->json($data, 200);
      }

      public function create(Request $request){
        $data['name'] = $request['name'];
        $data['price'] = $request['price'];
        $data['description'] = $request['description'];
        $data['details'] = $request['details'];
        $data['stock'] = $request['stock'];
        $data['category_type'] = $request['category_type'];
        $data['shoes_type'] = $request['shoes_type'];
        $data['accesories_type'] = $request['accesories_type'];
        $data['fashion_type'] = $request['fashion_type'];
        $data['season'] = $request['season'];
        $data['category_g'] = $request['category_g'];        
        $data['mark'] = $request['mark'];
        $data['model'] = $request['model'];
        $data['size_shoes'] = $request['size_shoes'];
        $data['size_fashion'] = $request['size_fashion'];
        $data['color'] = $request['color'];
        $data['image_ini'] = $request['image_ini'];
        $data['image_fin'] = $request['image_fin'];
        Product::create($data);
        return response()->json([
            'message' => "Successfully created",
            'success' => true
        ], 200);
      }

      public function delete($id){
        $res = Product::find($id)->delete();
        return response()->json([
            'message' => "Successfully deleted",
            'success' => true
        ], 200);
      }

      public function get($id){
        $data = Product::find($id);
        return response()->json($data, 200);
      }

      public function update(Request $request,$id){
        $data['name'] = $request['name'];
        $data['price'] = $request['price'];
        $data['description'] = $request['description'];
        $data['details'] = $request['details'];
        $data['stock'] = $request['stock'];
        $data['category_type'] = $request['category_type'];
        $data['shoes_type'] = $request['shoes_type'];
        $data['accesories_type'] = $request['accesories_type'];
        $data['fashion_type'] = $request['fashion_type'];
        $data['category_g'] = $request['category_g'];       
        $data['season'] = $request['season']; 
        $data['mark'] = $request['mark'];
        $data['model'] = $request['model'];
        $data['size_shoes'] = $request['size_shoes'];
        $data['size_fashion'] = $request['size_fashion'];
        $data['color'] = $request['color'];
        $data['image_ini'] = $request['image_ini'];
        $data['image_fin'] = $request['image_fin'];
        Product::find($id)->update($data);
        return response()->json([
            'message' => "Successfully updated",
            'success' => true
        ], 200);
      }

}

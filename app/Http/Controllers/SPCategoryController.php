<?php

namespace App\Http\Controllers;

use App\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SPCategoryController extends Controller {
    public function newCategory(Request $request) {
        $res = array();
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string'
        ]);

        if ($validator->fails()) {
            return response("Please enter a title", 403); 
        }

        try{
            Category::firstOrCreate([
                'title'     => $request->input('title')
            ]);

            DB::commit();
            $res['message'] = 'Category added';            
            $res['status'] = 201;
        } catch(\Exception $e) {
            DB::rollBack();

            $res['message'] = "Error creating category";
            $res['status'] = 501;
        }
    
        return response()->json($res, $res['status']);
    }

    public function fetchCategories() {
        $res = array();

        try {
            $categories = Category::all();

            if (!$categories->isEmpty()) {
                $res['status'] = 200;
                $res['message'] = "Retrieved categories";
                $res['data'] = $categories;
            } else {
                $res['status'] = 404;
                $res['message'] = "No categories found";
            }
        } catch (Exception $e) {
            $res['status'] = 501;
            $res['message'] = "An error occurred retrieving categories";
        }

        return response()->json($res, $res['status']);
    }

    public function editCategory(Request $request, $id) {
        $res = array();
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string'
        ]);

        if ($validator->fails()) {
            return response("Please enter a title", 403); 
        }
        
        DB::beginTransaction();
        
        try {    
            $category              = Category::find($id);

            if ($category) {
                $category->title = $request->input("title");
                $category->save();

                DB::commit();
                $res['status'] = 200;
                $res['message'] = "Category updated";
                $res['data'] = $category;
            } else {
                $res['status'] = 404;
                $res['message'] = "Category not found";
            }
        } catch(\Exception $e) {
            DB::rollBack();

            $res['status'] = 501;
            $res['message'] = "An error occured trying to edit the category";            
        }
        
        return response()->json($res, $res['status']);
    }

    public function deleteCategory($id) {
        $res = array();

        try {
            $category = Category::destroy($id);
    
            if($category) {
                $res['status'] = 200;
                $res['message'] = "Category deleted";            
            } else {
                $res['status'] = 503;
                $res["message"] = "Could not delete category";
            }
        } catch (Exception $e) {
            $res['status'] = 503;
            $res["message"] = "Could not delete category";
        }
        return response()->json($res, $res['status']);
    }
}

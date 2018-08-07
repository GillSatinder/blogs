<?php

namespace App\Http\Controllers;

use App\Category;
use App\Template;
use App\TemplateGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateGroupController extends Controller
{
    public function index() {
        $pagedData = TemplateGroup::all();
        $pagingData =  array('totalpages'=> 4,
           'totalResults' =>10,
           'pagingRequest'=>7,
           'currentPage'=>2,
           'pageSize'=>4,
           'searchTerm'=>'');
       // $pagingData = ['pagingData'=> $pagingData];
        $response = ['pagedData' => $pagedData];

        return response()->json($response + $pagingData,  200);
    }

    public function delete($id) {

        $group = TemplateGroup::find($id);

        if ($group) {
            $name = $group->name;
            $group->delete();
            return response()->json('TemplateGroup with name '. $name. ' has been deleted', 200);
        } else {
            return response()->json('Operation could not be performed, please try again!!', 500);
        }


    }
    public function save(Request $request) {
        $templateGroup = new TemplateGroup();
        $templateGroup->name = $request->input('name');
        $templateGroup->save();
        $name = $request->name;

        return response()->json('TemplateGroup with name '. $name. ' has been saved', 200);
    }

    public function templateSearchOptions() {
        $templateGroups = TemplateGroup::all();
        $categories = Category::all();
       // $tags = DB::table('templates')->pluck('tags');
        $tags = Template::distinct('tags')->pluck('tags');
        $response2 = ['categories' => $categories];
        $response1 = ['templateGroups' => $templateGroups];
        $response3 = ['tags'=> $tags];
        $response4 = [$response1 + $response2 + $response3];

        $response = ['pagedData' => $response4];

        return response()->json($response);


        }
}

<?php

namespace App\Http\Controllers;

use App\TemplateGroup;
use Illuminate\Http\Request;

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
}

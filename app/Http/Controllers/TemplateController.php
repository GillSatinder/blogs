<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TemplateController extends Controller
{
    public function index(){}

    public function store(Request $request)
    {
        $template = new Template();
        $template->content = $request->input('content');
        $template->save();
        return response()->json(['template' => $template], 201);
    }

    public function getTemplateById(Request $request)
    {

        $id = $request->templateGroupId;
        $pageSize = $request->pageSize;
        $currentPage = $request->currentPage;
        $pagedData = Template::where('templateGroupId', $id)
            ->skip(($currentPage - 1) * $pageSize )
            ->take($pageSize)->get();
        $totalResults = Template::where('templateGroupId', $id)->get()->count();
        $totalPages = ceil($totalResults / $pageSize);

        $pagingData = array('totalPages' => $totalPages,
            'totalResults' => $totalResults,
            'pagingRequest' => 2,
            'currentPage' => $request->currentPage,
            'pageSize' => $request->pageSize,
            'searchTerm' => '');
        // $pagingData = ['pagingData' => $pagingData];
        $response = ['pagedData' => $pagedData];
        return response()->json($pagingData + $response, 200);
    }

    public function getAllTemplates(Request $request) {


        $pageSize = $request->pageSize;
        $searchTerm  = $request->searchTerm;
        if ($searchTerm) {
            $currentPage = $request->currentPage;
            $totalResults = Template::all()->count();
            $totalPages = ceil($totalResults / $pageSize );
            $pagedData = Template::where('name', 'LIKE', '%'.$searchTerm.'%')->get();
            $response = ['pagedData' => $pagedData];

            $pagingData = array('totalPages' => $totalPages,
                'totalResults' => $totalResults,
                'pagingRequest' => 2,
                'currentPage' => $request->currentPage,
                'pageSize' => $request->pageSize,
                'searchTerm' => $searchTerm);

            return response()->json($response + $pagingData, 200);

        }
        else {

            $currentPage = $request->currentPage;
            $totalResults = Template::all()->count();
            $totalPages = ceil($totalResults / $pageSize);
            $pagedData = Template::skip(($currentPage - 1) * $pageSize)->take($pageSize)->get();
            $response = ['pagedData' => $pagedData];

            $pagingData = array('totalPages' => $totalPages,
                'totalResults' => $totalResults,
                'pagingRequest' => 2,
                'currentPage' => $request->currentPage,
                'pageSize' => $request->pageSize,
                'searchTerm' => $searchTerm);

            return response()->json($response + $pagingData, 200);
        }

    }
}
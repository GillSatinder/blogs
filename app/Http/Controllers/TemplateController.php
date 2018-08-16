<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


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

   public function getTemplateDetailsById($id) {
       // $templateDetails = DB::table('templates')->where('templateId', $id)->get();
        $template = Template::find($id);

        $tags = DB::table('tags')->where('templateId', $id)->get();
      //  $categories = DB::table('categories')->where('templateId', $id)->get();
       $categories = Category::all();
        $template->tags = $tags;
        $template->categories = $categories;
        $templateDetails = ['templateDetails' => $template];
        return response() -> json($templateDetails);
    }

    public function editTemplate(Request $request) {

        $template = Template::find($request->templateId);
        $template->templateGroupId = $request->get('templateGroupId');
        $template->templateImageId = $request->get('templateImageId');
        $template->imageUrl = $request->get('imageUrl');
        $template->name = $request->get('name');
        $template->isActive = $request->get('isActive');
        $template->isPublic = $request->get('isPublic');
        $template->categoryId = $request->get('categoryId');
//        if ($request->get('category') == null) {
//            $template->categoryId = 0;
//        } else {
            $template->categoryId = $request->get('categoryId');
//        }
        $template->save();
        $tags = $request->get('tags');
        $tagToSave = new Tag();
        foreach ($tags as $tag) {
            $tagToSave->templateId = $tag['templateId'];
            $tagToSave->name = $tag['name'];
            $tagToSave->save();
        }
       // return $template;
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
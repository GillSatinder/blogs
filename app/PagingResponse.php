<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagingResponse extends Model
{
    public $totalPages;
    public $totalResults;
    public $pagingRequest;
    public $pagedData;

    function __construct($totalPages, $totalResults, $pR)
    {
        $this->totalPages = $totalPages;
        $this->totalResults = $totalResults;
       if ($pR != null)
       {
          // $pR = new PagingRequest();
           $this->currentPage = $pR->currentPage;
           $this->pageSize = $pR->pageSize;
           $this->searchTerm = $pR->searchTerm;

       }

    }

    public function setPagedData($totalPages, $totalResults, $currentPage,
$pageSize, $searchTerm){

        $this->totalPages = $totalPages;
        $this->totalResults = $totalResults;
        $this->currentPage = $currentPage;
        $this->pageSize = $pageSize;
        $this->searchTerm = $searchTerm;
    }

    public function getPagedData() {
       $pagedData['totalPages'] = $this->totalPages;
       $pagedData['totalResults']= $this->totalResults;
       $pagedData['currentPage']=$this->currentPage;
       $pagedData['pageSize']=$this->pageSize;
       $pagedData['searchTerm']=$this->searchTerm;
       return $pagedData;

    }

    public function setTotalPages($totalPages) {
        $this->totalPages = $totalPages;
    }
    public function getTotalPages() {
        return $this->totalPages;
    }

    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }
    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function set($pageSize) {
        $this->pageSize = $pageSize;
    }
    public function getPageSize() {
        return $this->pageSize;
    }

    public function setSearchTerm($searchTerm) {
        $this->searchTerm = $searchTerm;
    }
    public function getSearchTerm() {
        return $this->searchTerm;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagingRequest extends Model
{
    public $currentPage;
    public $pageSize;
    public $searchTerm;


    function __construct($currentPage, $pageSize, $searchTerm)
    {

        $this->currentPage = $currentPage;
        $this->pageSize = $pageSize;
        $this->searchTerm = $searchTerm;

    }
    public function setPageSize($pageSize) {
        $this->pageSize = $pageSize;
    }
    public function getPageSize() {
        return $this->pageSize;
    }
    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }
    public function getCurrentPage() {
        return $this->currentPage;
    }
    public function setSearchTerm($searchTerm) {
        $this->searchTerm = $searchTerm;
    }
    public function getSearchTerm() {
        return $this->searchTerm;
    }

}

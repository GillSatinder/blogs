<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagingService extends Model

{
    public $pagingRequest;


    function __construct($currentPage, $pageSize, $searchTerm)
    {
        $this->pagingRequest = new PagingRequest($currentPage,$pageSize,$searchTerm);

    }


}

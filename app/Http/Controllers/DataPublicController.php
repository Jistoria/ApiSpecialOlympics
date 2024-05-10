<?php

namespace App\Http\Controllers;

use App\Services\DataPublicService;
use Illuminate\Http\Request;

class DataPublicController extends Controller
{
    private $dataService;
    public function __construct(DataPublicService $dataService)
    {
        $this->dataService = $dataService;
    }
    public function get_sportman()
    {
        try{
            $sportman = $this->dataService->get_sportman();
            return response()->json(['success'=>true,'sportman'=>$sportman]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }
    public function get_sportman_by_id($cedula)
    {
        try{
            $sportman = $this->dataService->get_sportman_by_id($cedula);
            return response()->json(['success'=>true,'sportman'=>$sportman]);
        }catch(\Exception $e)
        {
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }
}

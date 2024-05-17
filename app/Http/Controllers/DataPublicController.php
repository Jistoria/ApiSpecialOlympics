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
            return response()->json($sportman);
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

    public function get_sport()
    {
        try{
            $sport = $this->dataService->get_sport();
            return response()->json($sport);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }

    public function get_activity()
    {
        try{
            $activity = $this->dataService->get_activity();
            return response()->json($activity);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }

    public function get_address()
    {
        try{
            $lugar = $this->dataService->get_address();
            return response()->json($lugar);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }

    public function get_place()
    {
        try{
            $lugar = $this->dataService->get_place();
            return response()->json($lugar,200,[],JSON_UNESCAPED_SLASHES);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],500);
        }
    }
}

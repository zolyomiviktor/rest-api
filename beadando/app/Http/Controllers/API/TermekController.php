<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use App\Models\Termek;
use App\Http\Resources\Termek as TermekResources;



class TermekController extends Controller
{
    public function index(){
        $termeks= Termek::all();
        return $this->handleResponse(TermekResource::collection($termeks), "Termékek lekérése");
    }
    public function store(Request $request){
        $input= $request->all();
        $validator= VAlidator::make($input,[
            "termekneve" => "required",
            "termakara" => "required",
            "termekalapanyaga" => "required",
            "termekgyartasiideje" => "required"
        ]);
        if($validator->fails()){
            return $this->handleError($validator->errors());
        }
        $termek= Termek::create($input);
        return $this->handleResponse(new TermekResource($termek), "A termék létrehozása"); 
    } 
    public function show($id){
        $termek= Termek::find($id);
        if(is_null($termek)){
            return $this->handleError("A termék nem létezik.");
        }
        return $this->handleResponse(new TermekResource($termek),("A Termék lekérve"));
    }
    public function update(Request $request, Termek $termek){
        $input= $request->all();
        $validator= Validator::make($input,[
            "termekneve" => "required",
            "termakara" => "required",
            "termekalapanyaga" => "required",
            "termekgyartasiideje" => "required"            
        ]);
        if($validator->fails()){
            return $this->handleError($validator->errors());
        }
        $termek->termekneve= $input["termekneve"];
        $termek->termakara= $input["termakara"];
        $termek->termekalapanyaga= $input["termekalapanyaga"];
        $termek->termekgyartasiideje= $input["termekgyartasiideje"];
        $termek->save();
        return $this->handleResponse(new TermekResource($termek),("A Termék frissítve"));
    }
    public function destroy(Termek $termek){
        $termek->delete();
        return $this->handleResponse([],"A termék törölve");
    }
}

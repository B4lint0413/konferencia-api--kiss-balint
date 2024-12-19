<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegistrationResource;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Http\Requests\StoreRegistrationRequest;

class RegistrationController extends Controller
{
    public function index(Request $request){
        $regs = Registration::all();
        if($request->has('orderBy')){
            if(!in_array($request->get('orderBy'), ['name', 'date'])){
                abort(400);
            }
            if($request->has('order')){
                if(!in_array($request->get('order'), ['asc', 'desc'])){
                    abort(400);
                }
                $regs = Registration::orderBy($request->get('orderBy'), $request->get('order'))->get();
            }
        }
        return RegistrationResource::collection($regs);
    }

    public function show(int $registration){
        return new RegistrationResource(Registration::findOrFail($registration));
    }

    public function count(){
        return Registration::all()->count();
    }

    public function destroy(int $registration){
        $reg = Registration::findOrFail($registration);
        Registration::destroy($reg->id);
    }

    public function store(StoreRegistrationRequest $request){
        $data = $request->validated();
        $create = Registration::create($data);
        return new RegistrationResource($create);
    }
}

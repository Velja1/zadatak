<?php

namespace App\Http\Controllers;

use App\Models\Artikli;
use App\Http\Requests\StoreArtikliRequest;
use App\Http\Requests\UpdateArtikliRequest;
use App\Models\Kategorije;
use Exception;
use Illuminate\Http\Request;

class ArtikliController extends Controller
{

    public function index(Request $request){
        $artikliQuery=Artikli::query();

        //Prikazuju se samo proizvodi sa stanjem vecim od 0
        $artikliQuery->where('stanje','>',0);

        //Pretraga po nazivu
        if($request->keyword){
            $artikliQuery->where('naziv','LIKE','%'.$request->keyword.'%');
        }

        //Pretraga po kategorijama
        if($request->kategorija){
            $artikliQuery->whereHas('kategorije',function($query) use ($request){
                $query->where('naziv','LIKE','%'.$request->kategorija.'%');
            });
        }

        //Sortiranje po ceni i popustu
        if($request->sortBy && in_array($request->sortBy,['osnovnaCena','procenatPopusta'])){
            $sortBy=$request->sortBy;
        }
        else{
            $sortBy='id';
        }

        if($request->sortOrder && in_array($request->sortOrder,['asc','desc'])){
            $sortOrder=$request->sortOrder;
        }
        else{
            //Podrazumevan tip sortiranja je asc
            $sortOrder='asc';
        }

        $artikli=$artikliQuery->orderBy($sortBy,$sortOrder)->get();

        //Artikli se vracaju u formi json objekta
        return $artikli;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArtikliRequest  $request
     * @return mixed
     */
    public function store(StoreArtikliRequest $request)
    {
        try{
            $kategorije=Kategorije::all();

            $artikal=new Artikli();

            $artikal->naziv=$request->naziv;
            $artikal->opis=$request->opis;
            $artikal->slikaLink=$request->slikaLink;
            $artikal->stanje=$request->stanje;
            $artikal->osnovnaCena=$request->osnovnaCena;
            $artikal->procenatPopusta=$request->procenatPopusta;
            //Proverava se da li zadata kategorija postoji
            if($kategorije->find($request->id_kategorija)){
                $artikal->id_kategorija=$request->id_kategorija;
            }
            else{
                return "Izabrana je nepostojeca kategorija.";
            }

            $artikal->save();
            return "Uspesno dodat artikal sa id: $artikal->id";
        }

        catch(Exception $ex){
            return "Doslo je do greske: $ex";
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArtikliRequest  $request
     * @return mixed
     */
    public function update(UpdateArtikliRequest $request)
    {
        $id=$request->id;
        $artikal=Artikli::find($id);

        if($artikal){
            try {
                $kategorije = Kategorije::all();

                $artikal->naziv = $request->naziv;
                $artikal->opis = $request->opis;
                $artikal->slikaLink = $request->slikaLink;
                $artikal->stanje = $request->stanje;
                $artikal->osnovnaCena = $request->osnovnaCena;
                $artikal->procenatPopusta = $request->procenatPopusta;
                //Proverava se da li zadata kategorija postoji
                if ($kategorije->find($request->id_kategorija)) {
                    $artikal->id_kategorija = $request->id_kategorija;
                }
                else {
                    return "Izabrana je nepostojeca kategorija.";
                }

                $artikal->save();
                return "Uspesno izmenjen artikal sa id: $artikal->id";
            }
            catch (Exception $ex) {
                return "Doslo je do greske: $ex";
            }
        }
        else{
            return "Artikal sa id: $id ne postoji.";
        }
    }


    //Update metod koji prodavac koristi
    public function updateSeller(Request $request)
    {
        $id=$request->id;
        $artikal=Artikli::find($id);

        if($artikal){
            try {


                if($request->stanje){
                    $artikal->stanje=$request->stanje;
                }
                if($request->procenatPopusta){
                    $artikal->procenatPopusta=$request->procenatPopusta;
                }

                $artikal->save();
                return "Uspesno izmenjen artikal sa id: $artikal->id, Novo stanje: $artikal->stanje, Novi procenat popusta: $artikal->procenatPopusta";
            }
            catch (Exception $ex) {
                return "Doslo je do greske: $ex";
            }
        }
        else{
            return "Artikal sa id: $id ne postoji.";
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artikli  $artikli
     * @return mixed
     */
    public function delete(Request $request)
    {
        //Proverava se da li je unet id
        if(!$request->id){
            return "Nije unet id artikla za brisanje";
        }

        $artikal=Artikli::find($request->id);

        if($artikal){
            $artikal->delete();
            return "Uspesno izbrisan artikal sa id: $request->id";
        }
        else{
            return "Artikal sa id: $request->id ne postoji";
        }
    }

    public function kupovina(Request $request){

        $artikal=Artikli::find($request->id);

        if($artikal){
            if($artikal->stanje >= $request->kolicina){
                $artikal->stanje-=$request->kolicina;
                $artikal->save();
                return "Uspesno kupljen artikal sa id: $request->id. Kupljena kolicina: $request->kolicina";
            }
            else{
                return "Nema dovoljno artikala na stanju. Dostupna kolicina je: $artikal->stanje";
            }
        }
        else{
            return "Artikal sa id: $request->id ne postoji";
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Videogame;
use Illuminate\Support\Facades\Mail;

use App\Mail\VideogameDeleteMail;

use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getVideogames() {

        $videogames = Videogame::all();

        return json_encode($videogames);
    }

    public function deleteVideogames($id) {

        $videogame = Videogame::findOrFail($id);

        $videogame -> delete();

        $this -> deleteMail($videogame);

        return json_encode($videogame);

    }

    private function deleteMail($videogame) {
        Mail::to(Auth::user()) -> send(new VideogameDeleteMail($videogame));

        Mail::to('prova@prova.com') -> send(new VideogameDeleteMail($videogame));
    }
}

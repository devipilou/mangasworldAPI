<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\Lecteur;

class ProfilController extends Controller {

    // Collection des rôles disponibles avec leur libellé
    private $roles = array("admin" => "Administrateur", "comment" => "Commentateur", "contrib" => "Contributeur");

    /**
     * Retourne une instance du Lecteur dont on passé l'Id
	 * @param int $id Id du Lecteur à lire
     * @return instance de Lecteur
     */
    public function show($id) {
        $lecteur = Lecteur::find($id);
        return response()->json($lecteur, 200);
    }

    /**
     * Enregistre le profil
     * @return Vue home
     */
    public function update(Request $request) {
        $messages = array(
            'nom.required' => 'Il faut saisir un nom (bril).',
            'prenom.required' => 'Il faut saisir un prénom (bril aussi).',
            'cp.required' => 'Il faut saisir un Code Postal errand.',
            'cp.numeric' => 'Le Code Postal doit etre une valeur numéric (et ramzy).'
        );
        
        $regles = array(
            'nom' => 'required',
            'prenom' => 'required',
            'cp' => 'required | numeric'
        );
        $validator = Validator::make($request->all(), $regles, $messages);

        if ($validator->fails()){
            return response()->json($validator->errors()->messages(), 500);
        }
        try {
            $id_lecteur = $request->input('id_lecteur');
            $lecteur = Lecteur::find($id_lecteur);
            $lecteur->nom = $request->input('nom');
            $lecteur->prenom = $request->input('prenom');
            $lecteur->rue = $request->input('rue');
            $lecteur->cp = $request->input('cp');
            $lecteur->ville = $request->input('ville');
            $lecteur->save();
            return response()->json($lecteur, 200);
        } catch (Exception $ex) {
            return response()->json($ex->getMessage(), 500);
        }
    }

}

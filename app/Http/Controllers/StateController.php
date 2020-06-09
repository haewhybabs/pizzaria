<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;

class StateController extends Controller
{
  public function index(Request $req)
  {
    if($req->country == 'United States of America'){
      $state = State::where('country_id', 230)->get();
      $rowCount = State::where('country_id', 230)->count();
    }
    else{
      $state = State::where('country_id', 33)->get();
      $rowCount = State::where('country_id', 33)->count();
    }

    //State option list
    if($rowCount > 0){
      foreach($state as $row){
        echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
      }
    }
    else{
      echo '<option value="">State/Province not available</option>';
    }
  }
}

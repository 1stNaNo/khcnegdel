<?php
  namespace App\Utilities;

  class Udb {

    public static function find($data , $model, $condition){

        $query = array();

        foreach($data as $key => $item){

          $qry = null;

          if(!empty($item)){
            if(!empty($condition[$key])){
              if($condition[$key] == "LIKE"){
                $qry = [$key, "like", "%".$item."%"];
              }else if($condition[$key] == "%LIKE"){
                $qry = [$key, "like", "%".$item];
              }else if($condition[$key] == "LIKE%"){
                $qry = [$key, "like", $item."%"];
              }else{
                $qry = [$key,$condition[$key], $item];
              }
            }else{
                $qry = [$key,"=", $item];
            }
            array_push($query, $qry);
          }
        }

        $mdl = null;

        if(!empty($query)){
            $mdl = $model::where($query)->get();
        }else{
          $mdl = $model::all();
        }

        return $mdl;

    }

    public static function save($data, $model, $name_changes){

        $mdl = new $model;

        $idKey = $mdl->getKeyName();

        foreach($name_changes as $key => $item){
            if($item == $mdl->getKeyName()){
              $idKey = $key;
            }
        }

        if(!empty($data[$idKey])){
            $mdl = $model::find($data[$idKey]);
        }

        foreach($data as $key => $item){
            if($idKey != $key){
              if(!empty($name_changes[$key])){
                $mdl[$name_changes[$key]] = $item;
              }else{
                $mdl[$key] = $item;
              }
            }
        }

        $mdl->save();

        return $mdl;
    }

  }
?>

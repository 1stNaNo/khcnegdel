<?php

  class udb {
    function find($data , $condition){

        $query = array();;

        foreach($data as $key => $item){

          $qry = null;

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

          }

           array_push($query, $qry);
        }

        return $query;

    }
  }

?>

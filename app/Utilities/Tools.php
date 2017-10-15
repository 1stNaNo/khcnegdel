<?php
  namespace App\Utilities;

  class Tools {

    public static function treeNode($data , $all){

      $childs = array();

      if($all == true){
        $node = [];
        $node["id"] = 0;
        $node["text"] = trans('system.all');
        $node["state"] = [];
        $node["parent"] = "#";
        $node["state"]["opened"] = false;
        $node["children"] = false;
        array_push($childs, $node);
      }

      foreach($data as $item){
          $node = [];
          $node["id"] = $item->id;
          $node["text"] = $item->name;
          $node["state"] = [];

          if($item->parent_id == 0){
            $node["parent"] = "#";
            $node["state"]["opened"] = true;
          }else{
            $node["parent"] = intval($item->parent_id);
            $node["children"] = true;
            $node["state"]["opened"] = false;
          }

          if(!empty($item->type)){
              $node["type"] = $item->type;
          }

          array_push($childs, $node);
      }

      return $childs;
    }

  }
?>

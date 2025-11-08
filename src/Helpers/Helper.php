<?php 

  use Hexters\Rolevel\Helpers\Menu;

  if(! function_exists('rolevel')) {
    function rolevel () {
      return new Menu;
    }
  }
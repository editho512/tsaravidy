<?php
if(!function_exists("droit")){
    function droit(){
        return Config::get("constants.droit");
    }
}
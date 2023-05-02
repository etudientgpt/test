<?php

function start_session(){
    
    if(!session_id()){
        
        session_start();
        session_regenerate_id();
        return true;
    }
    
    else 
        return false;
}

function clear_session(){
    session_unset();
    session_destroy();
}

function is_connected(){
    
    if(isset($_SESSION['username']))
        return true;
    
    return false;    
}

function is_res(){
    
    if(is_connected()) {
        if(isset($_SESSION['role']) && $_SESSION['role'] == "Responsable")
            return true;
    }    

    return false;    
}

function is_coor(){

    if(is_connected()) {
        if(isset($_SESSION['role']) && $_SESSION['role'] == "Coordinateur")
            return true;
    }    

    return false; 

    
}

function is_stud(){
    
    if(is_connected()) {
        if(isset($_SESSION['role']) && $_SESSION['role'] == "Etudiant")
            return true;
    }    
    return false; 
}




function verif_user($name,$pass,&$role) {

    $json_users = file_get_contents("users.json");
    $php_users = json_decode($json_users,true);

    foreach($php_users['users'] as $validuser) {
        
        if( $validuser['username']== $name && $validuser['password']== $pass){
            $role = $validuser['role'];
            return true;
        }

    }

    return false;

}



?>
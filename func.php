<?php

const soult = "qwerty dvcde";
function PasswordHasher ($password){
    return sha1(soult.$password.soult);
}

function Autorization($login){
    // session_start();
    $_SESSION["Autorizzation"]=TRUE;
    $_SESSION["login"]=$login;
}
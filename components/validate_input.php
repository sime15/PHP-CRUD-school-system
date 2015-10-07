<?php

/* VALIDACIJA JIB BROJA KORISCENJEM AJAX TEHOLOGIJE */

/* 1 - ukljucivanje potrebnih fajlova (povezivanje sa bazom)*/
include "../incl/data.inc.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    /* 2 - uzimanje varijabli poslatih ajax tehnologijom */
    $var_name = $_POST['input_name'];
    $var_value = $_POST['input_value'];

    /* 3 - definisanje povratnih informacija u slucaju da JIB broj ima manje od osam cifara */
    if(strlen($var_value) < 8)
    {
        print json_encode(array('validation_state' => 'has-warning has-feedback','validation_message' => $var_name . ' je prekratak!','save_button' => 'disabled','glyphicon' => 'glyphicon-warning-sign'));
        return;
    }
    /* 4 - definisanje povratnih informacija u slucaju da JIB broj ima vise od osam cifara */
    else
    {
        if(strlen($var_value) > 8)
        {
            print json_encode(array('validation_state' => 'has-warning has-feedback','validation_message' => $var_name . ' je predug!','save_button' => 'disabled','glyphicon' => 'glyphicon-warning-sign'));
            return;
        }
        else
        {
            /* 5 - ukoliko jib broj ima osam cifara, ispitivanje da li on vec postoji u bazi i vracanje odgovarajucih inforamcija*/
            $sqlQuery = "SELECT * FROM skole WHERE skola_jib LIKE '".$var_value."'";
            $totalRecords = mysql_num_rows(mysql_query($sqlQuery));

            if($totalRecords == 0)
            {
                print json_encode(array('validation_state' => 'has-success has-feedback','validation_message' => $var_name.' je u redu!','save_button' => '','glyphicon' => 'glyphicon-ok'));
                return;
            }
            else
            {
                print json_encode(array('validation_state' => 'has-error has-feedback','validation_message' => 'Greska ovaj '.$var_name. ' vec postoji!','save_button' => 'disabled','glyphicon' => 'glyphicon-remove'));
                return;
            }
        }
    }
}
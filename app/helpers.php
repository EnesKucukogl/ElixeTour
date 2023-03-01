<?php

function viewLanguageSupport($arr){
    $new = array_filter(json_decode($arr), function ($var) {

        return  $var->symbol == Config::get('app.locale');

    });

    $translation = array_column($new, 'translation');
    $default_lang = array_column($new, 'default_lang');

    $translation = $translation[0];
    $default_lang = $default_lang[0];

    $translation =  ($translation == '') ?   $default_lang :  $translation;

    return $translation;
}

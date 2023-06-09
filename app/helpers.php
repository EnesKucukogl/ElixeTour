<?php

function viewLanguageSupport($arr)
{
    $new = array_filter(json_decode($arr), function ($var) {

        return $var->symbol == Config::get('app.locale');

    });

    $translation = array_column($new, 'translation');
    $default_lang = array_column($new, 'default_lang');

    $translation = $translation[0];
    $default_lang = $default_lang[0];

    $translation = ($translation == '') ? $default_lang : $translation;

    return $translation;
}

function getAccomodationType($arr,$accomodationId)
{
    $new = array_filter(json_decode($arr), function ($var) use ($accomodationId)  {

        return $var->accomodation_id == $accomodationId;

    });

    return $new;
}

function getImage($arr, $main_Id)
{
    $file_path = '';
    foreach ($arr as $value) {
        if ($value->general_id == $main_Id) {
            $file_path = $value->file_path;
        }
    }
    return $file_path;
}




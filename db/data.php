<?php

function read_json()
{
    try {
        $my_data = file_get_contents('db/movies.json');
        return $my_data;
    } catch (\Throwable $th) {
        return 'Error:' .$th;
    }
}


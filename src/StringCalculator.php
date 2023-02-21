<?php

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator{
    function add(string $numbers_to_add):int
    {
        if(empty($numbers_to_add))
            return 0;

        if(preg_match("/\/\//", $numbers_to_add))
        {
            $parts = explode("\n", $numbers_to_add, 2);
            $delimiter = explode("//", $parts[0])[1];
            $start_item = 1;
        }
        else
        {
            $delimiter = ",";
            $start_item = 0;
        }

        $numbers_to_add = preg_replace("/\n/", $delimiter, $numbers_to_add);
        $numbers_to_add_array = explode($delimiter, $numbers_to_add);
        $number_of_items_to_add = count($numbers_to_add_array);

        $added_number = 0;
        for($i = $start_item; $i < $number_of_items_to_add; $i++)
        {
            $added_number += intval($numbers_to_add_array[$i]);
        }

        return $added_number;
    }
}
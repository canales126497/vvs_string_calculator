<?php

namespace Deg540\PHPTestingBoilerplate;

use Exception;

class StringCalculator{
    /**
     * @throws Exception
     */
    function add(string $numbers_to_add):int
    {
        if(empty($numbers_to_add))
            return 0;

        if(preg_match("/\/\//", $numbers_to_add))
        {
            $parts = explode("\n", $numbers_to_add, 2);
            $especified_delimiters = explode("//", $parts[0])[1];
            $start_item = 1;
        }
        else
        {
            $start_item = 0;
        }

        if(isset($especified_delimiters) and preg_match("/[.*]/", $especified_delimiters))
        {
            $delimiters = explode("]", $especified_delimiters);

            for($i = 0; $i < count($delimiters); $i++)
            {
                $numbers_to_add = str_replace(substr($delimiters[$i], 1), ",", $numbers_to_add);
            }
        }
        elseif(isset($especified_delimiters))
        {
            $numbers_to_add = str_replace($especified_delimiters, ",", $numbers_to_add);
        }

        $numbers_to_add = str_replace("\n", ",", $numbers_to_add);
        $numbers_to_add_array = explode(",", $numbers_to_add);
        $number_of_items_to_add = count($numbers_to_add_array);

        $negatives = array();
        $added_number = 0;
        for($i = $start_item; $i < $number_of_items_to_add; $i++)
        {
            $number = intval($numbers_to_add_array[$i]);
            if($number < 0)
            {
                $negatives[] = $number;$added_number += $number;
            }
            elseif($number > 1000)
            {
                continue;
            }
            else
            {
                $added_number += $number;
            }
        }

        if(count($negatives) > 0)
        {
            $message = "negativos no soportados: ".$negatives[0];
            for($i = 1; $i < count($negatives); $i++){
                $message .= ", ".$negatives[$i];
            }

            throw new Exception($message, 0);
        }

        return $added_number;
    }
}
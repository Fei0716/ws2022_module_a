<?php
    $numbers = range(1,40);


    // Function to format each number for the "Original Array" representation
    function formatNumber($index, $num) {
        return "[$index] => $num";
    }

    // Apply the formatNumber function to each element of the array
    $formattedNumbers = array_map('formatNumber', array_keys($numbers), $numbers);

    // Output the formatted array
    echo "Original Array<br>(<br> &ensp; " . implode(",<br>&ensp; ", $formattedNumbers) . "<br>)<br>";

    if(isset($_GET['factor'])){
        $factor = $_GET['factor'];
        $modifyNumbers = function ($index, $num) use ($factor){
            if($num  % $factor == 0){
                return "[$index] => $num is a multiple of $factor **";
            }
            return "[$index] => $num";
        };
        $modifiedNumbers = array_map($modifyNumbers, array_keys($numbers), $numbers);
     echo "Modified Array<br>(<br> &ensp; " . implode(",<br>&ensp; ", $modifiedNumbers) . "<br>)<br>";

    }

?>
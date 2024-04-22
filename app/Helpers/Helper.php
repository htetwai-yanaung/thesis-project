<?php

if (!function_exists('toYear')) {

    function toYear($year = null)
    {
        switch($year) {
            case 1:
                return '1st Year';
                break;
            case 2:
                return '2nd Year';
                break;
            case 3:
                return '3rd Year';
                break;
            case 4:
                return '4th Year';
                break;
            case 5:
                return '5th Year';
                break;
            case 6:
                return '6th Year';
                break;
            default:
                return '';
        }
    }
}

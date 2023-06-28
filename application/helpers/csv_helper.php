<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('array_to_csv')) {
    function array_to_csv($array, $filename = "export.csv", $delimiter = ",") {
        $CI = &get_instance();
        $CI->load->helper('download');

        $output = fopen('php://output', 'w');

        // Write CSV headers
        fputcsv($output, array_keys($array[0]), $delimiter);

        // Write CSV rows
        foreach ($array as $row) {
            fputcsv($output, $row, $delimiter);
        }

        // Close output file
        fclose($output);

        // Force download the CSV file
        force_download($filename, ob_get_clean());
    }
}

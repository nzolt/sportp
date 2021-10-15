#!/usr/bin/php
<?php

use App\Facade\RentCalculatorFacade;

ini_set('auto_detect_line_endings',TRUE);
date_default_timezone_set('UTC');
require __DIR__ . '/vendor/autoload.php';

$climate = new League\CLImate\CLImate;

$climate->out('Please enter the path and filename for input data');
$climate->out('E.g.: /var/tmp/rent-report.csv');

$input = $climate->input('Path and filename for input data: ');
$climate->out('Or just hit ENTER for default "./data.csv"');
$input->defaultTo(__DIR__ . '/data.csv');
$csvFilename = $input->prompt();

$options  = [
    'details' => 'Generate details',
    'file' => 'Write to file',
];
$input    = $climate->checkboxes('Please generate all of the following:', $options);
$climate->out('');
$climate->out('Multiple options can be selected');
$details = $input->prompt();

$csvFileOut = '';
$returnSelect = 'No';
if(in_array('file', $details)){
    $climate->info('The keyboard arrows to navigate, spacebar to select an item.');
    $options  = ['Yes', 'No'];
    $input    = $climate->checkboxes('View result details in terminal:', $options);
    $return = $input->prompt();
    if(count($return)){
        $returnSelect = $return[0];
    }
    $output = $climate->input('Path and filename for output data: ');
    $climate->out('Default output to: ./data.csv');
    $output->defaultTo('rent-report.csv');
    $csvFileOut = $output->prompt();
}

$rents = RentCalculatorFacade::calculate($csvFilename, $csvFileOut, $details, $returnSelect);
if($returnSelect == 'Yes'){
    $climate->table($rents['details']);
}
$climate->out('');
$climate->out('=======================================================');
$climate->red('Total rent average: ' . $rents['totalAvg']);
$climate->out('=======================================================');
if(in_array('file', $details)) {
    $climate->blue($csvFileOut . ' file created successfully!');
}

ini_set('auto_detect_line_endings',FALSE);

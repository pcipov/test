<?php


// SETTINGS
const REPOSITORY = 'https://github.com/pcipov/test.git';
const LOGIN = 'pcipov';
const TOKEN = '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';
const BRANCH = 'master';
const DIR = '~/latexmania.sk/sub/test';


// CHECK BRANCH
if (isset($_POST['payload'])) {
    $data = (array)json_decode($_POST['payload']);
    $array = explode('/', $data['ref']);
    if (trim(end($array)) != BRANCH)
        exit;
}


// CHANGE DIRECTORY
command('cd ' . DIR);

// GIT ADD
command('git fetch');

// GIT RESET
command('git reset --hard');

// GIT LOG
command('git log -1');




function command($command, $log = true) {
    $output = shell_exec($command);
    if($log) {
        echo strtr($command, [TOKEN=>'TOKEN']) . '<br>' . $output . '<br>';
    }
}

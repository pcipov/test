<?php


// SETTINGS
const GITHUB_REPOSITORY = 'https://github.com/pcipov/test.git';
const GITHUB_LOGIN = 'pcipov';
const GITHUB_TOKEN = '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';
const GITHUB_BRANCH = 'master';
const LOCAL_DIR = '~/latexmania.sk/sub/test';
const LOCAL_TOKEN = 'QNj3x2FmtMpkRzb';
const LOG = true;

// CHECK LOCAL TOKEN
if( !isset($_GET['token']) || $_GET['token'] !== LOCAL_TOKEN ) {
    exit;
}

// CHECK BRANCH
if (isset($_POST['payload'])) {
    $data = (array)json_decode($_POST['payload']);
    $array = explode('/', $data['ref']);
    if (trim(end($array)) != GITHUB_BRANCH)
        exit;
}


$commands = [
    'cd ' . LOCAL_DIR,
    'git fetch',
    'git reset --hard',
    'git log -1',
    'composer update',
    'npm run build',
];


foreach($commands as $command) {
    $output = shell_exec($command);
    if(LOG) {
        echo strtr($command, [GITHUB_TOKEN=>'TOKEN']) . '<br>' . $output . '<br>';
    }
}

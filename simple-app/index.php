<?php
ignore_user_abort(true);

echo "Boot worker PID: " . getmypid() . "\n";

$counter = 0;

$handler = function () use (&$counter) {
    $counter++;
    echo "Worker PID: " . getmypid() . " - Counter: $counter\n";
};

\frankenphp_handle_request($handler);

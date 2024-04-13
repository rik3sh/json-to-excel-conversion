<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('job-haru', function() {
    return true;
});

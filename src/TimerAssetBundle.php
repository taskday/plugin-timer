<?php

namespace Performing\Taskday\Timer;

use Taskday\Bundles\AssetBundle;

class TimerAssetBundle extends AssetBundle
{
    function scripts(): array
    {
        return [
            __DIR__ . '/../dist/taskday-timer.es.js'
        ];
    }

    function styles(): array
    {
        return [
            //
        ];
    }
}

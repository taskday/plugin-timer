<?php

namespace Performing\Taskday\Timer;

use Taskday\Bundles\AssetBundle;
use Taskday\Base\Plugin;
use Performing\Taskday\Timer\Fields\TimerField;

class TimerPlugin extends Plugin
{
    public string $handle = 'timer';

    public string $description;

    function bundle(): ?AssetBundle
    {
        return new TimerAssetBundle;
    }

    public function fields(): array
    {
        return [
            new TimerField()
        ];
    }

    public function widgets(): array
    {
        return [];
    }
}

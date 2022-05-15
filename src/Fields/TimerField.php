<?php

namespace Performing\Taskday\Timer\Fields;

use Taskday\Base\Field;

class TimerField extends Field
{
    public function getSorter() 
    {
        return new TimerSorter();
    }
}

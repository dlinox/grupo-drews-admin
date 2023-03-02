<?php

namespace Intervention\Image\Gd\Commands;

use Intervention\Image\Commands\AbstractCommand;

class BrightnessCommand extends AbstractCommand
{
    /**
     * Changes image brightness
     *
     * @param  \Intervention\Image\Image $image
     * @return boolean
     */
    public function execute($image)
    {
        $level = $this->argument(0)->between(-100, 100)->required()->value();

<<<<<<< HEAD
        return imagefilter($image->getCore(), IMG_FILTER_BRIGHTNESS, round($level * 2.55,0));
=======
        return imagefilter($image->getCore(), IMG_FILTER_BRIGHTNESS, ($level * 2.55));
>>>>>>> 0564e0bcf024b7bce32be3668e25bd538b8bca3a
    }
}

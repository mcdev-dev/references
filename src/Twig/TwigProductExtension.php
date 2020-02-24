<?php

namespace App\Twig;

use Twig\TwigFilter;
use Twig\Extension\AbstractExtension;

class TwigProductExtension extends AbstractExtension 
{
    public function getFilters() 
    {
        return 
        [
            new TwigFilter('date_format', [$this, 'dateFormatFilter'], ['is_safe' => ['html']]),
        ];
    }

    public function dateFormatFilter() 
    {
    }

}

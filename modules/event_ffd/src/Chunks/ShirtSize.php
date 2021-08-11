<?php

namespace Digraph\Modules\event_ffd\Chunks;

use Digraph\Modules\ous_event_management\Chunks\AbstractChunk;
use Formward\Fields\Email;
use Formward\Fields\Number;

class ShirtSize extends AbstractChunk
{
    protected $label = 'T-Shirt size';

    public function body_complete()
    {
        $name = $this->name;
        $signup = $this->signup;
        echo "<dl>";
        if ($signup["$name.shirt"]) {
            echo "<dt>Shirt size</dt>";
            echo "<dd>" . $signup["$name.shirt"] . "</dd>";
        }
        echo "</dl>";
    }

    public function body_incomplete()
    {
        $this->body_complete();
    }

    protected function form_map(): array
    {
        $name = $this->name;
        return [
            'shirt' => [
                'label' => 'Preferred shirt size',
                'class' => 'select',
                'field' => "$name.shirt",
                'options' => [
                    "S" => "Small",
                    "M" => "Medium",
                    "L" => "Large",
                    "XL" => "XLarge",
                    "2XL" => "2XLarge",
                    "3XL" => "3XLarge",
                ],
                'required' => true,
                'weight' => 100,
                'tips' => ['We\'ll do our best to provide your size, but can\'t guarantee that you\'ll receive this shirt size at check in.']
            ]
        ];
    }
}

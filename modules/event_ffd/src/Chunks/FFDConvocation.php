<?php

namespace Digraph\Modules\event_ffd\Chunks;

use Digraph\Modules\ous_event_management\Chunks\AbstractChunk;
use Formward\Fields\Email;
use Formward\Fields\Number;

class FFDConvocation extends AbstractChunk
{
    protected $label = 'First year convocation';

    public function body_complete()
    {
        $name = $this->name;
        $signup = $this->signup;
        echo "<dl>";
        if ($signup["$name.shirt"]) {
            echo "<dt>Shirt size</dt>";
            echo "<dd>" . $signup["$name.shirt"] . "</dd>";
        }
        if ($signup["$name.guests"]) {
            echo "<dt>Expected guests</dt>";
            echo "<dd>" . $signup["$name.guests"] . "</dd>";
        }
        if ($signup["$name.guestemail"]) {
            echo "<dt>Family/guest email</dt>";
            echo "<dd>" . $signup["$name.guestemail"] . "</dd>";
        }
        if ($signup["$name.familyalumni"]) {
            echo "<dt>Alumni parents</dt>";
            echo "<dd>" . htmlspecialchars($signup["$name.familyalumni"]) . "</dd>";
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
            ],
            'guests' => [
                'label' => 'Expected guests',
                'class' => Number::class,
                'field' => "$name.guests",
                'weight' => 200,
                'default' => 0
            ],
            'familyemail' => [
                'label' => 'Family/guest email',
                'class' => Email::class,
                'field' => "$name.guestemail",
                'weight' => 300,
                'tips' => [
                    'Used to contact your family or guests with any instructions for attendance as guests. You can leave it blank if you don\'t have any guests coming, or don\'t want us to contact them.'
                ]
            ],
            'familyalumni' => [
                'label' => 'Alumni parents',
                'class' => 'text',
                'field' => "$name.familyalumni",
                'weight' => 300,
                'tips' => [
                    'If your parents or guardians are UNM alumni, enter their name(s) here so we can provide this info to the Alumni Association.'
                ]
            ]
        ];
    }
}

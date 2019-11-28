<?php

namespace App\Participants\Views;

class BaseForm extends \Core\Views\Form {

    public function __construct($data = []) {
        $this->data = [
            'fields' => [
                'name' => [
                    'label' => 'Jusu Vardas',
                    'type' => 'text',
                ],
                'comment' => [
                    'label' => 'Jusu Atsiliepimas',
                    'type' => 'text',
                ], 
            ],
            'buttons' => [
                'submit' => [
                    'title' => 'Submit',
                ],
            ]
        ];
    }

}

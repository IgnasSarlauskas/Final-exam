<?php

namespace App\Participants\Views;

class ApiForm extends \Core\Views\Form {

    public function __construct($data = []) {
        $this->data = [
            'fields' => [
                'id' => [
                    'extra' => [
                        'validators' => [
//                            'validate_not_empty'
                        ]
                    ]
                ],
                'name' => [
                    'extra' => [
                        'validators' => [
                            'validate_not_empty'
                        ]
                    ]
                ],
                'comment' => [
                    'extra' => [
                        'validators' => [
                            'validate_not_empty',
                            'validate_comment_length',
                        ]
                    ]
                ],
            ],
            'callbacks' => [
                'success' => 'form_success',
                'fail' => 'form_fail',
            ]
        ];
    }

}

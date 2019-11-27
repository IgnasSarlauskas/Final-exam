<?php

function validate_login($filtered_input, &$form) {
    $login_success = \App\App::$session->login(
            $filtered_input['email'], $filtered_input['password']
    );

    if (!$login_success) {
        $form['fields']['password']['error'] = 'Prisijungimo duomenys neteisingi!';
        $form['fields']['password']['value'] = '';
        return false;
    }

    return true;
}

function validate_mail($field_value, &$field) {
    $modelUser = new \App\Users\Model();
    $users = $modelUser->get(['email' => $field_value]);
    if ($users) {
        $field['error'] = 'Vartotojas tokiu el.paštu jau registruotas!';
        return false;
    }

    return true;
}

function validate_year($field_value, &$field) {
    if ($field_value > date('Y')) {
        $field['error'] = 'Neteisinga data!';
        return false;
    }

    return true;
}

function validate_input_length($field_value, &$field) {
    if (strlen($field_value) >= 40) {
        $field['error'] = 'Negalite viršyti 40 simbolių';
    } else {
        return true;
    }
}

function validate_comment_length($field_value, &$field) {
    if (strlen($field_value) >= 500) {
        $field['error'] = 'Negalite viršyti 500 simbolių';
    } else {
        return true;
    }
}


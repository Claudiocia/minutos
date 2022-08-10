<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClienteAutoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nome', 'text', [
                'label' => 'Nome',
            ])
            ->add('email', 'text', [
                'label' => 'Email'
            ]);
    }
}

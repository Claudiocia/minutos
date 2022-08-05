<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClienteForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nome', 'text')
            ->add('email', 'text')
            ->add('signed', 'text')
            ->add('review', 'text')
            ->add('foto_id', 'text');
    }
}

<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RateForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('cliente_id', 'text')
            ->add('nota', 'text')
            ->add('title', 'text')
            ->add('texto', 'text')
            ->add('public', 'text');
    }
}

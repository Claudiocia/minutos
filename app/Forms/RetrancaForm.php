<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RetrancaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nome', 'text');
    }
}

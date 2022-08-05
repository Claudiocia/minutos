<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RazionForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('number', 'text')
            ->add('texto', 'text')
            ->add('title', 'text')
            ->add('priori', 'text')
            ->add('ativo', 'text')
            ->add('icon', 'text')
            ->add('color', 'text');
    }
}

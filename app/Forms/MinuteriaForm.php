<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MinuteriaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('email', 'text', [
                'label' => 'Email',
                'attr' => ['placeholder' => 'digite seu email', 'required' => 'required']
            ]);
    }
}

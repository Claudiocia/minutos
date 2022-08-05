<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FotoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nome', 'text')
            ->add('foto_path', 'text')
            ->add('origin_name', 'text')
            ->add('using', 'text')
            ->add('legenda', 'text')
            ->add('credito', 'text')
            ->add('foto_thumb', 'text');
    }
}

<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NoticiaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text')
            ->add('resumo', 'text')
            ->add('texto', 'text')
            ->add('fonte', 'text')
            ->add('link', 'text')
            ->add('data_cria', 'text')
            ->add('data_edit', 'text')
            ->add('user_id', 'text')
            ->add('retranca_id', 'text');
    }
}

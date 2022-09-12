<?php

namespace App\Forms\Site;

use Kris\LaravelFormBuilder\Form;

class CausaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title_causa', 'text', [
                'label' => 'Título secção NOSSA CAUSA'
            ])
            ->add('apoio_causa', 'text', [
                'label' => 'Apoio ao titulo'
            ])
            ->add('text_causa', 'textarea', [
                'label' => 'Texto nossa causa',
                'attr' => ['class' => 'ckeditor form-control'],
            ])
            ->add('causa_final', 'text', [
                'label' => 'Frase final do texto'
            ])
            ->add('foto', 'hidden', [
                'value' => false,
            ]);
    }
}

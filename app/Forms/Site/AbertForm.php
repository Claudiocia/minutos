<?php

namespace App\Forms\Site;

use Kris\LaravelFormBuilder\Form;

class AbertForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title_site', 'text', [
                'label' => 'Titulo principal'
            ])
            ->add('apoio_title', 'text', [
                'label' => 'Frase de apoio'
            ])
            ->add('text_abert', 'textarea', [
                'label' => 'Texto de abertura',
                'attr' => ['class' => 'ckeditor form-control'],
            ])
            ->add('site_final', 'text', [
                'label' => 'Frase final do texto de abertura'
            ])
            ->add('text_botton_site', 'text', [
                'label' => 'Texto que vai no botão'
            ])
            ->add('cancel_one', 'text', [
                'label' => 'Texto abaixo do botão'
            ])
            ->add('cancel_two', 'text', [
                'label' => '2º texto abaixo do botão'
            ])
            ->add('foto', 'hidden', [
                'value' => false,
            ]);
    }
}

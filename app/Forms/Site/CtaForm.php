<?php

namespace App\Forms\Site;

use Kris\LaravelFormBuilder\Form;

class CtaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title_cta', 'text', [
                'label' => 'Título da secção'
            ])
            ->add('apoio_cta', 'text', [
                'label' => 'Frase de apoio ao Título'
            ])
            ->add('final_cta', 'text', [
                'label' => 'Frase abaixo do botão de assinar'
            ])
            ->add('foto', 'hidden', [
                'value' => false,
            ]);
    }
}

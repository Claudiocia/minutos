<?php

namespace App\Forms\Site;

use Kris\LaravelFormBuilder\Form;

class FooterForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title_footer', 'text', [
                'label' => 'Título do Rodapé do site'
            ])
            ->add('text_footer', 'textarea', [
                'label' => 'Texto do rodapé do site',
                'attr' => ['class' => 'ckeditor form-control'],
            ])
            ->add('foto', 'hidden', [
                'value' => false,
            ]);
    }
}

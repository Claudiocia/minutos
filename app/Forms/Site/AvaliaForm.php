<?php

namespace App\Forms\Site;

use Kris\LaravelFormBuilder\Form;

class AvaliaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title_review', 'text', [
                'label' => 'Título secção Opinião'
            ])
            ->add('apoio_review', 'text', [
                'label' => 'Apoio ao título',
            ])
            ->add('foto', 'hidden', [
                'value' => false,
            ]);
    }
}

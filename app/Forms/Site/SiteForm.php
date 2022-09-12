<?php

namespace App\Forms\Site;

use Kris\LaravelFormBuilder\Form;

class SiteForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('site_nome', 'text', [
                'label' => 'Nome do Site',
                'att' => ['required' => 'required']
            ])
            ->add('site', 'hidden', [
                'value' => true,
            ])
            ->add('foto', 'hidden', [
                'value' => false,
            ]);
    }
}

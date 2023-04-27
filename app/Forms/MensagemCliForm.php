<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class MensagemCliForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text', [
                'label' => 'Titulo da Mernsagem',
                'attr' => ['required' => 'required']
            ])
            ->add('data', 'date', [
                'label' => 'Data',
                'attr' => ['required' => 'required']
            ])
            ->add('mensagem', 'textarea', [
                'attr' => ['required' => 'required']
            ]);
    }
}

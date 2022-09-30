<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClienteAutoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nome', 'text', [
                'label' => 'Nome',
                'attr' => ['placeholder' => 'digite seu nome', 'required' => 'required'],
            ])
            ->add('email', 'text', [
                'label' => 'Email',
                'value' => $this->model ? $this->model->email : '',
                'attr' => ['placeholder' => 'digite seu email', 'required' => 'required'],
            ])
            ->add('terms', 'checkbox', [
                'label' => 'Eu concordo com os Termos do Serviço e com a Política de Privacidade',
                'selected' => false,
            ]);
    }
}

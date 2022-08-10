<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ClienteForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nome', 'text', [
                'label' => 'Nome',
                'label_attr' => ['class' => 'block label-form'],
            ])
            ->add('email', 'text', [
                'label' => 'Email',
                'label_attr' => ['class' => 'block label-form'],
            ])
            ->add('signed', 'choice', [
                'label' => 'Assinante',
                'choices' => [1 => 'Ativo', 2 => 'Inativo'],
                'label_attr' => ['class' => 'block label-form'],
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? $this->model->signed : 1,
                'multiple' => false,
                'expanded' => true,
            ]);
    }
}

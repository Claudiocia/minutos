<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
            ])
            ->add('email', 'text', [
                'label' => 'Email',
            ])
            ->add('role', 'choice', [
                'label' => 'Administrador',
                'label_attr' => ['class' => 'control-label required'],
                'choices' => ['2' => 'Sim', '1' => 'Não'],
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? [$this->model->role] : [1],
                'multiple' => false,
                'expanded' => true,
                ]);
    }
}

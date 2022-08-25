<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RateForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('cliente', 'text', [
                'label' => 'Assinante',
                'value' => $this->model->cliente->nome,
                'attr' => ['disabled' => 'disabled'],
            ])
            ->add('id', 'hidden', [
                'value' => $this->model->id,
            ])
            ->add('nota', 'text', [
                'label' => 'Estrelas',
                'attr' => ['disabled' => 'disabled'],
            ])
            ->add('title', 'text', [
                'label' => 'Título',
                'attr' => ['required' => 'required'],
            ])
            ->add('texto', 'textarea', [
                'label' => 'Comentário',
                'attr' => ['required' => 'required'],
            ])
            ->add('public', 'choice', [
                'label' => 'Avaliação publicada',
                'choices' => ['s' => 'Publicada', 'n' => 'Não'],
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model->public,
                'multiple' => false,
                'expanded' => true,
            ]);
    }
}

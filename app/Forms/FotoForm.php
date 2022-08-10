<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FotoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id', 'hidden', [
                'value' => $this->model->id,
            ])
            ->add('legenda', 'text', [
                'label' => 'Legenda',
                'label_attr' => ['class' => 'block label-form'],
            ])
            ->add('credito', 'text', [
                'label' => 'Créditos',
                'label_attr' => ['class' => 'block label-form'],
            ])
            ->add('using', 'choice', [
                'label' => 'Aplicação',
                'choices' => ['Notícia' => 'Notícia', 'Newsletter' => 'Newsletter', 'Site' => 'Site', 'Parceiro' => 'Parceiro'],
                'label_attr' => ['class' => 'block label-form'],
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                    'attr' => $this->model ? [ 'selected' => $this->model->using] : [ 'selected' => false],
                ],
                'multiple' => false,
                'expanded' => true,
            ]);
    }
}

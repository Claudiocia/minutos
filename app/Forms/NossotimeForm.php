<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NossotimeForm extends Form
{
    public function buildForm()
    {
        $choices = ['Comercial' => 'Comercial', 'Desenvolvedor' => 'Desenvolvedor', 'Design' => 'Design', 'Editor' => 'Editor', 'Ilustrador' => 'Ilustrador' ,'Redator' => 'Redator' ];
        $this
            ->add('nome', 'text', [
                'label' => 'Nome',
                'attr' => ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required'],
            ])
            ->add('foto', 'hidden', [
                'value' => false,
            ])
            ->add('funcao', 'choice', [
                'label' => 'Função',
                'attr' => ['class' => 'form-control', 'required' => 'required'],
                'choices' => $choices,
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'empty_value' => 'Selecione...',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('ativo', 'choice', [
                'label' => 'Ativo',
                'attr' => ['class' => 'form-control', 'required' => 'required'],
                'choices' => ['s' => 'Sim', 'n' => 'Não'],
                'choice_options' => [
                    'wrapper' => ['class' => 'my-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? $this->model->ativo : 'n',
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('texto', 'textarea', [
                'label' => 'Texto',
                'attr' => ['class' => 'ckeditor form-control', 'required' => 'required'],
            ])
            ->add('twitter', 'text', [
                'label' => 'Twitter',
                'attr' => ['class' => 'form-control', 'maxlength' => '255'],
            ])
            ->add('face', 'text', [
                'label' => 'Facebook',
                'attr' => ['class' => 'form-control', 'maxlength' => '255'],
            ])
            ->add('insta', 'text', [
                'label' => 'Instagram',
                'attr' => ['class' => 'form-control', 'maxlength' => '255'],
            ])
            ->add('linked', 'text', [
                'label' => 'Linkedin',
                'attr' => ['class' => 'form-control', 'maxlength' => '255'],
            ]);
    }
}

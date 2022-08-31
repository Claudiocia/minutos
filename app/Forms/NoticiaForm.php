<?php

namespace App\Forms;

use App\Models\Retranca;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\Form;

class NoticiaForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('retranca_id', 'choice', [
                'label' => 'Editoria',
                'choices' => Retranca::all()->pluck('nome', 'id')->toArray(),
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'empty_value' => 'Selecione...',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('title', 'text', [
                'label' => 'Título',
                'attr' => ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required']
            ])
            ->add('resumo', 'text', [
                'label' => 'Resumo',
                'attr' => ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required'],
            ])
            ->add('texto', 'textarea', [
                'label' => 'Texto',
                'attr' => ['class' => 'ckeditor form-control', 'required' => 'required'],
            ])
            ->add('fonte', 'text', [
                'attr' => ['class' => 'form-control', 'maxlength' => '255', 'required' => 'required'],
            ])
            ->add('link', 'text', [
                'attr' => ['class' => 'form-control', 'maxlength' => '255'],
            ])
            ->add('foto', 'hidden', [
                'value' => false,
            ])
            ->add('user_id', 'hidden', [
                'value' =>Auth::id()
            ])
            ->add('public', 'choice', [
                'label' => 'Noticia publicada',
                'choices' => ['s' => 'Publicada', 'n' => 'Não'],
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? $this->model->public : 'n',
                'multiple' => false,
                'expanded' => true,
            ]);
    }
}

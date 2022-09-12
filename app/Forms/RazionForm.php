<?php

namespace App\Forms;

use App\Models\Site;
use Kris\LaravelFormBuilder\Form;

class RazionForm extends Form
{
    public function buildForm()
    {
        //dd($this->razions);
        $site = Site::first();
        $icons = [
            '/bolsa-300.png' => 'Bolsa',
            '/cafe-300.png' => 'Café',
            '/cientec-300.png' => 'Ciencia & Tecnologia',
            '/dolar-300.png' => 'Dólar',
            '/fast-300.png' => 'Velocidade',
            '/globo-300.png' => 'Planeta',
            '/internet-300.png' => 'Internet',
            '/jornal-300.png' => 'Jornal',
            '/tempo-300.png' => 'Tempo',
        ];
        $colors = [
            'azul' => 'Azul',
            'laranja' => 'Laranja',
            'preto' => 'Preto',
            'rosa' => 'Rosa',
            'verde' => 'Verde',
            'vermelho' => 'Vermelho',
        ];
        $this
            ->add('title_section', 'text', [
                'label' => 'Título da secção',
                'value' => $this->model ? $site->title_razion : '',
            ])
            ->add('number', 'text', [
                'label' => 'Número de ordem no site'
            ])
            ->add('title', 'text', [
                'label' => 'Nome da razão'
            ])
            ->add('texto', 'text', [
                'label' => 'Texto da razão'
            ])
            ->add('ativo', 'choice', [
                'label' => 'Ativar',
                'label_attr' => ['class' => 'control-label'],
                'choices' => ['s' => 'Sim', 'n' => 'Não'],
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => $this->model ? $this->model->ativo : 'n',
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('icon', 'choice', [
                'label' => 'Ícone',
                'label_attr' => ['class' => 'control-label'],
                'choices' => $icons,
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'empty_value' => $this->model ? $this->model->icon : 'Selecione...',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('color', 'choice', [
                'label' => 'Cor do ícone',
                'label_attr' => ['class' => 'control-label'],
                'choices' => $colors,
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper-my'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'empty_value' => $this->model ? $this->model->color : 'Selecione...',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('razion', 'hidden', [
                'value' => true,
            ]);
    }
}

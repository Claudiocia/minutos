<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ParceiroForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nome', 'text')
            ->add('cnpj', 'text')
            ->add('tele', 'text')
            ->add('end', 'text')
            ->add('bairro', 'text')
            ->add('cidade', 'text')
            ->add('uf', 'text')
            ->add('site', 'text')
            ->add('email', 'text')
            ->add('slogan', 'text')
            ->add('data_ini', 'text')
            ->add('data_fim', 'text')
            ->add('foto_id', 'text');
    }
}

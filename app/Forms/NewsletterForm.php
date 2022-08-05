<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class NewsletterForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('numb_edicao', 'text')
            ->add('data_edicao', 'text')
            ->add('enviada', 'text')
            ->add('user_id', 'text');
    }
}

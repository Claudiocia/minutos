<?php

namespace App\Forms\Site;

use Kris\LaravelFormBuilder\Form;

class RelFotoSiteForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('site', 'text')
            ->add('foto_id', 'text')
            ->add('foto', 'text');
    }
}

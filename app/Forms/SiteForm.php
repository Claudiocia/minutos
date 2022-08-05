<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SiteForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title_site', 'text')
            ->add('apoio_title', 'text')
            ->add('text_abert', 'textarea')
            ->add('site_final', 'text')
            ->add('text_botton_site', 'text')
            ->add('cancel_one', 'text')
            ->add('cancel_two', 'text')
            ->add('title_razion', 'text')
            ->add('apoio_razion','text')
            ->add('title_causa', 'text')
            ->add('apoio_causa', 'text')
            ->add('text_causa', 'textarea')
            ->add('causa_final', 'text')
            ->add('title_review', 'text')
            ->add('apoio_review', 'text')
            ->add('title_cta', 'text')
            ->add('apoio_cta', 'text')
            ->add('title_footer', 'text')
            ->add('text_footer', 'textarea');
    }
}

<?php

namespace App\Form;

use App\Entity\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PageType.
 * @codeCoverageIgnore
 */
class PageType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('language')
            ->add('content')
        ;
    }

    /**
     * Dans une API, il faut obligatoirement désactiver la protection CSRF (Cross-Site Request Forgery).
     * Nous n’utilisons pas de session et l’utilisateur de l’API peut appeler cette methode sans se soucier de
     * l’état de l’application : l’API doit rester sans état : stateless.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
            'csrf_protection' => false,
        ]);
    }
}

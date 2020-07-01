<?php

namespace App\Form;

use App\Entity\French;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PageType.
 *
 * @codeCoverageIgnore
 */
class FrenchType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('word')
            ->add('description')
            ->add('exemple')
            ->add('url')
            ->add('type')
            ->add('language')
            ->add('status')
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
            'data_class' => French::class,
            'csrf_protection' => false,
        ]);
    }
}

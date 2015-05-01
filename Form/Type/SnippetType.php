<?php

namespace Kamran\CodesnippetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class SnippetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('filename','text',array(
            'label'=>false,
            'required'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Filename'
            ),
        ));
        $builder->add('language','choice',array(
            'label'=>false,
            'required'=>false,
            'empty_value' => 'Choose langauge',
            'empty_data'  => 'php',
            'choices'   => array(
                'php'   => 'PHP',
                'twig' => 'Twig',
                'html' => 'Html',
                'css' => 'CSS',
                'js'   => 'Javascript',
            ),
            'preferred_choices' => array('php'),
            'attr' => array(
                'class' => 'form-control',
            ),
        ));
        $builder->add('codetext','textarea',array(
            'required'=>false,
            'attr' => array(
                'class' => 'codetext form-control',
            ),
        ));
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kamran\CodesnippetBundle\Entity\Snippet',
        ));
    }


    public function getName()
    {
        return 'snippet_form';
    }

    public function getParent()
    {
        return 'form';
    }
}
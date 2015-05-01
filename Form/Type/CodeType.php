<?php

namespace Kamran\CodesnippetBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

 
class CodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title','text',array(
            'label'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Title of Snippet'
            ),
        ));
        $builder->add('tags', 'entity', array(
            'class' => 'KamranTagsBundle:TechnologyTags',
            'multiple' => true,
            'expanded' => true,
            'attr' => array(
                'class' => 'form-control',
            ),
        ));

        $builder->add('comment','textarea',array(
            'label'=>false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Comments'
            ),
        ));
        $builder->add('snippets','collection',array(
            'type'=> new SnippetType(),
            'label' => false,
            'allow_add' => true,
            'allow_delete' => true,
            //'by_reference' => false,
            //'attr' => array('class' => 'code-container'),
        ));
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kamran\CodesnippetBundle\Entity\Code',
        ));
    }
 
    public function getName()
    {
        return 'code_form';
    }
}
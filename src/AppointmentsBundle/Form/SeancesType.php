<?php

namespace AppointmentsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeancesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('heurDebut', TimeType::class, array(
                        'widget' => 'single_text',
                        'html5' => false,
                    ))
                ->add('heurFin', TimeType::class, array(
                    'widget' => 'single_text',
                    'html5' => false,
                ))
                ->add('calendrie');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppointmentsBundle\Entity\Seances'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appointmentsbundle_seances';
    }


}

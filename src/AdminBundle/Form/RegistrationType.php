<?php
// src/AppBundle/Form/RegistrationType.php

namespace AdminBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class RegistrationType extends AbstractType

{
   public function buildForm(FormBuilderInterface $builder, array $options)

   {
       $builder->add('avatar',    ImageType::class);

   }

   public function getParent()

   {
       return 'FOS\UserBundle\Form\Type\RegistrationFormType';
   }

   public function getBlockPrefix()

   {
       return 'app_user_registration';
   }

   public function getName()

   {
       return $this->getBlockPrefix();
   }


}

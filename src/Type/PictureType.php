<?php

namespace App\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class PictureType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('file_upload', FileType::class, [
          'label' => 'Your picture (*)',
      ])
      ->add('name', TextType::class, [
          'label' => 'Name for this picture (*)',
      ])
      ->add('author', TextType::class, [
          'label' => 'You can tell us who you are, made up names are welcome !',
      ])
      ->add('description', TextareaType::class, [
          'label' => 'Gives us a description if you want.',
      ]);
  }
}
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
          'label' => 'Please choose a name or catch phrase for this picture (*)',
          'attr' => [
              'placeholder' => 'Something short like "Ouh, need that one badly !"',
          ],
      ])
      ->add('author', TextType::class, [
          'label' => 'Tell us who you are, made up names are welcome ! (*)',
          'attr' => [
              'placeholder' => 'But try to keep the same each time if you want us to remember you ;)',
          ],
      ])
      ->add('description', TextareaType::class, [
          'label' => 'Gives us a description if you want.',
          'attr' => [
              'placeholder' => 'Oh well we have no idea what you can bring here, surprise us !',
          ],
      ]);
  }
}
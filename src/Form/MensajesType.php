<?php

namespace App\Form;

use App\Entity\Mensaje;
use App\Entity\Banda;
use App\Entity\Modo;
use App\Entity\User;
use App\Repository\BandaRepository;
use App\Repository\ModoRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MensajesType extends AbstractType
{
    private $banda;
    private $modo;
    private $usuario;

    public function __construct(BandaRepository $banda, ModoRepository $modo, UserRepository $usuario)
    {
        $this->banda = $banda;
        $this->modo = $modo;
        $this->usuario = $usuario;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('FechaHoraMensaje', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('Modo', EntityType::class, [
                'class' => Modo::class,
                'choices' => $this->modo->findAll(),
                'choice_label' => 'Identificador',
                'label' => 'Modos disponibles'
            ])
            ->add('Banda', EntityType::class, [
                'class' => Banda::class,
                'choices' => $this->banda->findAll(),
                'choice_label' => 'Distancia',
                'label' => 'Bandas disponibles'
            ])
            ->add('Juez', EntityType::class, [
                'class' => User::class,
                'choices' => $this->usuario->findJuecez(),
                'choice_label' => 'Email',
                'label' => 'Jueces disponibles'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mensaje::class,
        ]);
    }
}

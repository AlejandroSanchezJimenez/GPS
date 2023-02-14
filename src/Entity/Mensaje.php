<?php

namespace App\Entity;

use App\Repository\MensajeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MensajeRepository::class)]
class Mensaje
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $FechaHoraMensaje = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Usuario = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Banda $Banda = null;

    #[ORM\ManyToOne(inversedBy: 'mensajes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modo $Modo = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Validado = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Juez = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaHoraMensaje(): ?\DateTimeInterface
    {
        return $this->FechaHoraMensaje;
    }

    public function setFechaHoraMensaje(\DateTimeInterface $FechaHoraMensaje): self
    {
        $this->FechaHoraMensaje = $FechaHoraMensaje;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->Usuario;
    }

    public function setUsuario(?User $Usuario): self
    {
        $this->Usuario = $Usuario;

        return $this;
    }

    public function getBanda(): ?Banda
    {
        return $this->Banda;
    }

    public function setBanda(?Banda $Banda): self
    {
        $this->Banda = $Banda;

        return $this;
    }

    public function getModo(): ?Modo
    {
        return $this->Modo;
    }

    public function setModo(?Modo $Modo): self
    {
        $this->Modo = $Modo;

        return $this;
    }

    public function isValidado(): ?bool
    {
        return $this->Validado;
    }

    public function setValidado(?bool $Validado): self
    {
        $this->Validado = $Validado;

        return $this;
    }

    public function getJuez(): ?User
    {
        return $this->Juez;
    }

    public function setJuez(?User $Juez): self
    {
        $this->Juez = $Juez;

        return $this;
    }
}

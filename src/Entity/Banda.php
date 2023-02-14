<?php

namespace App\Entity;

use App\Repository\BandaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandaRepository::class)]
class Banda
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $Distancia = null;

    #[ORM\Column(length: 30)]
    private ?string $minRango = null;

    #[ORM\Column(length: 30)]
    private ?string $maxRango = null;

    #[ORM\OneToMany(mappedBy: 'Banda', targetEntity: Mensaje::class, orphanRemoval: true)]
    private Collection $mensajes;

    public function __construct()
    {
        $this->mensajes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistancia(): ?string
    {
        return $this->Distancia;
    }

    public function setDistancia(string $Distancia): self
    {
        $this->Distancia = $Distancia;

        return $this;
    }

    public function getMinRango(): ?string
    {
        return $this->minRango;
    }

    public function setMinRango(string $minRango): self
    {
        $this->minRango = $minRango;

        return $this;
    }

    public function getMaxRango(): ?string
    {
        return $this->maxRango;
    }

    public function setMaxRango(string $maxRango): self
    {
        $this->maxRango = $maxRango;

        return $this;
    }

    /**
     * @return Collection<int, Mensaje>
     */
    public function getMensajes(): Collection
    {
        return $this->mensajes;
    }

    public function addMensaje(Mensaje $mensaje): self
    {
        if (!$this->mensajes->contains($mensaje)) {
            $this->mensajes->add($mensaje);
            $mensaje->setBanda($this);
        }

        return $this;
    }

    public function removeMensaje(Mensaje $mensaje): self
    {
        if ($this->mensajes->removeElement($mensaje)) {
            // set the owning side to null (unless already changed)
            if ($mensaje->getBanda() === $this) {
                $mensaje->setBanda(null);
            }
        }

        return $this;
    }
}

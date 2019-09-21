<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FarmRepository")
 */
class Farm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Grower", inversedBy="farms")
     */
    private $grower;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlantingEvent", mappedBy="farm", orphanRemoval=true)
     */
    private $plantingEvents;

    public function __construct()
    {
        $this->plantingEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrower(): ?Grower
    {
        return $this->grower;
    }

    public function setGrower(?Grower $grower): self
    {
        $this->grower = $grower;

        return $this;
    }

    /**
     * @return Collection|PlantingEvent[]
     */
    public function getPlantingEvents(): Collection
    {
        return $this->plantingEvents;
    }

    public function addPlantingEvent(PlantingEvent $plantingEvent): self
    {
        if (!$this->plantingEvents->contains($plantingEvent)) {
            $this->plantingEvents[] = $plantingEvent;
            $plantingEvent->setFarmId($this);
        }

        return $this;
    }

    public function removePlantingEvent(PlantingEvent $plantingEvent): self
    {
        if ($this->plantingEvents->contains($plantingEvent)) {
            $this->plantingEvents->removeElement($plantingEvent);
            // set the owning side to null (unless already changed)
            if ($plantingEvent->getFarmId() === $this) {
                $plantingEvent->setFarmId(null);
            }
        }

        return $this;
    }
}

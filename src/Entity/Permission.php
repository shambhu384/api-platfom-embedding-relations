<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"permission.read"}},
 *     "denormalization_context"={"groups"={"permission.write"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\PermissionRepository")
 */
class Permission
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({
     *     "role.read",
     *     "role.write",
     *     "account.read",
     *     "account.write",
     *     "permission.read",
     *     "permission.write"
     * })
     *
     * @ORM\Column(type="string", length=255)
     */
    private $capability;

    /**
     * @Groups({"role.read"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="permissions", cascade={"persist"})
     */
    private $role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapability(): ?string
    {
        return $this->capability;
    }

    public function setCapability(string $capability): self
    {
        $this->capability = $capability;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function __toString()
    {
        return $this->capability;
    }
}

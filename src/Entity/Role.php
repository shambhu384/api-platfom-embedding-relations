<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"role.read"}},
 *     "denormalization_context"={"groups"={"role.write"}}
 * })
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 * @ApiFilter(BooleanFilter::class, properties={"accounts.isActive"})
 */
class Role
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({
     *     "role.read"
     * })
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({
     *     "role.read",
     *     "role.write",
     *
     *     "account.read",
     *     "account.write",
     *
     *     "account.update"
     * })
     */
    private $symbol;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({
     *     "role.read",
     *     "role.write",
     *
     *     "account.read",
     *     "account.write",
     *
     *     "account.update"
     * })
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Account", inversedBy="roles")
     * @ApiSubresource(maxDepth=1)
     * @Groups({
     *     "role.read"
     * })
     */
    private $accounts;

    /**
     * @Groups({
     *     "role.read",
     *     "role.write",
     *     "account.read",
     *     "account.write",
     *     "permission.read"
     * })
     * @ORM\OneToMany(targetEntity="App\Entity\Permission", mappedBy="role", cascade={"persist", "remove"})
     * @ApiSubresource(maxDepth=1)
     */
    private $permissions;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
        $this->permissions = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Account[]
     */
    public function getAccounts(): Collection
    {
        return $this->accounts;
    }

    public function addAccount(Account $account): self
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts[] = $account;
        }

        return $this;
    }

    public function removeAccount(Account $account): self
    {
        if ($this->accounts->contains($account)) {
            $this->accounts->removeElement($account);
        }

        return $this;
    }

    /**
     * @return Collection|Permission[]
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission): self
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions[] = $permission;
            $permission->setRole($this);
        }

        return $this;
    }

    public function removePermission(Permission $permission): self
    {
        if ($this->permissions->contains($permission)) {
            $this->permissions->removeElement($permission);
            // set the owning side to null (unless already changed)
            if ($permission->getRole() === $this) {
                $permission->setRole(null);
            }
        }

        return $this;
    }
}

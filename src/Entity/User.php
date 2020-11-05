<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(
 *     name="users",
 *     options={"row_format":"DYNAMIC"},
 * )
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    private $plainPassword;



    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('password', new Assert\Type('string'));
        $metadata->addPropertyConstraint('password', new Assert\NotNull());
        
        $metadata->addPropertyConstraint('email', new Assert\Email([
            'groups' => ['register'],
        ]));
        $metadata->addPropertyConstraint('email', new Assert\NotNull([
            'groups' => ['register'],
        ]));

        $metadata->addPropertyConstraint('role', new Assert\Type('string'));
        $metadata->addPropertyConstraint('role', new Assert\NotNull());
        
        $metadata->addPropertyConstraint('plainPassword', new Assert\Type('string'));
        $metadata->addPropertyConstraint('plainPassword', new Assert\NotNull([
            'groups' => ['register'],
        ]));
        $metadata->addPropertyConstraint('plainPassword', new Assert\Length([
            'groups' => ['register'],
            'min' => 6
        ]));

    }

    public function getId()
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }
    
    public function setRoles($role): self
    {
        $this->role = $role;
        
        return $this;
    }
    
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }
    
    public function getUsername(): ?string
    {
        return $this->username;
    }
    
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialized);
    }


    

    

    

}

<?php

namespace APPUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2;

use Zend\Stdlib\Hydrator;

//HasLifecycleCallbacks
// executa o methos antes de escreve no banco

/**
 * CeuvendedoresVendedores
 *
 * @ORM\Table(name="ceuvendedores_vendedores")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="APPUser\Entity\VendedoresRepository")
 */
class Vendedores {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=true)
     */
    private $activationKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime", nullable=true)
     */
    private $createAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="nivel", type="integer", nullable=true)
     */
    private $nivel;

    public function __construct(array $options = array()) {
        
        $hydrator = new Hydrator\ClassMethods;
        $hydrator->hydrate($options, $this);
        
         //(new Hydrator\ClassMethods)->hydrate($options, $this);

        $this->createAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");

        $this->salt = base64_encode(Rand::getBytes(8, true));
        $this->activationKey = md5($this->email . $this->salt);
        
        $this->active = false;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getActive() {
        return $this->active;
    }

    public function getActivationKey() {
        return $this->activationKey;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function getCreateAt() {
        return $this->createAt;
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $this->encryptPassword(trim($password));
        return $this;
    }

    public function encryptPassword($password) {
        return base64_encode(md5($password));
    }

    public function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }

    public function setActive($active) {
        $this->active = $active;
        return $this;
    }

    public function setActivationKey($activationKey) {
        $this->activationKey = $activationKey;
        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt() {
        $this->updatedAt = new \DateTime('now');
    }

    public function setCreateAt() {
        $this->createAt = new \DateTime('now');
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
        return $this;
    }

    public function toArray(){
         $hydrator = new Hydrator\ClassMethods;
         return $hydrator->extract($this);
    }
}

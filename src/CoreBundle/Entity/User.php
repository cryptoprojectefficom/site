<?php

namespace CoreBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    /**
    * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;


    /**
    *
    *@var int
    * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Comment", mappedBy="user", cascade={"persist", "remove"})
    */
    private $comments;


    /**
    * @var \DateTime
    * @Assert\DateTime()
    * @ORM\Column(name="signInDate", type="datetime")
    */
    private $signInDate;


    /**
    * @var string
    * @ORM\Column(name="signature", type="text")
    */
    private $signature = 'toto';


    /**
    *
    * @var int
    * @ORM\JoinColumn( nullable=true)
    * @ORM\OneToOne(targetEntity="CoreBundle\Entity\Image", cascade={"persist", "remove"})
    */
    private $avatar;


    public function __construct()
    {
      parent::__construct();
      $this->comments       = new ArrayCollection();
      $this->date         = new \Datetime();

    }

    /**
     * @return ArrayCollection
     */
    public function getComment()
    {
      return $this->comments;
    }

    /**
     * @param Comment
     */
    public function addComment(Comment $comment)
    {
      $this->comments[] = $comment;

      return $this;
    }

    /**
     * @param Comment $comment
     */
    public function removeComment(Comment $comment)
    {
      $this->comments->removeElement($comment);
    }

    /**
    * @param \DateTime $signInDate
    */
    public function setSignInDate($signInDate)
    {
      $this->signInDate =$signInDate;
    }

    /**
    * @return \DateTime
    */

    public function getSignInDate()
    {
      return $this->signInDate;
    }

    public function getSignature()
    {
      return $this->signature;
    }

    /**
    * @return string $avatar
    */
    public function setAvatar($avatar)
    {
      $this->avatar = $avatar;
    }
    /**
    * @return string
    */
    public function getAvatar()
    {
      return $this->avatar;
    }

   /**
  *
  * @ORM\PrePersist
  * @ORM\PreUpdate
  */
  public function updatedTimestamps()
  {
     if ($this->getSignInDate() == null) {
         $this->setSignInDate(new \DateTime('now'));
     }
  }
}

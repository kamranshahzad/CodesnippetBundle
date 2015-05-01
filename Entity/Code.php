<?php

namespace Kamran\CodesnippetBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 * @ORM\Table(name="code")
 * @ORM\Entity(repositoryClass="Kamran\CodesnippetBundle\Entity\Repository\CodeRepository")
 */
class Code
{

     /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=200)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="Snippet", mappedBy="code", cascade={"persist"})
     * @var type
     */
    private $snippets;

    /**
     * @ORM\ManyToMany(targetEntity="Kamran\TagsBundle\Entity\TechnologyTags")
     * @ORM\JoinTable(name="technologytags_code",
     *      joinColumns={@ORM\JoinColumn(name="code_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    private $tags;


    public function __construct()
    {
        $this->snippets = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setComment($comment){
        $this->comment = $comment;
        return $this;
    }

    public function getComment(){
        return $this->comment;
    }

    /*
     * Relationships
     */
    public function addTags(\Kamran\TagsBundle\Entity\TechnologyTags $tags){
        $this->tags[] = $tags;
    }

    public function getTags(){
        return $this->tags;
    }



    /*
    public function addSnippets(Snippet $snips){
        $this->snippets[] = $snips;
        $snips->setCode($this);
    }


    public function setSnippets(Snippet $snips){
        $this->snippets = $snips;
        foreach ($snips as $snip){
            $snip->setCode($this);
        }
    }
    */

    public function getSnippets(){
        return $this->snippets;
    }

    public function addSnippets(Snippet $snips){
        $this->snippets[] = $snips;
        $snips->setCode($this);
    }

    public function setSnippet(Snippet $snips){
        $this->snippets = $snips;
        foreach ($snips as $snip){
            $snip->setCode($this);
        }
    }

    public function addSnippet(Snippet $snips){
        $this->snippets[] = $snips;
        return $this;
    }

    public function removeSnippet(Snippet $snips)
    {
        $this->snippets->removeElement($snips);
    }


}

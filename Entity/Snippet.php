<?php

namespace Kamran\CodesnippetBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

 
/**
 * @ORM\Entity
 * @ORM\Table(name="snippets")
 */
class Snippet
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
     * @ORM\Column(name="filename", type="string", length=50)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=30)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="codetext", type="text")
     */
    private $codetext;

    /**
     * @ORM\ManyToOne(targetEntity="Code", inversedBy="snippets")
     * @ORM\JoinColumn(name="code_id", referencedColumnName="id")
     * @var type
     */
    private $code;


    public function setFilename($filename){
        $this->filename = $filename;
        return $this;
    }

    public function getFilename(){
        return $this->filename;
    }

    public function setLanguage($lang){
        $this->language = $lang;
        return $this;
    }

    public function getLanguage(){
        return $this->language;
    }

    public function setCodetext($codetext){
        $this->codetext = $codetext;
        return $this;
    }

    public function getCodetext(){
        return $this->codetext;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }



    public function setCode(Code $code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

}
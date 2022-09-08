<?php
######### Element.class.php ###########
class Element
{
    private $name;
    private $properties;
    private $children;
    private $tudo=array();
    private $conteudo;

    public function __construct($name)
    {
        $this->name = $name;
    }
   
    public function __set($name,$value)
    {
        $this->properties[$name] = $value;
    }

    public function add($child)
    {
        $this->children[] = $child;
    }

    public function open()
    {
        $this->tudo[]="<$this->name";
        if ($this->properties)
        {
            // percorre as propriedades
            foreach ($this->properties as $name=>$value)
            {
                $this->tudo[]= " {$name}=\"{$value}\"";
            }
        }
        $this->tudo[]= '>';
    }

    public function agrega()
    {
        $this->open();
        $this->tudo[]= "\n";

        if ($this->children)
        {
            // percorre todos objetos filhos
            foreach ($this->children as $child)
            {
                // se for objeto
                if (is_object($child))
                {
                    foreach($child->agrega() as $valor)
                    {
                        $this->tudo[]=$valor;
                    }
                }
                else if ((is_string($child)) or (is_numeric($child)))
                {
                    // se for texto
                    $this->tudo[]= $child;
                }
            }
            $this->close();
        }  
        return $this->tudo;
    }

    private function close()
    {
        $this->tudo[]= "</{$this->name}>\n";
    }

    public function show()
    {
        foreach($this->agrega() as $valor)
        {
            $this->conteudo.=$valor;
        }
        return $this->conteudo;
    }
    
    public function __toString() {
	    return $this->show();
    }
}

?>

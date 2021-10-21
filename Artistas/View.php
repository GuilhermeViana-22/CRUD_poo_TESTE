<?php
class View
{
    public function __construct(string $path = '', array $parms = [])
    {
        $this->st_path = file_exists($path) ? $path : '';
        $this->parms = $parms;
        $this->massage;
        $this->load();
    }

    protected $st_path, $st_contents, $parms, $massage;

    public function load(): void
    {
        ## inicia a leitura
        if (isset($this->st_path))
            require $this->st_path;
        ##ob_get_contents le todo o arquivo da View e armazena dentro do st_contents
        $this->st_contents = ob_get_contents();

        if (ob_get_contents()) 
            ob_end_clean(); ## termina a leitura e limpa o buffer
    }


    public function show(bool $value = true): void
    {
        if ($value)
            $this->load();
        echo $this->st_contents;
    }

    public function setParameter(array $parms): self
    {
        $this->parms = $parms;
        return $this;
    }

    public function addParameter($key, $param): self
    {
        $this->parms[$key] = $param;
        return $this;
    }

    public function getParameter(): array
    {
        return $this->parms;
    }

    public function getMassage()
    {
        return isset($this->massage)? $this->massage : ' ';
    }

    public function setMassage($massage)
    {
        $this->massage = $massage;

        return $this;
    }
}

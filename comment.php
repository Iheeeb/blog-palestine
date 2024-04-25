<?php
class Comment {
    protected $contenu;
    protected $user;
    protected $article;

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function setArticle($a) {
        $this->article = $a;
    }

    public function getArticle() {
        return $this->article;
    }
    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function getContenu() {
        return $this->contenu;
    }
    public function setUser($u) {
        $this->user = $u;
    }

    public function getUser() {
        return $this->user;
    }
}
?>

<?php 

class Genre 
    {

        /**
         * Numéro du Genre
         *
         * @var int
         */
        private $num;
        /**
         * Libelle du Genre
         *
         * @var string
         */
        private $libelle;
        
        /**
         * Lit le Numero du Genre
         *
         * @return integer
         */
        public function getNum() : int
        {
                return $this->num;
        }

         /**
         * Set numéro du Genre
         */
        public function setNum(int $num): self
        {
                $this->num = $num;

                return $this;
        }

       /**
        * Lit le libellé
        *
        * @return string
        */
        public function getLibelle() : string
        {
                return $this->libelle;
        }  

        /**
         * Ecrit dans le Libellé
         *
         * @param string $libelle
         * @return self
         */
        public function setLibelle(string $libelle) : self
        {
                $this->libelle = $libelle;

                return $this;
        }

        /**
         * Retourne l'ensemble des genres
         *
         * @return Genre[] tableau d'objet genre
         */
        public static function findAll() : array
        {
            $req=MonPdo::getInstance()->prepare("select * from genre");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"genre");
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;
        }

        /**
         * Trouve un genre par son num
         *
         * @param integer $id numéro du genre
         * @return Genre objet genre trouvé
         */
        public static function findById(int $id) : Genre
        {
            $req=MonPdo::getInstance()->prepare("select * from genre where num = :id");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Genre");
            $req->bindParam(':id',$id);
            $req->execute();
            $leResultat=$req->fetch();
            return $leResultat;
            
        }

        /**
         * Ajoute un genre
         *
         * @param Genre $genre genre à ajouter
         * @return integer résultat(1 si l'opération à réussi, 0 dans le cas contraire)
         */
        public static function Add(Genre $genre) :int
        {
            $req=MonPdo::getInstance()->prepare("insert into genre(libelle) values(:libelle)");
            $libelle=$genre->getLibelle();
            $req->bindParam(':libelle',$libelle);
            $nb=$req->execute();
            return $nb;
             
        }

        /**
         * Permet de modifié un genre
         *
         * @param Genre $genre genre à modifié
         * @return integer résultat(1 si l'opération à réussi, 0 dans le cas contraire)
         */
        public static function Update(Genre $genre) : int
        {
            $req=MonPdo::getInstance()->prepare("update genre set libelle= :libelle where num= :id");
            $libelle=$genre->getLibelle();
            $num=$genre->getNum();
            $req->bindParam(':libelle',$libelle);
            $req->bindParam(':id',$num);
            $nb=$req->execute();
            return $nb; 
        }

        /**
         * Permet de supprimer un genre
         *
         * @param Genre $genre genre à supprimer
         * @return integer résultat(1 si l'opération à réussi, 0 dans le cas contraire)
         */
        public static function Delete(Genre $genre) : int
        {
            $req=MonPdo::getInstance()->prepare("delete from genre where num = :id");
            $num=$genre->getNum();
            $req->bindParam(':id',$num);
            $nb=$req->execute();
            return $nb; 
        }

       
    }

?>
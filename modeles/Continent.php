<?php 

class Continent 
    {

        /**
         * Numéro du Continent
         *
         * @var int
         */
        private $num;
        /**
         * Libelle du Continent
         *
         * @var string
         */
        private $libelle;
        
        /**
         * Lit le Numero du Continent
         *
         * @return integer
         */
        public function getNum() : int
        {
                return $this->num;
        }

         /**
         * Set numéro du Continent
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
         * Retourne l'ensemble des continent
         *
         * @return Continent[] tableau d'objet continent
         */
        public static function findAll() : array
        {
            $req=MonPdo::getInstance()->prepare("select * from continent");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Continent");
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;
        }

        /**
         * Trouve un continent par son num
         *
         * @param integer $id numéro du continent
         * @return Continent objet continent trouvé
         */
        public static function findById(int $id) : Continent
        {
            $req=MonPdo::getInstance()->prepare("select * from continent where num = :id");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Continent");
            $req->bindParam(':id',$id);
            $req->execute();
            $leResultat=$req->fetch();
            return $leResultat;
            
        }

        /**
         * Ajoute un continent
         *
         * @param Continent $continent continent à ajouter
         * @return integer résultat(1 si l'opération à réussi, 0 dans le cas contraire)
         */
        public static function Add(Continent $continent) :int
        {
            $req=MonPdo::getInstance()->prepare("insert into continent(libelle) values(:libelle)");
            $libelle=$continent->getLibelle();
            $req->bindParam(':libelle',$libelle);
            $nb=$req->execute();
            return $nb;
             
        }

        /**
         * Permet de modifié un continent
         *
         * @param Continent $continent continent à modifié
         * @return integer résultat(1 si l'opération à réussi, 0 dans le cas contraire)
         */
        public static function Update(Continent $continent) : int
        {
            $req=MonPdo::getInstance()->prepare("update continent set libelle= :libelle where num= :id");
            $libelle=$continent->getLibelle();
            $num=$continent->getNum();
            $req->bindParam(':libelle',$libelle);
            $req->bindParam(':id',$num);
            $nb=$req->execute();
            return $nb; 
        }

        /**
         * Permet de supprimer un continent
         *
         * @param Continent $continent continent à supprimer
         * @return integer résultat(1 si l'opération à réussi, 0 dans le cas contraire)
         */
        public static function Delete(Continent $continent) : int
        {
            $req=MonPdo::getInstance()->prepare("delete from continent where num = :id");
            $num=$continent->getNum();
            $req->bindParam(':id',$num);
            $nb=$req->execute();
            return $nb; 
        }

       
    }

?>
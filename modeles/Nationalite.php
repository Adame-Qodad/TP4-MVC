<?php 

class Nationalite 
    {

        /**
         * Numéro de la Nationalite
         *
         * @var int
         */
        private $num;
        /**
         * Libelle de la Nationalite
         *
         * @var string
         */
        private $libelle;
        /**
         * Numéro du continent associer a la Nationalite
         *
         * @var int
         */
        private $numContinent;

        
        /**
         * Lit le Numero de la Nationalite
         *
         * @return integer
         */
        public function getNum() : int
        {
                return $this->num;
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
         * Renvoi l'objet continent associer
         *
         * @return Continent
         */
        public function getNumContinent(): Continent
        {
                return Continent::findById($this->numContinent);
        }
        /**
         * Ecrit le num Continent
         *
         * @param Continent $continent
         * @return self
         */
        public function setNumContinent(Continent $continent): self
        {
                $this->numContinent = $continent->getNum();

                return $this;
        }


        /**
         * Retourne l'ensemble des Nationalite
         *
         * @return Nationalite[] tableau d'objet nationalitée
         */
        public static function findAll() : array
        {
            $req=MonPdo::getInstance()->prepare("select n.num, n.libelle as 'libNation', c.libelle as 'libCont' from nationalite n, continent c where n.numContinent=c.num");
            $req->setFetchMode(PDO::FETCH_OBJ);
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;
        }

        /**
         * Trouve une nationalitée par son num
         *
         * @param integer $id
         * @return Continent
         */
        public static function findById(int $id) :Continent
        {
            $req=MonPdo::getInstance()->prepare("select * from nationalite where num = :id");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"Nationalite");
            $req->bindParam(':id',$id);
            $req->execute();
            $leResultat=$req->fetch();
            return $leResultat;
            
        }

        /**
         * Permet d'ajouter une nationalitée
         *
         * @param Nationalite $nationalite
         * @return integer
         */
        public static function Add(Nationalite $nationalite) :int
        {
            $req=MonPdo::getInstance()->prepare("insert into nationalite(libelle,numContinent) values(:libelle:numContinent)");
            $req->bindParam(':libelle',$nationalite->getLibelle());
            $req->bindParam(':numContinent',$nationalite->numContinent);
            $nb=$req->execute();
            return $nb;
             
        }

        /**
         * Permet de modifier une nationalitée
         *
         * @param Nationalite $nationalite
         * @return integer
         */
        public static function Update(Nationalite $nationalite) : int
        {
            $req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle, numContinent= :numContinent where num= :id");
            $req->bindParam(':numContinent',$nationalite->numContinent);
            $req->bindParam(':libelle',$nationalite->getLibelle());
            $req->bindParam(':id',$nationalite->getNum());
            $nb=$req->execute();
            return $nb; 
        }

        /**
         * Permet de supprimer une nationalitée
         *
         * @param Nationalite $nationalite
         * @return integer
         */
        public static function Delete(Nationalite $nationalite) : int
        {
            $req=MonPdo::getInstance()->prepare("delete from nationalite where num = :id");
            $req->bindParam(':id',$nationalite->getNum());
            $nb=$req->execute();
            return $nb; 
        }

        
    }

?>
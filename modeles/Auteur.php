<?php 

class Auteur 
    {

        private $num;   
        private $nom;
        private $prenom;
        private $numNationalite;

        /**
         * Get the value of num
         */

        public function getNum()
        {
                return $this->num;
        }

        /**
         * Set the value of num
         */

        public function setNum($num): self
        {
                $this->num = $num;

                return $this;
        }

        /**
         * Get the value of nom
         */

        public function getNom()
        {
                return $this->nom;
        }

        /**
         * Set the value of nom
         */

        public function setNom($nom): self
        {
                $this->nom = $nom;

                return $this;
        }

        /**
         * Get the value of prenom
         */

        public function getPrenom()
        {
                return $this->prenom;
        }

        /**
         * Set the value of prenom
         */

        public function setPrenom($prenom): self
        {
                $this->prenom = $prenom;

                return $this;
        }

        /**
         * Get the value of numNationalite
         */

        public function getNumNationalite()
        {
                return $this->numNationalite;
        }

        /**
         * Set the value of numNationalite
         */

        public function setNumNationalite($numNationalite): self
        {
                $this->numNationalite = $numNationalite;

                return $this;
        }


        /**
         * Retourne l'ensemble des Auteur
         *
         * @return Auteur[] tableau d'objet nationalitée
         */

        public static function findAll() : array
        {
            $req=MonPdo::getInstance()->prepare("select a.num, a.nom as 'nomA', a.prenom as 'prenomA', n.libelle as 'libNatio' from auteur a, nationalite n where a.numNationalite=n.num order by a.num");
            $req->setFetchMode(PDO::FETCH_OBJ);
            $req->execute();
            $lesResultats=$req->fetchAll();
            return $lesResultats;
        }

        /**
         * Trouve une nationalitée par son num
         *
         * @param integer $id
         * @return Auteur
         */
        public static function findById(int $id) : Auteur
        {
            $req=MonPdo::getInstance()->prepare("select * from auteur where num = :id");
            $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,"auteur");
            $req->bindParam(':id',$id);
            $req->execute();
            $leResultat=$req->fetch();
            return $leResultat;
            
        }

        /**
         * Permet d'ajouter une nationalitée
         *
         * @param Auteur $auteur
         * @return integer
         */
        public static function Add(Auteur $auteur) : int
        {
            $req=MonPdo::getInstance()->prepare("insert into auteur(nom,prenom,numNationalite) values(:nom, :prenom, :numNationalite)");
            $nom=$auteur->getNom();
            $prenom=$auteur->getPrenom();
            $numNationalite=$auteur->getNumNationalite()->getNum();
            $req->bindParam(':nom',$nom);
            $req->bindParam(':prenom',$prenom);
            $req->bindParam(':numNationalite',$numNationalite);
            $nb=$req->execute();
            return $nb;
             
        }

        /**
         * Permet de modifier une nationalitée
         *
         * @param Auteur $auteur
         * @return integer
         */
        public static function Update(Auteur $auteur) : int
        {
            $req=MonPdo::getInstance()->prepare("update auteur set nom = :nom, prenom = :prenom, numNationalite= :numNationalite where num= :id");
            $nom=$auteur->getNom();
            $prenom=$auteur->getPrenom();
            $numNationalite=$auteur->getNumNationalite();
            $num=$auteur->getNum();
            $req->bindParam(':numNationalite',$numNationalite->getNum());
            $req->bindParam(':nom',$nom);
            $req->bindParam(':prenom',$prenom);
            $req->bindParam(':id',$num);
            $nb=$req->execute();
            return $nb; 
        }

        /**
         * Permet de supprimer une nationalitée
         *
         * @param Auteur $auteur
         * @return integer
         */
        public static function Delete(Auteur $auteur) : int
        {
            $req=MonPdo::getInstance()->prepare("delete from auteur where num = :id");
            $num=$auteur->getNum();
            $req->bindParam(':id',$num);
            $nb=$req->execute();
            return $nb; 
        }


        

        
    }

 

        

        

        

?>
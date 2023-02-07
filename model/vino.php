<?php


class Vino{
  public $vinoId;
  public $nazivVina;
  public $kolicina;
  public $cena;
  public $tipId;

  function __construct($vinoId=null,$nazivVina=null,$kolicina=null,$cena=null,$tipId=null) {
        $this->vinoId = $vinoId;
        $this->nazivVina = $nazivVina;
        $this->kolicina = $kolicina;
        $this->cena = $cena;
        $this->tipId=$tipId;
    }

    public function insert($conn){
      return $conn->query("INSERT INTO vino(nazivVina,kolicina,cena,tipId) VALUES ('$this->nazivVina','$this->kolicina','$this->cena','$this->tipId')");
  }

  public function delete($conn,$id){
    return $conn->query("DELETE FROM vino where vinoId=$id");
  }

  public function update($conn){
    return $conn->query("UPDATE vino SET nazivVina='$this->nazivVina',kolicina='$this->kolicina','cena=$this->cena', tipId='$this->tipId' where vinoId=$this->vinoId");
}

public static function getById($id, $conn){
  return $conn->query("SELECT * FROM vino WHERE vinoId = $id");
}

}

?>
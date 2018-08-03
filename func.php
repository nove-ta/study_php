<?php
header('Content-Type: text/html; charset=UTF-8');
class Janken{
    private $hand_list = [
        0 => 'ぐー',
        1 => 'ぱー',
        2 => 'ちょき',
    ];

    private $hantei = [
        -1 => 'まけ',
        0  => 'あいこ',
        1  => 'かち',
    ];

    private $jibun;
    private $aite;
    private $result;

    public function __construct(){
        $this->jibun = null;
        $this->aite = null;
        $this->result = null;
    }

    public function getHandList(){
        return $this->hand_list;
    }

    public function Hantei(){
        if($this->jibun === null || $this->aite === null){
            return ; // 判定不能
        }

        //var_dump($this->jibun);
        //var_dump($this->aite);
        
        // あいこ
        if($this->jibun === $this->aite){
            $this->result = 0;
            return;
        }

        // まけ
        if( ($this->jibun === 0 && $this->aite === 1) || 
            ($this->jibun === 1 && $this->aite === 2) ||
            ($this->jibun === 2 && $this->aite === 0) ){
            $this->result = -1;
            return;
        }

        //　かち
        $this->result = 1;
    }

    public function setJibunHand($jibun){
        $this->jibun = (int)$jibun;
        $this->setAiteHand();
    }
    private function setAiteHand(){
        $this->aite = mt_rand(0, 1000)%3; // ぐーより
    }

    public function getJibunHand(){
        return ($this->jibun !== null) ? $this->hand_list[$this->jibun] : '';
    }

    public function getAiteHand(){
        return ($this->aite !== null) ? $this->hand_list[$this->aite] : '';
    }

    public function getResult(){
        //var_dump($this->result);
        return ($this->result !== null) ? $this->hantei[$this->result] : ''; 
    }
}

function getViewData($post_data){

    $jak = new Janken();

    if($post_data !== null){
        //var_dump($post_data);
        $jak->setJibunHand($post_data["jibun"]);
        $jak->Hantei();
    }
    
    $ret['hand_list'] = $jak->getHandList();
    $ret['jibun_str'] = $jak->getJibunHand();
    $ret['aite_str'] = $jak->getAiteHand();
    $ret['judge'] = $jak->getResult();
    return $ret;
}

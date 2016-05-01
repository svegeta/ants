<?php
class System extends AppModel {
	/*
   public $validate = array(
        'pair' => array(
            'rule' => array('urlCheck', 2),
            'message' => 'Bitte URL prüfen. Bsp.: aesayuto2y15hxbg.myfritz.net'
        )
    );
	*/
    public function urlCheck($check, $limit) {
        // $check will have value: array('pair' => 'some-value')
        // $limit will have value: 25
		$url = explode($check, ".");
		if ($url[2] != "net"){
			return false;
		}
		if (strlen($url[0]) != 16){
			return false;
		}
		return true;
    }
}
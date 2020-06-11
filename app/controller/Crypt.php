<?php

class Crypt{
    protected $Key;

    function __construct($Active = false){
        if(!$Active) header('Location: ' . URL);
        $this->Key = md5(CRYPIT_KEY);
        
    }

    
    public function EnCrypt($value){
        $json = '{"value":"' . $this->Base64AndUpLowerCase($value) . '", "key":"' . $this->Key . '"}';
        $base64 = $this->Base64AndUpLowerCase($json,true, 2);
        return $this->Base64AndUpLowerCase($base64,true, 13);
    }

    public function DeCrypt($value)
    {
        $base64 = $this->Base64AndUpLowerCase($value,false, 13);
        $json = json_decode($this->Base64AndUpLowerCase($base64,false, 2));
        return $this->Base64AndUpLowerCase(@$json->value, false);
    }

    private function Base64AndUpLowerCase($str, $EnCrypt = true, $NumberMod = 3)
    {
        if($EnCrypt) $str = base64_encode($str);

        $NewString = "";
        $chars = str_split($str);
        foreach ($chars as $key => $value) {
            if($key % $NumberMod === 0 || $key % 5 === 0){
                if(strtoupper($value) == $value){
                    $NewString .= strtolower($value);
                }else{
                    $NewString .= strtoupper($value);
                }
            }else{
                $NewString .= $value;
            }
        }
        
        $StrReturn = $NewString;
        if(!$EnCrypt) $StrReturn = base64_decode($NewString);

        return $StrReturn;
    }
    
}

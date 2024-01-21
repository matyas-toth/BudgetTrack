<?php

include_once("functions.php");

class BudgetManagerAPI {

    private $folder;

    /*
    * Constructor method, sets the active folder.
    */
    public function __construct($folder)
    {
        
        $this->folder = $folder;

    }

    /*
    * Adds an entry to the selected period's file.
    */
    public function addEntry($period, $name, $amount) {

        $period = strtolower($period);
        $date = date("U");
        $amount = $amount;
        $id = generateRandomString();

        if(empty($amount)) {
            $amount = 0;
        }

        if(empty($name)) {
            $name = 'UnknownItem.'.$id;
        }

        $data = file_get_contents($this->getFolder().'/'.$period.'.json');
        $json = json_decode($data, true);

        if(empty($data)) {

            $json["items"] = [["id" => $id, "name" => $name, "added" => $date, "amount" => $amount]];
        
        } else {
        
            array_push($json["items"], ["id" => $id, "name" => $name, "added" => $date, "amount" => $amount]);
        
        }

        $encoded = json_encode($json, JSON_UNESCAPED_SLASHES);

        $myfile = fopen($this->getFolder().'/'.$period.'.json', "w");
        fwrite($myfile, $encoded);

        fclose($myfile);

    }

    /*
    * Removes an entry from the selected period's file.
    */
    public function removeEntry($period, $id) {

        $period = strtolower($period);
        $id = $id;

        $data = file_get_contents($this->getFolder().'/'.$period.'.json');
        $json = json_decode($data, true);

        $count = 0;

        foreach($json["items"] as $key => $item) {

            if($item["id"] == $id) {

                unset($json["items"][$key]);

            }

            $count = $count + 1;

        }

        $encoded = json_encode($json, JSON_UNESCAPED_SLASHES);

        $myfile = fopen($this->getFolder().'/'.$period.'.json', "w");
        fwrite($myfile, $encoded);

        fclose($myfile);


    }

    /*
    * Returns the active folder.
    */
    public function getFolder() {
        return $this->folder;
    }

}

?>
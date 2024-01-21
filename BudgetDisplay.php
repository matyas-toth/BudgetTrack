<?php

include_once("functions.php");

class BudgetDisplay {

    private $folder;
    private $previous_period_raw;
    private $next_period_raw;
    private $current_period_raw;
    private $current_period;

    private $raw_data;
    private $json;

    public function __construct($folder)
    {
        $this->folder = $folder;

        $period = date("F Y");
        $raw_period = str_replace(" ", "-", $period);
        $raw_period = strtolower($raw_period);

        if(!empty($_GET["period"])) {

            $period = $_GET["period"];
            $period = strtolower($period);
            $period = str_replace("-", " ", $period);
            $period = ucwords($period);
            $raw_period = $_GET["period"];
            $raw_period = str_replace(" ", "-", $period);
            $raw_period = strtolower($raw_period);

        }   

        $exploded = explode("-", $raw_period);
        $month = dateTextToNum($exploded[0]);
        $year = $exploded[1];

        if($month == "13") {

            $year = date("Y");
            $month = date("n");

        }

        $previous_year = $year;
        $next_year = $year;

        if($month == 1) {

            $previous_year = $year-1;
            $previous_month = 12;
            $next_month = 2;

        } else if ($month == 12) {

            $next_year = $year+1;
            $previous_month = 11;
            $next_month = 1;

        } else {

            $previous_month = $month-1;
            $next_month = $month+1;

        }

        if($previous_month < 10) {
            $previous_month = "0".$previous_month;
        }

        if($next_month < 10) {
            $next_month = "0".$next_month;
        }

        $previous_period = strtotime("$previous_year/$previous_month/01");
        $next_period = strtotime("$next_year/$next_month/01");

        $previous_string = strtolower(date("F-Y", $previous_period));
        $next_string = strtolower(date("F-Y", $next_period));

        $rawdata = "";

        if(file_exists($this->getFolder().'/'.$raw_period.'.json')) { $rawdata = file_get_contents($this->getFolder().'/'.$raw_period.'.json'); }

        $myfile = fopen($this->getFolder().'/'.$raw_period.'.json', "w");
        fwrite($myfile, $rawdata);
        fclose($myfile);

        $rawdata = file_get_contents($this->getFolder().'/'.$raw_period.'.json');

        $json = json_decode($rawdata, true);

        $this->previous_period_raw = $previous_string;
        $this->next_period_raw = $next_string;
        $this->current_period_raw = $raw_period;
        $this->current_period = $period;
        $this->json = $json;
        $this->raw_data = $rawdata;

    }

    public function getFolder() {
        return $this->folder;
    }

    public function getRawPreviousPeriod() {
        return $this->previous_period_raw;
    }

    public function getRawNextPeriod() {
        return $this->next_period_raw;
    }

    public function getRawCurrentPeriod() {
        return $this->current_period_raw;
    }

    public function getCurrentPeriod() {
        return $this->current_period;
    }

    public function getItems() {
        return $this->json["items"];
    }

    public function areThereItems() {
        if(empty($this->raw_data)) {
            return false;
        } else {
            return true;
        }
    }

    public function getSummary() {

        $summary = 0;

        if($this->areThereItems()) {
        

            foreach($this->getItems() as $item ) {

                $summary = $summary + $item["amount"];

            }
        
        }

        return $summary;
        
    }

}

?>

<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ob_start();



class Database
{


    var $hostname;
    var $username;
    var $password;
    var $databasename;
    var $port_name;
    var $con;
    var $i = 1;


    /***
     * true -- in local developement
     * false -- in production development
     */
    var $local = true;

    function getConnection()
    {

        if ($this->local) {
        

            $this->hostname = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->databasename = "zodongoFoods";
            $this->port_name = "3306";
            $this->con;
        } else {
            $this->hostname = "localhost";
            $this->username = "rgxszumy_zodongofoodsuser";
            $this->password = "P-8dUMviQVb%";
            $this->databasename = "rgxszumy_zodongofoods";
            $this->port_name = "3306";
            $this->con;
        }


        while (true) {
            try {
                $this->con = new mysqli($this->hostname, $this->username, $this->password, $this->databasename, $this->port_name);
                return $this->con;
                break;
            } catch (\Throwable $th) {
                $this->con = null;
                echo "Error: " . $th->getMessage();
                sleep(2);
            }
        }
    }
}



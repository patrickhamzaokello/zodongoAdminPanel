<?php


class Menu
{

    private $con;
    private $menu_id;
    private $menu_name;
    private $menu_image;
    private $TABLE_NAME = "tblmenu";
 


    public function __construct($con, $id)
    {
        $this->con = $con;
        $this->menu_id = $id;

        $query = mysqli_query($this->con, "SELECT `menu_id`, `menu_name`, `menu_image` FROM ". $this->TABLE_NAME ." WHERE menu_id ='$this->menu_id'");
        $order_fetched = mysqli_fetch_array($query);


        if (mysqli_num_rows($query) < 1) {

            $this->menu_id = null;
            $this->menu_name = null;
            $this->menu_image = null;
        
        } else {

            $this->menu_id = $order_fetched['menu_id'];
            $this->menu_name = $order_fetched['menu_name'];
            $this->menu_image = $order_fetched['menu_image'];
     
        }
    }




    /**
     * Get the value of menu_id
     */ 
    public function getMenu_id()
    {
        return $this->menu_id;
    }

    /**
     * Get the value of menu_name
     */ 
    public function getMenu_name()
    {
        return $this->menu_name;
    }

    /**
     * Get the value of menu_image
     */ 
    public function getMenu_image()
    {
        return $this->menu_image;
    }
}

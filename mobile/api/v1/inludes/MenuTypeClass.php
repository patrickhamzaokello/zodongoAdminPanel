<?php
class MenuTypeClass
{

    private $itemsTable = "tblmenutype";
    private $ImageBasepath = "https://zodongofoods.com/admin/pages/";
    public $id;
    public $name;
    public $description;
    public $imageCover;
    public $created;
    public $modified;
    private $conn;



    public function __construct($con, $id)
    {
        $this->conn = $con;
        $this->id = $id;

        $stmt = $this->conn->prepare("SELECT id,name,description,imageCover,created, modified FROM " . $this->itemsTable . " WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $description, $imageCover, $created, $modified);

        while ($stmt->fetch()) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->imageCover = $imageCover;
        $this->created = $created;
        $this->modified = $modified;

        }
    }


    function getMenuTypeId() {
        return $this->id;
    }

    function getMenuTypeName() {
        return $this->name;
    }

    function getMenuTypeDescription() {
        return $this->description;
    }

    function getMenuTypeImageCover() {
        return $this->imageCover;
    }

    function getMenuTypeCreated() {
        return $this->created;
    }

    function getMenuTypeModified() {
        return $this->modified;
    }

    function getCategoryMenuitems(){

        $categoryMenuItems = array();

        $stmt = $this->conn->prepare("SELECT menu_id,menu_name, price, description, menu_type_id, menu_image,backgroundImage,ingredients, menu_status, created, modified,rating FROM tblmenu WHERE menu_type_id = ? ORDER BY menu_id LIMIT 6");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->bind_result($menu_id, $menu_name, $price, $description, $menu_type_id, $menu_image, $backgroundImage, $ingredients, $menu_status, $created, $modified, $rating);

        while ($stmt->fetch()) {
            $temp = array();

			$temp['menu_id'] = $menu_id;
			$temp['menu_name'] = $menu_name;
			$temp['price'] = $price;
			$temp['description'] = $description;
			$temp['menu_type_id'] = $menu_type_id;
			$temp['menu_image'] = $this->ImageBasepath.$menu_image;
			$temp['backgroundImage'] = $this->ImageBasepath.$backgroundImage;
			$temp['ingredients'] = $description;
			$temp['menu_status'] = $menu_type_id;
			$temp['created'] = $created;
			$temp['modified'] = $modified;
			$temp['rating'] = $rating;


			array_push($categoryMenuItems, $temp);

        }

        return $categoryMenuItems;
    }

}

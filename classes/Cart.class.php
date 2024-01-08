<?php
class Cart extends Db
{
    private $_cart;
    private $_num_item = 0;

    public function __construct()
    {
        if (!isset($_SESSION["cart"])) {
            $this->_cart = array();
        } else {
            $this->_cart = $_SESSION["cart"];
        }
        $this->_num_item = array_sum($this->_cart);
    }

    public function getNumItem()
    {
        return $this->_num_item;
    }

    public function __destruct()
    {
        $_SESSION["cart"] = $this->_cart;
    }

    public function bookExist($BookID)
    {
        $sql = "SELECT * FROM books WHERE BookID = ?";
        $temp = new Db();
        $result = $temp->exeQuery($sql, array($BookID));
        return count($result) > 0;
    }

    public function add($BookID, $Quantity = 1)
    {
        if (!$this->bookExist($BookID)) {
            return false;
        }

        if (isset($this->_cart[$BookID])) {
            $this->_cart[$BookID] += $Quantity;
        } else {
            $this->_cart[$BookID] = $Quantity;
        }

        $this->_num_item = array_sum($this->_cart);
        $_SESSION["cart"] = $this->_cart;
        return true;
    }

    public function remove($BookID)
    {
        if (isset($this->_cart[$BookID])) {
            unset($this->_cart[$BookID]);
            $this->_num_item = array_sum($this->_cart);
            $_SESSION["cart"] = $this->_cart;
        }
    }

    public function edit($BookID, $Quantity)
    {
        $this->_cart[$BookID] = $Quantity;
        $this->_num_item = array_sum($this->_cart);
        $_SESSION["cart"] = $this->_cart;
    }

    public function show()
    {
        $ids = array_keys($this->_cart);

        if (!empty($ids)) {
            $sql = "SELECT * FROM books WHERE BookID IN (" . implode(',', array_fill(0, count($ids), '?')) . ")";
            $temp = new Db();
            return $temp->exeQuery($sql, $ids);
        }

        return [];
    }

    public function getTotal()
    {
        $total = 0;
        $list = $this->show();

        foreach ($list as $item) {
            $total += $item["Price"] * $this->_cart[$item["BookID"]];
        }

        return $total;
    }

    public function getQuantity($BookID)
    {
        return isset($this->_cart[$BookID]) ? $this->_cart[$BookID] : 0;
    }

    public function clear()
    {
        $this->_cart = array();
        $this->_num_item = 0;
        $_SESSION["cart"] = $this->_cart;
    }

    public function getCartItems()
    {
        return $this->_cart;
    }
}
?>

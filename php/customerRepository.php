<?php

include("../spkmanhphuong/config/systemConfig.php");
include_once("../spkmanhphuong/entities/customer.php");
class customerRepository {
    private $dbReference;
    var $dbConnect;
    var $result;

    /**
    *
    */
    function __construct(){
        $this->dbReference = new systemConfig();
        $this->dbConnect = $this->dbReference->connectDB();
        if ($this->dbConnect == NULL) {
            $this->dbReference->sendResponse(503,'{"error_message":'.$this->dbReference->getStatusCodeMeeage(503).'}');
        }else{
            echo "Đã kết nối đến CSDL! \n";
        }
    }

    function __destruct(){

    }

    public function getCustomer()
    {
        # code...
        $sql = "SELECT * FROM customer";
        // Thực thi lệnh lấy dữ liệu:
        $this->result = $this->dbConnect->query($sql);
        if($this->result->num_rows > 0){
            // output data of each row
            $resultSet = array();
            while($row = $this->result->fetch_assoc()) {
                $resultSet[] = $row;
            }
            $this->dbReference->sendResponse(200,'{"items":'.json_encode($resultSet).'}');
        }else{
            //echo "0 results";
            $this->dbReference->sendResponse(200,'{"items":null}');
        }
    }

    public function register(customer $customer)
    {
        # code...
        echo json_encode($customer);
    }

    //get images
    function getAllImageResource(){
            $this->dbReference = new systemConfig();
            $this->dbConnect = $this->dbReference->connectDB();
            if ($this->dbConnect == NULL) {
                $this->dbReference->sendResponse(503,'{"error_message":'.$this->dbReference->getStatusCodeMeeage(503).'}');
            }else{

                $sql = "SELECT * FROM customer";
                $number_per_page = $_POST["number_per_page"];
                $page = ($_POST["page"]-1)*$number_per_page +1;
                $page_next = $_POST["page"]*$number_per_page;
                //echo "$page";

                if ($page != NULL && $number_per_page != NULL) {
                    //echo "viva for";
                    $sql = 'SELECT * FROM customer WHERE customer_id=1 BETWEEN $page AND $page_next';
                }/*else{
                    echo "0 results";
                    return;
                }*/
                $this->result = $this->dbConnect->query($sql);
                if($this->result->num_rows > 0){
                    // output data of each row
                    $resultSet = array();
                    while($row = $this->result->fetch_assoc()) {
                        $resultSet[] = $row;
                    }
                    $this->dbReference->sendResponse(200,'{"items":'.json_encode($resultSet).'}');
                }else{
                    //echo "0 results";
                    $this->dbReference->sendResponse(200,'{"items":null}');
                }

            }
        }
}

?>
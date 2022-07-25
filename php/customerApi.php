<?php

include("../spkmanhphuong/customerRepository.php");
include_once("../spkmanhphuong/entities/customer.php");

$method = $_SERVER['REQUEST_METHOD'];
echo $method . '\n';

switch ($method) {
    case 'GET':
        Get();
        # code...
        break;
    case 'POST':
        Post();
        # code...
        break;
    case 'PUT':
        # code...
        break;
    case 'DELETE':
        # code...
        break;
    default:
        # code...
        break;
}


function Post()
{
    $viva = new customerRepository();

    // Chuyển đổi thành đối tượng json:
    $customer_json = json_decode($_POST["customer"]);
    
    /** -----------------------------------
     * Thực hiện build đối tượng khách hàng
     * Author: NVMANH (18/07/2022)
     */
    $new_customer = new customer();
    if (is_object($customer_json)) {
        # code...
        echo "Đây là đối tượng. ";
    
        // Lấy ra properties của đối tượng (public hoặc protected):
        $reflect = new ReflectionClass($new_customer);
        $props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
    
        // Duyệt từng prop và gán giá trị tương ứng:
        foreach ($props as $prop) {
            $prop_name = $prop->getName();
            if (property_exists($customer_json, $prop_name)) {
                # code...
                $new_customer->$prop_name = $customer_json->$prop_name;
            }
        }
        $viva->register($new_customer);
    }
}

 function Get()
{
    $viva = new customerRepository();
    $viva->getCustomer();
}


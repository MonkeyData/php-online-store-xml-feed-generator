<?php

use MonkeyData\EshopXmlFeedGenerator\Config;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model\CurrentXmlModelInterface;
use MonkeyData\EshopXmlFeedGenerator\XmlGenerator\Model\XmlModel;


/**
 * Class MonkeyDataXmlModel
 *
 * Example class
 *
 * @author MD Developers
 */
class MonkeyDataXmlModel extends XmlModel implements CurrentXmlModelInterface{
    
    
    /**
    * Preparing orders is called 'per partes' in recursive function. In each call is start shifted by the length of step.
    * Default value of step is 1000.
    * If you mean that default value is inaccurate, you can change value: 
    * 
    * protected $step = 100;
    * 
    */
    
    
    /**
     * For use PDO set $config['database']['use'] = true | Usage: $this->connection->query("SELECT ...");
     *
     * @var array
     */
    protected $config = array(
        'database' => array(
            'use'  => false,
            'host' => "localhost",
            'name' => "db_name",
            'user' => "db_user",
            'pass' => "db_pass"
        )
    );

    /**
     * @var string
     */
    protected $eshopName = "MyEshop";

    /**
     * @var string
     */
    protected $eshopId = "1";
    
    public function __construct() {
        parent::__construct();
        
        // Change this sequence of code if you dont want to use config.hash file to store hash 
        // $this->setConfig(new Config("my-secret-hash")); 
    }

    
   
    /**
     * The function chooses a list of orders in selected period. The period is defined by parametres date_from and date_to.
     * The condition is met by orders which are created or updated in the selected period.
     * An example of the implementation of this condition: ((created >= '$date_from' AND created <= '$date_to') OR (updated >= '$date_from' AND updated<='$date_to'))
     * It is also important to set a limit. Values for start and step are defined by variables $start and $step ( LIMIT {$start},{$step} ). 
     * These variables are used for import optimalization if it contains large amount of orders.
     * @param string $date_from
     * @param string $date_to
     * @param int $start
     * @param int $step
     * @return array
     */
    public function getOrdersItems($date_from, $date_to, $start, $step) {
        // $result = $this->connection->query("
        // SELECT id, shop_name, shop_id, ... 
        // FROM your_orders_table
        // WHERE ((date_created >= '{$date_from}' AND date_created <= '{$date_to}') 
        // OR (date_updated >= '{$date_from}' AND date_updated<='{$date_to}')) 
        // LIMIT {$start},{$step}
        // ");
        
        $result = array(
            array(
                'id' => "1",
                'shop_name' => "MyEshop",
                'shop_id' => "MyEshop",
                'date_created' => "2015-10-10 10:10:10",
                'date_updated' => "2015-10-10 10:10:10",
                'price' => 1000.0,
                'price_without_vat' => 200.0,
                'order_status_id' => "1",
                'payment_id' => "1",
                'shipping_id' => "1",
                'customer_id' => "1",
                'note' => "Example note",
                'currency' => "USD",
                'currency_id' => "1"
            )
        );
        return $result;
    }

    /**
     * this function prepares list of orders with information about:
     * 
     * id - playment id
     * payment_name - payment name
     * payment_price - payment price incl. VAT
     * payment_price_without_vat - payment price ex. VAT
     * 
     * The list can be implemented under a condition from actually used orders Payment IDs, this list is available as a $paymentIds field.
     * If you decide not to use the list of ids of payments found in orders, the export can be slower and more data-demanding, in case of larger amount of payments.
     * 
     * 
     * @param array $paymentIds
     * @return array
     */
    public function getPaymentsItems($paymentIds) {
        //$result = $this->connection->query("
        //SELECT id, payment_name, payment_price, payment_price_without_vat 
        //FROM your_payment_catalog_table
        //WHERE id IN ('". implode("', '", $paymentIds)."') 
        //");
        
        $result = array(
            array(
                'id' => "1",
                'payment_name' => "Cash",
                'payment_price' => 0,
                'payment_price_without_vat' => 0
            )
        );
        return $result;
    }

    /**
     * This function prepares the list of shipping with information about a name, a price and a price ex. VAT.
     * 
     * id - shipping id
     * shippping_name - shipping name
     * shippping_price - shipping price incl. VAT
     * shippping_price_without_vat - shipping price ex. VAT
     * 
     *
     * The list can be implemented under a condition from actually used orders Shipping IDs, this list is available as a $shipppingIds field.
     * If you decide not to use the list of ids of shipping found in orders, the export can be slower and more data-demanding, in case of larger amount of shipping types.
 
     * 
     * @param array $shipppingIds
     * @return array
     */
    public function getShippingsItems($shipppingIds) {
        //$result = $this->connection->query("
        //SELECT id, shipping_name, shipping_price, shipping_price_without_vat 
        //FROM your_shipping_catalog_table
        //WHERE id IN ('". implode("', '", $shipppingIds)."') 
        //");
        
        $result = array(
            array(
                'id' => "1",
                'shipping_name' => "Cash",
                'shipping_price' => 0,
                'shipping_price_without_vat' => 0
            )
        );
        return $result;
    }

    /**
     * This function prepares the list of products with information about a name, a price and a price ex. VAT.
     * 
     * id - product id
     * order_id - id of order in which the product is saved
     * product_name - product name
     * product_count - number of products in an order
     * product_price - product price incl. VAT at the time of order completion
     * product_price_without_vat - product price ex. VAT at the time of order completion
     * product_purchase_price - product purchase price ex. VAT at the time of order completion
     * category_id - id of a category in which the product is placed.
     * 
     * The list can be implemented under a condition from actually used orders Order IDs, this list is available as a $orderIds field.
     * If you decide not to use the list of ids of orders found in orders, the export can be slower and more data-demanding, in case of larger amount of orders.
     * 
     * 
     * @param array $orderIds
     * @return array
     */
    public function getProductsItems($orderIds) {
        // $result = $this->connection->query("
        // SELECT p.id, op.order_id, p.product_name, op.product_count, op.product_price, op.product_price_without_vat, op.product_purchase_price, p.category_id
        // FROM your_products_table as p
        // JOIN yout_order_products_table as op ON (p.id = op.product_id)
        // WHERE op.order_id IN ('". implode("', '", $orderIds)."')
        // ");
        
        $result = array(
            array(
                'id' => "1",
                'order_id' => "1",
                'product_name' => "Example product name",
                'product_count' => 2,
                'product_price' => 500.0,
                'product_price_without_vat' => 400.0,
                'product_purchase_price' => 500.0,
                'category_id' => "2"
            )
        );
        return $result;
    }

    /**
     *  This function prepares the list of orders statuses as key-value pairs, named ids and order_status_name,
     *  then the name is searched by an id.
     * 
     * 
     *  The list can be implemented under a condition from actually used orders OrderStatus IDs, this list is available as a $orderStatusesIds field.
     *  If you decide not to use the list of ids of orders statuses found in orders, the export can be slower and more data-demanding.
     *
     * 
     * @param array $orderStatusesIds
     * @return array
     */
    public function getOrderStatusesItems($orderStatusesIds) {
        //$result = $this->connection->query("
        //SELECT id, order_status_name
        //FROM your_order_status_catalog_table 
        //WHERE id IN ('". implode("', '", $orderStatusesIds)."') 
        //");
        
        $result = array(
            array('id' => '1', 'order_status_name' => 'pending')
        );
        return $result;
    }

    /**
     * 
     * This function prepares the list of customers with information about:
     * 
     *
     * id - user ID must be unique, if all non-registred users have same id (for example 0), must be used something else unique (for example md5(customer_email)).
     * customer_firstname - customer's first name
     * customer_country - country according to customer's address
     * customer_city - country according to customer's address
     * customer_zip_code - ZIP code according to customer's address
     * customer_email - customer's email
     * customer_registration - indicates if it is a registered customer ( 0 ), or he chose the purchase without registration ( 1 ), (INT 0 or 1)
     * customer_type - indicates if it is an end customer ( 0 ) or a company ( 1 ), (INT 0 or 1)
     * customer_vat_status - indicates  it is a VAT payer (1) or not (0), (INT 0 or 1)
     * 
     *
     * The list can be implemented under a condition from actually used orders Customer IDs, this list is available as a $customerIds field.
     *  If you decide not to use the list of ids of customers found in orders, the export can be slower and more data-demanding, in case of larger amount of customers.
     * @param array $customerIds
     * @return array
     */
    public function getCustomersItems($customerIds) {
        //$result = $this->connection->query("
        //SELECT id, customer_email, customer_city, ...
        //FROM your_customer_table
        //WHERE id IN ('".  implode("', '", $customerIds)."')
        //");
        
        
        $result =  array(
            array(
                'id' => "1",
                'customer_email' => "mail@example.com",
                'customer_city' => "Example city",
                'customer_country' => "Example country",
                'customer_firstname' => "Example firstname",
                'customer_registration' => true,
                'customer_zip_code' => "777 77",
                'customer_vat_status' => false,
                'customer_type' => "customer"
            )
        );
        return $result;
    }

    /**
     * this function prepares the list of categories with information about:
     * id - category ID
     * category_name - category name
     * parent_id - ID  of a parent category
 
     * @return array
     */
    public function getCategoriesItems() {
        // $result = $this->connection->query("SELECT id, category_name, parent_id, ...");
        $result = array(
            array(
                'id' => "1",
                'category_name' => "Example category",
                'parent_id' => null
            ),
            array(
                'id' => "2",
                'category_name' => "Example category 2",
                'parent_id' => "1"
            )
        );
        return $result;
    }

    
}
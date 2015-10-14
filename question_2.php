<?php
namespace SoftwareEngineerTest;

// Question 2 & 3 & 4

/**
 * Customer class 
 *
 * This class contains functions for Bronze customer
 *
 * @package Customer
 * @subpackage Bronze_Customer Silver_Customer Gold_Customer
*/
abstract class Customer {
	protected $id;
	protected $balance = 0;
	protected $object;
	protected $type;
/**
 * Constructor 
 *
 * This function is called when an object is initialized 
*/
	public function __construct($id) {
		$this->id = trim($id);
		$this->type = substr($customer_id,0,1);
	}
/**
 * get_balance function 
 *
 * This function is used to get the balance of a customer 
*/
	public function get_balance() {
		return $this->balance;		
	}
/**
 * generate_username Function 
 *
 * This function returns the generated username based on the customer id provided 
*/
	public function generate_username() {
		$username = uniqid($this->type);
		return $username;		
	}
/**
 * get_instance Function 
 *
 * This function returns the corresponding customer object 
 *
 * @param string $customer_id ID of the customer
*/	
	public function get_instance($customer_id) {
		$customer_id = trim($customer_id);
		if(strlen($customer_id) > 10) {
			throw new InvalidArgumentException('Invalid Customer ID passed to get_instabce function'); 
		}
 
		$customer_type = substr($customer_id,0,1);
 
		if($customer_type == "B") {
			$this->object = new Bronze_Customer;
		} elseif($customer_type == "S") {
			$this->object = new Silver_Customer;
		} elseif($customer_type == "G") {
			$this->object = new Gold_Customer;
		} else {
			throw new InvalidArgumentException('Invalid Customer ID passed to get_instabce function');  
		}
		$this->id = $customer_id;
		$this->type = $customer_type;	
		return $this->object;
	}
}


/**
 * Bronze customer class
 *
 * This class contains functions for Bronze customer
 *
 * @package Bronze_Customer
*/

class Bronze_Customer extends Customer {
	
/**
 * deposit Function 
 *
 * This function returns the bronze customer deposit amount after adding the credits if applicable 
 *
 * @param int $deposit_amt IAmount to e deposited
*/	
	private function deposit($deposit_amt) {
		$this->balance = $deposit_amt
	}
}
/**
 * Silver customer class 
 *
 * This class contains functions for Silver customer
 *
 * @package Silver_Customer
*/

class Silver_Customer extends Customer {	
	
/**
 * deposit Function 
 *
 * This function returns the silver customer deposit amount after adding the credits if applicable 
 *
 * @param int $deposit_amt IAmount to e deposited
*/	
	private function deposit($deposit_amt) {
		$deposit_amt = $deposit_amt + (($deposit_amt / 100) * 5);
		$this->balance = $deposit_amt
	}	
}

/**
 * Gold customer class 
 *
 * This class contains functions for Gold customer
 *
 * @package Gold_Customer
*/

class Gold_Customer extends Customer {
	
/**
 * deposit Function  
 *
 * This function returns the gold customer deposit amount after adding the credits if applicable 
 *
 * @param int $deposit_amt IAmount to e deposited
*/	
	private function deposit($deposit_amt) {
		$deposit_amt = $deposit_amt + (($deposit_amt / 100) * 10);
		$this->balance = $deposit_amt
	}	
}
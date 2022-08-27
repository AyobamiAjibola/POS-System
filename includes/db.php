<?php
	class Database {
    private $db;
    private static $instance;

	// private constructor
    private function __construct() {
		$servername = "localhost";
		$username = "root";
		$password = "";

		try {
			$this->db = new PDO("mysql:host=$servername; dbname=rest", $username, $password);
			// set the PDO error mode to exception
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully";
			// I won't echo thsi message but use it to for checking if you connected to the db
			//incase you don't get an error message
			}
		catch(PDOException $e)
			{
			echo "Connection failed: " . $e->getMessage();
			}
    }
	
    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    
	
	//To be honest, this is not the best way. We migth need to change it later.
	//It will select first before counting.
	//PDO does not have a count function :-(

    public function select_count($col, $table){
		$stmt = $this->db->prepare("SELECT COUNT($col) FROM $table");
		$stmt->execute([]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}

	public function count_where_admin($table,$col, $id, $col2, $id2){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $col = ? AND $col2 = ?");
		$stmt->execute([$id, $id2]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}

	public function sum_admin($col, $table, $trans, $val){
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE payment_status = ? AND trans_type = ?");
		$stmt->execute([$trans, $val]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	public function count_all_user_id($table, $where, $user_id){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = ?");
		$stmt->execute([$user_id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}
	
	public function count_from($table){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table");
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function count_where($table,$where,$id){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = ?");
		$stmt->execute([$id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function count_where_bulk($table,$where,$id){
		$today = date("Y-m-d");
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = ? AND buy_date = ?");
		$stmt->execute([$id,$today]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function count_where_single($table,$where,$id){
		$today = date("Y-m-d");
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = ? AND item_buy_date = ?");
		$stmt->execute([$id,$today]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}
	
	public function count_where_and($table,$where,$id,$wheret,$idt){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = ? AND $wheret = ?");
		$stmt->execute([$id,$idt]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
		
	}
	public function count_where_and_not($table,$where,$id,$wheret,$idt){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = ? AND $wheret != ?");
		$stmt->execute([$id,$idt]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
		
	}
	
	public function count_where_and_and($table,$where,$id,$wheret,$idt,$whereth,$idth){
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = ? AND $wheret = ? AND $whereth = ?");
		$stmt->execute([$id,$idt,$idth]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
		
	}
	
	
	//This method is for general select
	public function select($table){
		try {
			$stmt = $this->db->prepare("SELECT * FROM $table");
			$stmt->execute();
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
		
	}//end class

	public function select_from_ord2($table,$ord){
		try {
			$que = $this->db->prepare("SELECT * FROM $table ORDER BY id $ord");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;		
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	public function select_from_while($table,$col,$val){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$val]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where2($table,$col,$userid){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$userid]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_for_trans($table,$col,$userid){
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY id DESC");
			$que->execute([$userid]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_transactions($user_id){
		try {
			$bank = "Bank";
			$status = 0;
			$que= $this->db->prepare("SELECT order_id FROM transactions WHERE user_id= ? AND payment_type = ? AND payment_status = ?");
			$que->execute([$user_id, $bank, $status]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_where($table,$col,$id){
		
		try {
			$que= $this->db->prepare("SELECT * FROM $table WHERE $col= ? LIMIT 1"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_where_no_limit($table,$col,$id){
		
		try {
			$stmt = $this->db->prepare("SELECT * FROM $table WHERE $col =? ");
			$stmt->execute([$id]);
			return $stmt;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_where_and($table,$col,$id,$colt,$idt){
		
		try {
			$stmt = $this->db->prepare("SELECT * FROM $table WHERE $col =? AND $colt =?");
			$stmt->execute([$id,$idt]);
			return $stmt;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_wherenot($table,$col,$id){
		try {
			$que= $this->db->prepare("SELECT * FROM $table where $col!=?");
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	
	public function get_last_id(){
		try{
			$que= $this->db->prepare("SELECT MAX(buy_detail_id) FROM buy_detail");
			$que->execute();
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}
	
	public function get_name_from_id($tab,$col,$whe,$id){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col where $whe =?");
			$que->execute([$id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}
	
	public function get_name_from_id_where($tab,$col,$whe,$id,$whet,$idt){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col where $whe =? AND $whet =?");
			$que->execute([$id,$idt]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$stmt = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}
	public function get_name_from_id_where_not($tab,$col,$whe,$id,$whet,$idt){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col where $whe =? AND $whet !=?");
			$que->execute([$id,$idt]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;		
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}
	
	public function get_name_from_id_where_and($tab,$col,$whe,$id,$whet,$idt,$wheth,$idth){
		try{
			$que= $this->db->prepare("SELECT $tab FROM $col where $whe =? AND $whet =? AND $wheth =?");
		$que->execute([$id,$idt,$idth]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$stmt = null;			
		} catch(PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}	
	}
	
	
	public function select_from($field){
		try {
			$stmt = $this->db->prepare("SELECT * FROM $field");
			$stmt->execute();
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	//ord
	public function select_from_ord($field,$id,$ord){
		try {
			$stmt = $this->db->prepare("SELECT * FROM $field ORDER BY $id $ord");
			$stmt->execute();
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_from_wherenot_ord($table,$col,$id,$orid,$ord){
		try {
			$que= $this->db->prepare("SELECT * FROM $table where $col!=? ORDER BY $orid $ord");
			$que->execute([$id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	
	public function select_from_where_ord($tab,$col,$whe,$tab_id,$ord){
		try {
			
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col =? ORDER BY $tab_id $ord");
			$stmt->execute([$whe]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}
	
	public function get_range($from,$to){
		try {
			
			$stmt = $this->db->prepare("SELECT * FROM buy_detail a 
										left join user b on a.sold_by_id = b.user_id
										left join item d on a.item_id = d.item_id
										left join item_type e on d.item_type_id = e.item_type_id
										WHERE DATE(a.item_buy_date) >= ? AND DATE(a.item_buy_date) <= ? ORDER BY a.buy_detail_id Desc");
			$stmt->execute([$from,$to]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}
	
	public function get_range_staff($from,$to,$staff){
		try {
			
			$stmt = $this->db->prepare("SELECT * FROM buy_detail a 
										left join user b on a.sold_by_id = b.user_id
										left join item d on a.item_id = d.item_id
										left join item_type e on d.item_type_id = e.item_type_id
										WHERE DATE(a.item_buy_date) >= ? AND DATE(a.item_buy_date) <= ? AND a.sold_by_id = ? ORDER BY a.buy_detail_id Desc");
			$stmt->execute([$from,$to,$staff]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;	
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}		
	}
	
	public function select_from_where_and_ord($table,$col,$id,$colt,$idt,$tab_id,$ord){
		
		try {
			$stmt = $this->db->prepare("SELECT * FROM $table WHERE $col =? AND $colt =?  ORDER BY $tab_id $ord");
			$stmt->execute([$id,$idt]);
			return $stmt;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	public function select_from_users(){
		
		try {
			$stmt = $this->db->prepare("SELECT * FROM user ORDER BY user_id desc LIMIT 10");
			$stmt->execute();
			return $stmt;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();			
		}
	}
	
	//delete
	public function delete_things($tab,$col,$value) {
		try{
			$stmt = $this->db->prepare("DELETE FROM $tab WHERE $col=?");		
			$stmt->execute([$value]);
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}	
	}
	
	public function delete_things_none($tab) {
		try{
			$stmt = $this->db->prepare("DELETE FROM $tab");		
			$stmt->execute();
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}	
	}

	public function verify($user){		
		try {
			$active = 1;
			$success = 'Done';
			$stmt = $this->db->prepare("UPDATE user SET activate = ? WHERE user_id = ?");
			$stmt->execute([$active, $user]);
			$this->delete_things('verify_user','user_id',$user);
			$_SESSION['userSession'] = $user;
			unset($_SESSION['userVerify']);
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					<strong>Error!</strong>
				  </div>: ' . $e->getMessage();
		}
	}

public function update_buy(){
		try {
			$pas = 1;
		$stmt = $this->db->prepare("UPDATE buy_detail SET handled = ?");
		$stmt->execute([$pas]);
		$success = '<div class="alert alert-success">
					Kitchen Updated
				  </div>';
		return $success;
		$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Kitchen not updated
				  </div>: ' . $e->getMessage();
		}
		
	}

	public function change_user_password($password,$user){
		try {
		$stmt = $this->db->prepare("UPDATE user SET password = ? WHERE user_id = ?");
		$stmt->execute([$password, $user]);
		$success = '<div class="alert alert-success">
					Password updated
				  </div>';
		return $success;
		$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					<strong>Error!</strong> Password not updated
				  </div>: ' . $e->getMessage();
		}
		
	}
	
	public function update_user_password($password,$user){
		try {
		$stmt = $this->db->prepare("UPDATE user SET password = ? WHERE user_id = ?");
		$stmt->execute([$password, $user]);
		$success = '<div class="alert alert-success">
					Password updated
				  </div>';
		return $success;
		$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					<strong>Error!</strong> Password not updated
				  </div>: ' . $e->getMessage();
		}
		
	}
	
																	//ADMIN SECTION
																	
	public function login($username,$password){
		try {
			$stmt= $this->db->prepare("SELECT * FROM user WHERE username= ? LIMIT 1"); //using LIMIt fro optimization purpose
			$stmt->execute([$username]);
			$count = $stmt->rowCount();
			if($count == 1){
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
				$realpassword = $row['password'];
				$user_id = $row['user_id'];
				$type = $row['user_type_id'];
				if(password_verify($password, $realpassword)){
					session_unset();
					session_start();
					$_SESSION['userSession'] = $user_id;
					$_SESSION['userType'] = $type;
					$_SESSION['userFull'] = $row['first_name'].' '.$row['last_name'];
					$sign = 'Login';
					$loc = '';
					if($type == 1){
						$loc = 'dashboard';
					}elseif($type == 2){
						$loc = 'kitchen';
					}elseif($type == 3){
						$loc = 'sell';
					}
					
					echo json_encode(array("value" => $sign, "value2" => $loc));
					
				} else{
					$result = '<div class="alert alert-danger">
								Password is Incorrect.
							</div>';
					$sign = 'false';
					echo json_encode(array("value" => $sign, "value2" => $result));
				}
			$stmt = null;
		}else{
			 $result= '<div class="alert alert-danger">
						Username does not exist.
					</div>';
			$sign = 'false';
			echo json_encode(array("value" => $sign, "value2" => $result));
		}
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
							<strong>Error</strong>
						</div>' . $e->getMessage();			
		}
	}
	
	
	public function edit_user_profile($first,$last,$type,$val){
		try {
		$stmt = $this->db->prepare("UPDATE user SET first_name = ?,last_name = ?,user_type_id = ? WHERE user_id = ?");
		$stmt->execute([$first, $last, $type, $val]);
		$success = '<div class="alert alert-success">
					User Updated
				  </div>';
		return $success;
		$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					<strong>Error!</strong> User not updated
				  </div>: ' . $e->getMessage();
		}
		
	}
	
	
	
	public function update_password($password,$user){
		try {
		$stmt = $this->db->prepare("UPDATE user SET password = ? WHERE user_id = ?");
		$stmt->execute([$password, $user]);
		$success = '<div class="alert alert-success">
					Password updated
				  </div>';
		return $success;
		$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					<strong>Error!</strong> Password not updated
				  </div>: ' . $e->getMessage();
		}
		
	}
	
	//********************************************************************************//
	
	public function insert_into_user($first,$last,$type,$username,$password){
		try {
		$stmt = $this->db->prepare("INSERT INTO user(first_name,last_name,user_type_id,username,password) 
		VALUES (?,?,?,?,?)");
			$stmt->execute([$first,$last,$type,$username,$password]);
			$success = '<div class="alert alert-success">
					Staff Added
				  </div>';
			echo $success;
			
		
		} catch (PDOException $e) {
			// For handling error
			$error = '<div class="alert alert-danger">
					Username Already Exist
				  </div>';
				  
			
			echo $error;
		}
	}
	
	

	//edit profile
	public function editProfileUser($hash, $user_id){
		try {
			$stmt = $this->db->prepare("UPDATE user SET password = ? WHERE user_id = ?")->execute([$hash, $user_id]);
			$success = 'Done';
			return $success;
			$stmt = null;			
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Profile could not be updated
				  </div>: ' . $e->getMessage();			
		}
	}
	
	//ADMIN SECTION
	
	
	public function new_product($name,$quantity,$price,$category,$fullname){		
		try {
			$stmt = $this->db->prepare("INSERT INTO product(product_name,quantity,price,image,product_category_id) 
			VALUES (?,?,?,?,?)");
			$stmt->execute([$name,$quantity,$price,$fullname,$category,]);
			$stmt = null;
			return $success = 'Done';
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Product could not be added
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function edit_product($name,$price,$category,$fullname, $val,$oldimg){		
		try {
			$stmt = $this->db->prepare("UPDATE product SET product_name = ?, price = ?, image = ?, product_category_id = ? WHERE product_id = ?");
			$stmt->execute([$name,$price,$fullname,$category,$val]);
			if($oldimg != ""){
			unlink('../../images/products/'.$oldimg);
			}
			$stmt = null;
			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Product Category could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function restock($quantity, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE item SET quantity = ? WHERE item_id = ?");
			$stmt->execute([$quantity,$val]);
			$stmt = null;
			$success = '<div class="alert alert-success">
							Restock Complete'.$quantity.'
						</div>';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Restock could not be Done
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function insert_user_addchkaddress($user,$phone,$state,$city,$address){		
		try {
			$stmt = $this->db->prepare("INSERT INTO chk_address(user_id,phone,state,city,address) 
			VALUES (?,?,?,?,?)");
			$stmt->execute([$user,$phone,$state,$city,$address]);
			$db_id = $this->db->lastInsertId();
			unset($_SESSION['chaddress']);
			$_SESSION['chaddress'] = $db_id;
			$stmt = null;
			return $success = 'Done';
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Address could not be added
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function sell_data($track,$data,$customer,$infor,$user,$vat){		
		try {
			$totalItem = 0;
			$total_price = 0;
			//$data = json_decode(stripslashes($data), true);
			$this->db->beginTransaction();
			$stmt = $this->db->prepare("INSERT INTO buy_detail(reference,customer,item_id,quantity_sold,item_price,sold_by_id) 
			VALUES (?,?,?,?,?,?)");
			foreach($data as $row){
				$totalItem ++;
				$item_id = $row['item_id'];
				$quantity = $row['quan'];
				//$customer = ucfirst($row['customer']);
				$amount = $row['price'] * $row['quan'];
				$total_price+= $amount;
				$stmt->execute(array($track,$customer,$item_id,$quantity,$amount,$user));
			}
			
			//query 2
			$vatAmount = $vat/100 * $total_price;
			$stmt = $this->db->prepare("INSERT INTO buy_bulk(reference,customer,total_prod,amount,sold_by,vat_amount,extra_infor) 
			VALUES (?,?,?,?,?,?,?)");
			$stmt->execute([$track,$customer,$totalItem,$total_price,$user,$vatAmount,$infor]);
			$db_id = $this->db->lastInsertId();
	
			//query 3
			$stmt = $this->db->prepare("UPDATE item SET quantity = ? WHERE item_id = ?");
			foreach($data as $row){
				
				$item_id = $row['item_id'];
				$quantity = $row['quan'];
				$quanori = $this->get_name_from_id('quantity','item','item_id',$item_id);
				$quantleft = '';
				if($quanori == 0){
						$quantleft = 0;
				}else{
						$quantleft = $quanori - $quantity;
				}
				$stmt->execute(array($quantleft,$item_id));
			}
			$this->db->commit();
			$stmt = null;
			$sign = 'Done';
			echo json_encode(array("value" => $sign, "value2" => $track)); 
		} catch (PDOException $e) {
			// For handling error
			$sign = 'false';
			$go = '<div class="alert alert-danger">
					 Order could not be added
				  </div>: ' . $e->getMessage();
			echo json_encode(array("value" => $sign, "value2" => $go));
		}
	}
	
	
	public function finish_kitchen($id){		
		try {
			$hand =1;
			$stmt = $this->db->prepare("UPDATE buy_detail SET handled = ? WHERE buy_detail_id = ?");
			$stmt->execute([$hand,$id]);
			$stmt = null;
			$success = 'Yes';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Could Not be Cleared
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function insert_category($name){		
		try {
			$stmt = $this->db->prepare("INSERT INTO item_type(item_type) 
			VALUES (?)");
			$stmt->execute([$name]);
			$stmt = null;
			return $success = '<div class="alert alert-success">
								Item Category added
							</div>';
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Item Category could not be added
				  </div>';
		}
	}
	
	public function edit_category($name, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE item_type SET item_type = ? WHERE item_type_id = ?");
			$stmt->execute([$name,$val]);
			$stmt = null;
			$success = '<div class="alert alert-success">
							Item Category updated
						</div>';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Item Category could not be updated
				  </div>';
		}
	}
	
	
	public function insert_item($item,$quantity,$price,$category){		
		try {
			$stmt = $this->db->prepare("INSERT INTO item(item,item_type_id,price,quantity) 
			VALUES (?,?,?,?)");
			$stmt->execute([$item,$category,$price,$quantity]);
			$stmt = null;
			return $success = '<div class="alert alert-success">
								Item Added
							</div>';
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Item could not be added
				  </div>';
		}
	}
	
	public function edit_item($item,$price,$category, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE item SET item = ?,price = ?,item_type_id = ?  WHERE item_id = ?");
			$stmt->execute([$item,$price,$category, $val]);
			$stmt = null;
			$success = '<div class="alert alert-success">
							Item Updated
						</div>';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Item could not be updated
				  </div>';
		}
	}
	
	
	public function update_status($status, $val){		
		try {
			$stmt = $this->db->prepare("UPDATE order_bulk SET order_status_id = ? WHERE reference = ?");
			$stmt->execute([$status,$val]);
			$stmt = null;
			$success = '<div class="alert alert-success">
							Status updated
						</div>';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	

	public function contact_us($name,$email,$phone,$message){		
		try {
			$success = '<div class="alert alert-success">
							Message Sent
				  		</div>';
			$stmt = $this->db->prepare("INSERT INTO support(name,email,phone,message) 
			VALUES (?,?,?,?)");
			$stmt->execute([$name,$email,$phone,$message]);
			$stmt = null;
			include '../includes/mail/mail_script.php';  //needed for sending emails
				inform_admin_support($email, $name, $phone);
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Message Could not be sent
				  </div>: ' . $e->getMessage();
		}
	}


	public function select_from_limit(){
		try {
			$que= $this->db->prepare("SELECT * FROM product a
									left join product_category b on a.product_category_id = b.product_category_id
									ORDER BY a.product_id Desc LIMIT 10");
			$que->execute();
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}

	
	
	public function edit_sett($name,$vat,$val){		
		try {
			$stmt = $this->db->prepare("UPDATE sett SET system_title = ?,vat = ? WHERE sett_id = ?");
			$stmt->execute([$name,$vat,$val]);
			$stmt = null;
			$success = '<div class="alert alert-success">
							Settings updated
						</div>';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					Settings could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
	
	public function select_print_order($value){
		try {
			$que= $this->db->prepare("SELECT * FROM buy_detail a 
										left join item b on a.item_id = b.item_id 
										left join user c on a.sold_by_id = c.user_id 
										WHERE a.reference = ? ORDER BY buy_detail_id Desc");
			$que->execute([$value]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	
	
	public function select_buy_account(){
		try {
			$que= $this->db->prepare("SELECT * FROM buy_detail a
										left join item b on a.item_id = b.item_id
										left join item_type c on b.item_type_id = c.item_type_id
										left join user d on a.sold_by_id = d.user_id
										ORDER BY buy_detail_id Desc");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_buy_account_limit(){
		try {
			$que= $this->db->prepare("SELECT * FROM buy_detail a
										left join item b on a.item_id = b.item_id
										left join item_type c on b.item_type_id = c.item_type_id
										left join user d on a.sold_by_id = d.user_id
										ORDER BY buy_detail_id Desc LIMIT 10");
			$que->execute();
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_kitchen_handled(){
		try {
			$hand = 1;
			$que= $this->db->prepare("SELECT * FROM buy_detail a
										left join item b on a.item_id = b.item_id
										Where a.handled = ? ORDER BY buy_detail_id Desc LIMIT 10");
			$que->execute([$hand]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	public function select_from_kitchen(){
		try {
			$type = 1;
			$hand = 0;
			$que= $this->db->prepare("SELECT * FROM buy_detail a
										left join item b on a.item_id = b.item_id
										WHERE a.handled = ? and b.item_type_id = ? ORDER BY buy_detail_id ASC");
			$que->execute([$hand,$type]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}
	
	public function select_from_kitchen_live($id){
		try {
			$type = 1;
			$type2 = 4;
			$hand = 0;
			$que= $this->db->prepare("SELECT * FROM buy_detail a
										left join item b on a.item_id = b.item_id
										WHERE a.handled = ? and (b.item_type_id = ? OR b.item_type_id = ?) and a.buy_detail_id > ? ORDER BY buy_detail_id ASC");
			$que->execute([$hand,$type,$type2,$id]);
			return $que;
			$que = null;			
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
			
		}
	}


	
	//end frontend

	
	
}	
<?php
    class ParcelClients extends Db {


       
        public function getClientOrderList($reg_id) {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_checkout ck 
                LEFT JOIN tbl_registration reg ON reg.reg_id=ck.reg_id LEFT JOIN tbl_menu m ON m.menu_id=ck.menu_id WHERE CK.reg_id=$reg_id ORDER BY ck.checkout_id DESC");
                $stmt->execute();

                $arr = array();

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)
                ) {
                    $arr[] = $result;
                }

                return $arr;
                
            } catch (Exception $e) {
                echo $e->getMessage();
                die();  
            }
        }

        public function getParcelClients() {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_checkout ck 
                LEFT JOIN tbl_registration reg ON reg.reg_id=ck.reg_id LEFT JOIN tbl_menu m ON m.menu_id=ck.menu_id  WHERE ck.status_order != -2  ORDER BY ck.order_date desc");
                $stmt->execute();

                $arr = array();

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)
                ) {
                    $arr[] = $result;
                }

                return $arr;
                
            } catch (Exception $e) {
                echo $e->getMessage();
                die();  
            }
        }

        public function getNotifications($customerID) {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM `tbl_checkout` WHERE active IN (-1, 0, 2)  AND  reg_id='$customerID' order by delivered_date desc ");
                $stmt->execute();

                $arr = array();

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)
                ) {
                    $arr[] = $result;
                }

                return $arr;
                
            } catch (Exception $e) {
                echo $e->getMessage();
                die();  
            }
        }

        public function getNotificationContent($customerID) {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM `tbl_checkout` WHERE active IN ('2', '3','-1','0') AND reg_id='$customerID' ORDER BY delivered_date DESC; ");
                $stmt->execute();

                $arr = array();

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)
                ) {
                    $arr[] = $result;
                }

                return $arr;
                
            } catch (Exception $e) {
                echo $e->getMessage();
                die();  
            }
        }
        public function updateNotif($ckid) {
            $active = 3;
            try {
                // Update the SQL query to set the active status correctly
                $stmt = $this->connect()->prepare("UPDATE `tbl_checkout` SET active = :active WHERE checkout_id = :ckid");
        
                // Bind the parameters correctly
                $stmt->execute([
                    'active' => $active,
                    'ckid' => $ckid // Changed from 'checkout_id' to 'ckid' to match the query
                ]);
            } catch (Exception $e) {
                echo "Can't update notif: " . $e->getMessage();
                exit;
            }
        }
        
        public function viewParcelClients($regId, $checkoutId) {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_checkout ck LEFT JOIN tbl_registration reg ON reg.reg_id=ck.reg_id LEFT JOIN tbl_menu m ON m.menu_id=ck.menu_id LEFT JOIN tbl_category ct ON ct.cat_id=ck.cat_id WHERE ck.reg_id=:reg_id AND ck.checkout_id=:checkout_id ORDER BY ck.checkout_id DESC");
                $stmt->execute([
                    'reg_id' => $regId,
                    'checkout_id' => $checkoutId
                ]);

                $arr=[];

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)
                ) {
                    $arr = $result;
                }

                return $arr;

                
                
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function updateStatus($status, $ckid)  {

            try {

                $stmt = $this->connect()->prepare("UPDATE `tbl_checkout` SET status_order=:status_order WHERE checkout_id=:checkout_id");

                $stmt->execute([
                    'status_order' => $status,
                    'checkout_id' => $ckid
                ]);

                return true;

            } catch (Exception $e) {
                echo "Update Status:".$e->getMessage();
                exit;
            }
        }
    }
?>
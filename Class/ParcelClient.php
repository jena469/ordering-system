<?php
class ParcelClients extends Db
{



    public function getClientOrderList($reg_id)
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * 
FROM tbl_checkout ck 
LEFT JOIN tbl_registration reg ON reg.reg_id = ck.reg_id 
LEFT JOIN tbl_menu m ON m.menu_id = ck.menu_id 
WHERE ck.reg_id = $reg_id 
GROUP BY ck.transaction_id
ORDER BY ck.checkout_id DESC;
");
            $stmt->execute();

            $arr = array();

            while (
                $result = $stmt->fetch(PDO::FETCH_ASSOC)
            ) {
                $arr[] = $result;
            }

            return $arr;

        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function getParcelClients()
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * 
            FROM tbl_checkout ck 
            LEFT JOIN tbl_registration reg ON reg.reg_id = ck.reg_id 
            LEFT JOIN tbl_menu m ON m.menu_id = ck.menu_id
            WHERE ck.status_order != -2
            AND ck.checkout_id IN (
                SELECT MAX(ck.checkout_id)
                FROM tbl_checkout ck
                WHERE ck.status_order != -2
                GROUP BY ck.transaction_id
            )
            ORDER BY ck.checkout_id desc;
");
            $stmt->execute();

            $arr = array();

            while (
                $result = $stmt->fetch(PDO::FETCH_ASSOC)
            ) {
                $arr[] = $result;
            }

            return $arr;

        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function getNotifications($customerID)
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM `tbl_checkout` WHERE active IN (-1, 0, 2)  AND  reg_id='$customerID' order by delivered_date desc ");
            $stmt->execute();

            $arr = array();

            while (
                $result = $stmt->fetch(PDO::FETCH_ASSOC)
            ) {
                $arr[] = $result;
            }

            return $arr;

        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function getNotificationContent($customerID)
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM `tbl_checkout` 
                                                        WHERE active IN ('2', '3','-1','0') 
                                                        AND reg_id='$customerID'
                                                            GROUP BY transaction_id  
                                                        ORDER BY delivered_date ASC, checkout_id DESC; ");
            $stmt->execute();

            $arr = array();

            while (
                $result = $stmt->fetch(PDO::FETCH_ASSOC)
            ) {
                $arr[] = $result;
            }

            return $arr;

        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }
    public function updateNotif($ckid)
    {
        $active = 3;
        try {
            $stmt = $this->connect()->prepare("UPDATE `tbl_checkout` SET active = :active WHERE checkout_id = :ckid");

            $stmt->execute([
                'active' => $active,
                'ckid' => $ckid
            ]);
        } catch (Exception $e) {
            echo "Can't update notif: " . $e->getMessage();
            exit;
        }
    }

    public function viewParcelClients($regId, $checkoutId, $transaction_id)
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_checkout ck 
                                               LEFT JOIN tbl_registration reg ON reg.reg_id=ck.reg_id 
                                               LEFT JOIN tbl_menu m ON m.menu_id=ck.menu_id 
                                               LEFT JOIN tbl_category ct ON ct.cat_id=ck.cat_id 
                                               WHERE ck.transaction_id = :transaction_id 
                                               ORDER BY ck.checkout_id DESC");
            $stmt->execute([
                'transaction_id' => $transaction_id,  // No need to bind reg_id and checkout_id in this case
            ]);

            $arr = [];

            // Fetch each row and push to the array
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($arr, $result);
            }

            return $arr;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function updateStatus($status, $transaction_id)
    {

        try {

            $stmt = $this->connect()->prepare("UPDATE `tbl_checkout` SET status_order=:status_order WHERE transaction_id=:transaction_id");

            $stmt->execute([
                'status_order' => $status, //pag -1=pending tapos -2reject 0=to pay 1=toshipped yung 2=toreceived
                'transaction_id' => $transaction_id
            ]);

            return true;

        } catch (Exception $e) {
            echo "Update Status:" . $e->getMessage();
            exit;
        }
    }
}
?>
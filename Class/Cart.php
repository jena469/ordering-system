<?php
class Cart extends Db
{

    public function getaddressForReciept($reg_id)
    {
        try {
            $stmt = $this->connect()->prepare("SELECT address,payment_method FROM tbl_checkout WHERE reg_id=:reg_id LIMIT 01");
            $stmt->execute([
                'reg_id' => $reg_id
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return [$result['address'], $result['payment_method']];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getMenuForReciept($menuId)
    {
        try {
            $stmt = $this->connect()->prepare("SELECT title,price FROM tbl_menu WHERE menu_id=:menu_id ORDER BY menu_id");
            $stmt->execute([
                'menu_id' => $menuId
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return [$result['title'], $result['price']];
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getPreviewCartCategory($menuId)
    {
        $status = 'active';

        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_menu WHERE menu_id=:menu_id AND status=:status ORDER BY menu_id");
            $stmt->execute([
                'menu_id' => $menuId,
                "status" => $status
            ]);

            $arr = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $arr[] = $result;
            }

            return $arr;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function stocksItem($menuId, $stockcheckouts)
    {

        try {

            $stmt = $this->connect()->prepare("UPDATE `tbl_menu` SET stocks=stocks-:stocks WHERE menu_id=:menu_id");

            $stmt->execute([
                'stocks' => $stockcheckouts,
                'menu_id' => $menuId
            ]);
        } catch (Exception $e) {
            echo "Minus Stocks Query:" . $e->getMessage();
            exit;
        }
    }

    public function saveCheckout($orderItem, $data, $files)
    {

        $file = 'no image';

        if (isset($files['gcashReciept']['name'])) {
            include("Upload.php");

            $file = upload($files['gcashReciept']);
        }

        // echo json_encode([
        //     'message' => $data['address'],
        //     'status'  => 'error'
        // ]);

        // die();

        try {
            if (count($orderItem) == 0) {
                return array(
                    'status' => 'warning',
                );
                exit;
            }
            function generateTransactionID($prefix = 'TXN')
            {
                $uniqueID = uniqid($prefix, false);
                return strtoupper($uniqueID);
            }
            $transactionID = generateTransactionID();

            foreach ($orderItem as $row) {
                $stmt = $this->connect()->prepare("INSERT INTO tbl_checkout (transaction_id, reg_id, menu_id, cat_id, checkout_Qty, phone, address, payment_method, proof_gcpayment) VALUES (:transaction_id, :reg_id, :menu_id, :cat_id, :checkout_Qty, :phone, :address, :payment_method, :proof_gcpayment)");

                $result = $stmt->execute(params: [
                    "transaction_id" => $transactionID, // Corrected variable
                    "menu_id" => $row['menuId'],
                    "cat_id" => $row['categoryId'],
                    "reg_id" => $row['UserId'],
                    "checkout_Qty" => $row['qty'],
                    "phone" => $data['phonenum'],
                    "address" => $data['address'],
                    "payment_method" => $data['paymenttype'],
                    "proof_gcpayment" => $file,
                ]);

                $this->stocksItem($row['menuId'], $row['qty']);
                $regID = $row['UserId'];
            }

            return array(
                'transaction_id' => $transactionID,
                'reg_id' => $regID,
                'message' => $result,
                'status' => 'success',
            );
        } catch (Exception $e) {
            return array(
                'message' => 'Error: ' . $e->getMessage(),
                'status' => 'error',
            );
        }
    }

    public function handleApproval($isApproved, $checkoutID, $transaction_id, $reason)
    {

        try {

            $stmt = $this->connect()->prepare("UPDATE tbl_checkout SET status_order = :status_order , reason = :reason WHERE transaction_id = :transaction_id");
            $result = $stmt->execute([
                "status_order" => $isApproved ? 0 : -2, // 0 = 'APPROVED'  -1 = 'PENDING'  -2="REJECTED"  
                'reason' => $reason,
                "transaction_id" => $transaction_id
            ]);


            return array(
                'message' => $result,
                'status' => 'success',
            );
        } catch (Exception $e) {
            return array(
                'message' => 'Error: ' . $e->getMessage(),
                'status' => 'error',
            );
        }
    }
}
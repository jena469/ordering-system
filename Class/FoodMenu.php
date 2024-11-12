<?php
class FoodMenu extends Db
{

    public function getFoodMenu()
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_menu m LEFT JOIN tbl_category ct ON ct.cat_id=m.cat_id WHERE m.status=:status  ORDER BY m.menu_id DESC");
            $stmt->execute([
                'status' => 'active'
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

    public function getDpCategory()
    {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_category WHERE status=:status ORDER BY cat_id DESC");
            $stmt->execute([
                'status' => 'active'
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

    public function addFoodMenu($data, $files)
    {
        include('Upload.php');
        try {

            if ($img = upload($files['file'])) {
                $stmt = $this->connect()->prepare("INSERT INTO tbl_menu (`cat_id`, `title`, `description`, `price`, `stocks`, `pic`, `status`) VALUES (:cat_id, :title, :description, :price, :stocks, :pic, :status)");

                $status = 'active';

                $stmt->bindParam(':cat_id', $data['cat_id']);
                $stmt->bindParam(':title', $data['title']);
                $stmt->bindParam(':description', $data['desc']);
                $stmt->bindParam(':price', $data['price']);
                $stmt->bindParam(':stocks', $data['stocks']);
                $stmt->bindParam(':pic', $img);
                $stmt->bindParam(':status', $status);

                $result = $stmt->execute([
                    "cat_id" => $data['cat_id'],
                    "title" => $data['title'],
                    "description" => $data['desc'],
                    "price" => $data['price'],
                    "stocks" => $data['stocks'],
                    "pic" => $img,
                    "status" => $status,
                ]);
            }

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
    public function updateProof($data, $files)
    {
        include('Upload.php');
        try {
            $db = $this->connect();
            $stmt = $db->prepare("SELECT reg_id FROM tbl_checkout WHERE checkout_id = :checkout_id");
            $stmt->bindParam(':checkout_id', $data['checkout_id']);
            $stmt->execute();
            $userId = $stmt->fetchColumn();
            // Ensure $checkout_id is defined
            if (isset($data['checkout_id'])) {
                $checkout_id = $data['checkout_id'];
            } else {
                throw new Exception("Checkout ID is missing.");
            }
            // Attempt to upload the file
            if ($img = upload($files['file'])) {
                // Prepare the SQL statement
                $status_order = 3;
                $currentDate = date('Y-m-d H:i:s');
                $active = 2;

                $stmt = $db->prepare("UPDATE tbl_checkout SET 
                        proof_of_delivery = :proof_of_delivery, status_order = :status_order , delivered_date = :delivered_date , active = :active
                        WHERE checkout_id = :checkout_id");

                $stmt->bindParam(':proof_of_delivery', $img);
                $stmt->bindParam(':active', $active);
                $stmt->bindParam(':delivered_date', $currentDate);
                $stmt->bindParam(':status_order', $status_order);
                $stmt->bindParam(':checkout_id', $checkout_id);


                // Execute the statement
                if ($stmt->execute()) {
                    // Check if any rows were affected
                    if ($stmt->rowCount() > 0) {
                        header("Location: viewParcel.php?userId={$userId}&statusVP=3&ckid={$checkout_id}");
                        exit();
                    } else {
                        throw new Exception("No rows were updated. Check if the checkout ID is valid.");
                    }
                } else {
                    throw new Exception("Failed to execute the update statement.");
                }
            } else {
                throw new Exception("File upload failed.");
            }
        } catch (Exception $e) {
            return array(
                'message' => 'Error: ' . $e->getMessage(),
                'status' => 'error',
            );
        }
    }

    public function updateFoodMenu($data, $files)
    {
        include('Upload.php');
        try {
            $db = $this->connect();

            $stmt = $db->prepare("SELECT pic FROM tbl_menu WHERE menu_id = :menu_id");
            $stmt->bindParam(':menu_id', $data['menu_id']);
            $stmt->execute();
            $currentPic = $stmt->fetchColumn();

            if (isset($files['file']) && $files['file']['error'] === UPLOAD_ERR_OK) {
                $img = upload($files['file']);
                if ($img && $currentPic) {
                    @unlink('path/to/uploads/' . $currentPic);
                }
            } else {
                $img = $currentPic;
            }

            $stmt = $db->prepare("UPDATE tbl_menu SET 
                cat_id = :cat_id, 
                title = :title, 
                description = :description, 
                price = :price, 
                stocks = :stocks, 
                pic = :pic, 
                status = :status 
                WHERE menu_id = :menu_id");

            $status = 'active';

            $stmt->bindParam(':cat_id', $data['cat_id']);
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':description', $data['desc']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':stocks', $data['stocks']);
            $stmt->bindParam(':pic', $img);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':menu_id', $data['menu_id']);

            $result = $stmt->execute();

            return array(
                'message' => $result ? 'Update successful' : 'Update failed',
                'status' => $result ? 'success' : 'error',
            );
        } catch (Exception $e) {
            return array(
                'message' => 'Error: ' . $e->getMessage(),
                'status' => 'error',
            );
        }
    }


    public function removeFoodMenu($Id)
    {
        try {
            $status = 'inactive';

            $stmt = $this->connect()->prepare("UPDATE `tbl_menu` SET `status`=:status WHERE `menu_id`=:menu_id");

            $stmt->bindParam(':menu_id', $Id);
            $stmt->bindParam(':status', $status);

            $result = $stmt->execute([
                "status" => $status,
                "menu_id" => $Id
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

    public function getShowMenu($catId)
    {

        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_menu m LEFT JOIN tbl_category ct ON ct.cat_id=m.cat_id WHERE m.status=:status AND concat(
                    m.cat_id
                ) LIKE '%$catId%'");


            $stmt->execute([
                'status' => 'active'
            ]);

            $arr = array();

            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $arr[] = $result;
            }

            return $arr;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getShowAllMenu()
    {

        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_menu m LEFT JOIN tbl_category ct ON ct.cat_id=m.cat_id AND m.status='active'");

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    // count all commnets pre products
    public function totalCommentsPerProducts($menu_id)
    {

        try {
            $stmt = $this->connect()->prepare("SELECT COUNT(message) AS `total` FROM tbl_item_ratings WHERE menu_id=:menu_id");

            $stmt->execute([
                'menu_id' => $menu_id
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    // count all ratings pre products
    public function totalRatingsPerProducts($menu_id)
    {

        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_item_ratings WHERE  menu_id=:menu_id");

            $stmt->execute([
                'menu_id' => $menu_id
            ]);
            $totalQuality = 0;
            $totalService = 0;
            $totalSpeed = 0;
            $a = 0;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $a++;
                $totalQuality += $row['product_quality'];
                $totalService += $row['seller_service'];
                $totalSpeed += $row['delivery_speed'];
            }

            if ($a > 0) {
                $avgQuality = $totalQuality / $a;
                $avgService = $totalService / $a;
                $avgSpeed = $totalSpeed / $a;

                $total = ($avgQuality + $avgService + $avgSpeed) / 3;

                return round($total, 2);
            } else {
                return 0;
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
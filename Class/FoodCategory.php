<?php
    class FoodCategory extends Db {

        public function getFoodCategory() {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_category WHERE status=:status ORDER BY cat_id DESC");
                $stmt->execute([
                    'status' => 'active'
                ]);

                $arr = array();

                while($result = $stmt->fetch(PDO::FETCH_ASSOC)
                ) {
                    $arr[] = $result;
                }

                return $arr;
                
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        
        public function addCategory($data) {
            try {

                $stmt = $this->connect()->prepare("INSERT INTO tbl_category (`cat_title`, `status`) VALUES (:cat_title, :status)");

                $stmt->bindParam(':cat_title', $data['category']);

                $result = $stmt->execute([
                "cat_title"=> $data['category'],
                "status"=> 'active',

                ]);
                
                return array(
                    'message' => $result,
                    'status'  => 'success',
                );
            
            } catch (Exception $e) {
                return array(
                    'message' => 'Error: '.$e->getMessage(),
                    'status'  => 'error',
                );
            }
        }

        public function updateCategory($data) {
            try {
                $stmt = $this->connect()->prepare("
                    UPDATE tbl_category 
                    SET cat_title = :cat_title
                    WHERE cat_id = :cat_id
                ");


                $result = $stmt->execute([
                    ':cat_title' => $data['category'],
                    ':cat_id'    => $data['cat_id']
                ]);

                return [
                    'message' => $result ? 'Update successful' : 'Update failed',
                    'status'  => $result ? 'success' : 'error',
                ];
            } catch (PDOException $e) {
                return [
                    'message' => 'Error: ' . $e->getMessage(),
                    'status'  => 'error',
                ];
            }

        }

        public function removeFoodCategory($Id) {
            try {
                $status = 'inactive';

                $stmt = $this->connect()->prepare("UPDATE `tbl_category` SET    `status`=:status WHERE `cat_id`=:cat_id");

                $stmt->bindParam(':cat_id', $Id); 
                $stmt->bindParam(':status', $status); 
                
                $result = $stmt->execute([
                    "status"  => $status,
                    "cat_id"  => $Id
                ]);

                return array(
                    'message' => $result,
                    'status'  => 'success',
                );
                
            } catch (Exception $e) {
                return array(
                    'message' => 'Error: '.$e->getMessage(),
                    'status'  => 'error',
                );
            }
        }
    }
?>
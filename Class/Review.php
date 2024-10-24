<?php
    class Review extends Db {

        public function getReview() {
            try {
                $stmt = $this->connect()->prepare("SELECT * FROM tbl_item_ratings ratings LEFT JOIN tbl_menu menu ON ratings.menu_id=menu.menu_id LEFT JOIN tbl_registration regs ON ratings.user_id=regs.reg_id LEFT JOIN tbl_category cate ON menu.cat_id=cate.cat_id");
                $stmt->execute();

                return $stmt->fetchAll();
                
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function removeFoodMenu($Id) {
            try {

                $stmt = $this->connect()->prepare("DELETE FROM `tbl_item_ratings` WHERE `rate_id`=:rate_id");
                
                $result = $stmt->execute([
                    "rate_id" => $Id
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

        public function addReviews($data) {
            try {
                $status = 'active';

                $stmt = $this->connect()->prepare("INSERT INTO tbl_review (name, review, comment, status, rates) VALUES (:name, :review, :comment, :status, :rates)");

                $stmt->bindParam(':name', $data['name']); 
                $stmt->bindParam(':review', $data['review']); 
                $stmt->bindParam(':comment', $data['comment']); 
                $stmt->bindParam(':status', $status); 
                $stmt->bindParam(':rates', $data['rates']); 
                
                $result = $stmt->execute([
                    "name"    => $data['name'],
                    "review"  => $data['review'],
                    "comment" => $data['comment'],
                    "status"  => $status,
                    "rates"   => $data['rates']
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
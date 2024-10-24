<?php
    class TilesCounter extends Db {

        public function totalParcel() {
            try {
                $stmt = $this->connect()->prepare("SELECT COUNT(*) AS `count` FROM tbl_checkout");
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function totalMenu() {
            try {
                $stmt = $this->connect()->prepare("SELECT COUNT(*) AS `count` FROM tbl_menu");
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function totalGallery() {
            try {
                $stmt = $this->connect()->prepare("SELECT COUNT(*) AS `count` FROM tbl_gallery");
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function totalReviews() {
            try {
                $stmt = $this->connect()->prepare("SELECT COUNT(*) AS `count` FROM tbl_item_ratings");
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        public function totalCategory() {
            try {
                $stmt = $this->connect()->prepare("SELECT COUNT(*) AS `count` FROM tbl_item_ratings");
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
                
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
    }
?>
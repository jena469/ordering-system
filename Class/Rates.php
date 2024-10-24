<?php
class rates extends Db
{
    public function getReviews($menu_id)
    {

        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_item_ratings ratings LEFT JOIN tbl_registration regs ON ratings.user_id=regs.reg_id WHERE ratings.menu_id=:menu_id");

            $stmt->execute([
                'menu_id' => $menu_id
            ]);

            return $stmt->fetchAll();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function saveRates($data, $user_id)
    {
        try {

            $stmt = $this->connect()->prepare("INSERT INTO tbl_item_ratings (`menu_id`, `user_id`, `product_quality`, `seller_service`, `delivery_speed`, `message`) VALUES (:menu_id, :user_id, :product_quality, :seller_service, :delivery_speed, :message)");

            $result = $stmt->execute([
                "menu_id" => $data['product_id'],
                "user_id" => $user_id,
                "product_quality"   => $data['produc_quality'],
                "seller_service" => $data['seller_service'],
                "delivery_speed" => $data['delivery_speed'],
                "message"        => $data['reviews_msg']
            ]);

            return array(
                'message' => $result,
                'status'  => 'success',
            );
        } catch (Exception $e) {
            return array(
                'message' => 'Error: ' . $e->getMessage(),
                'status'  => 'error',
            );
        }
    }
}

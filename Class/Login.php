<?php

class Login extends Db
{

    public function adminLogin($data)
    {
        $newPass = md5($data['password']);

        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_admin WHERE username=:username AND password=:password LIMIT 01");
            $stmt->execute([
                'username' => $data['username'],
                'password' => $newPass,
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return array(
                    'message' => 'Invalid Uername & Password',
                    'status' => 'warning'
                );
                die();
            }

            return array(
                'message' => $result,
                'status' => 'success'
            );

        } catch (Exception $e) {

            return array(
                'message' => $e->getMessage(),
                'status' => 'error'
            );
        }
    }

    public function customerLogin($data)
    {
        $newPass = md5($data['password']);

        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_registration WHERE userCode=:userCode AND password=:password LIMIT 01");
            $stmt->execute([
                'userCode' => $data['username'],
                'password' => $newPass
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$result) {
                return array(
                    'message' => 'Invalid Uername & Password',
                    'status' => 'warning'
                );
                die();
            }

            return array(
                'message' => $result,
                'status' => 'success'
            );

        } catch (Exception $e) {

            return array(
                'message' => $e->getMessage(),
                'status' => 'error'
            );
        }
    }

    public function getAdminProfile($adminId)
    {

        try {
            $stmt = $this->connect()->prepare("SELECT * FROM tbl_admin WHERE admin_id=:admin_id LIMIT 01");
            $stmt->execute([
                'admin_id' => $adminId,
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return array(
                'message' => $result,
                'status' => 'success'
            );

        } catch (Exception $e) {

            return array(
                'message' => $e->getMessage(),
                'status' => 'error'
            );
        }
    }

    public function updateAccountAdmin($data)
    {
        $id = $_SESSION['admin_id'];
        $newPass = md5($data['password']);

        try {

            $stmt = $this->connect()->prepare("UPDATE tbl_admin SET fname=:fname,lname=:lname, gender=:gender, address=:address,username=:username,password=:password WHERE admin_id=:admin_id");

            $stmt->bindParam(':fname', $data['fname']);
            $stmt->bindParam(':lname', $data['lname']);
            $stmt->bindParam(':gender', $data['sex']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':username', $data['username']);
            $stmt->bindParam(':password', $newPass);
            $stmt->bindParam(':admin_id', $id);

            $result = $stmt->execute([
                "fname" => $data['fname'],
                "lname" => $data['lname'],
                "gender" => $data['sex'],
                "address" => $data['address'],
                "username" => $data['username'],
                "password" => $newPass,
                "admin_id" => $id
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

    public function registerCustomer($data)
    {

        try {
            $newPass = md5($data['password']);

            $stmt = $this->connect()->prepare("INSERT INTO tbl_registration (fname, m_name, lname, userCode, password ) VALUES (:fname,:m_name, :lname, :userCode, :password)");

            $stmt->bindParam(':fname', $data['fname']);
            $stmt->bindParam(':m_name', $data['m_name']);
            $stmt->bindParam(':lname', $data['lname']);
            $stmt->bindParam(':userCode', $data['username']);
            $stmt->bindParam(':password', $newPass);
            // $stmt->bindParam(':email', $data['email']);

            $result = $stmt->execute([
                "fname" => $data['fname'],
                "m_name" => $data['m_name'],
                "lname" => $data['lname'],
                "userCode" => $data['username'],
                "password" => $newPass,
                // "email"     => $data['email']
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

?>
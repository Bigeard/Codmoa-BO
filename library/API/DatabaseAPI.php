<?php 
    require_once 'ConnectionAPI.php';

    class DatabaseAPI extends ConnectionAPI{

        //Usage of PDO
        public function createUser($username, $password, $isAdmin){
            
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);  
                  

            $sql1 = "CREATE USER $username WITH PASSWORD '$password';";
            $stmt1 = $this->connection->prepare($sql1);
            $stmt1->execute();

            if ($isAdmin) {
                $sql2 = "GRANT ALL PRIVILEGES ON DATABASE codmoa to $username;";
                $stmt2 = $this->connection->prepare($sql2);
                $stmt2->execute();
            }

            $this->disconnectDB();
        }

        public function insertBooking($b_bookid, $b_facid, $b_memid, $b_starttime, $b_slots){
            
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);         
            

                // prepare sql and bind parameters
            $stmt = $this->connection->prepare("INSERT INTO exo.bookings (bookid, facid, memid, starttime, slots) 
            VALUES (:b_bookid, :b_facid, :b_memid, :b_starttime, :b_slots)");
            $stmt->bindParam(':b_bookid', $b_bookid);
            $stmt->bindParam(':b_facid', $b_facid);
            $stmt->bindParam(':b_memid', $b_memid);
            $stmt->bindParam(':b_starttime', $b_starttime);
            $stmt->bindParam(':b_slots', $b_slots);

            $b_starttime = date('Y-m-d H:i:s', strtotime($b_starttime));

            $stmt->execute();

            $this->disconnectDB();
        }

        public function selectAllMembers() {
            $this->connectDB('postgres', 'P@ssw0rd');
       
            $sql="SELECT * FROM exo.members";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $tab=[];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $tab[] = $result;
            }         
            $this->disconnectDB();
            
            $tab = count($tab) > 0 ? $tab : null; 
            return $tab;
        }

        public function selectAllFacilities() {
            $this->connectDB('postgres', 'P@ssw0rd');
       
            $sql="SELECT * FROM exo.facilities";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $tab=[];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $tab[] = $result;
            }         
            $this->disconnectDB();
            
            $tab = count($tab) > 0 ? $tab : null; 
            return $tab;
        }

        public function selectAllBookings() {
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);
       
            $sql="SELECT 
                        b.bookid,
                        b.facid,
                        f.name,
                        b.memid,
                        m.surname,
                        m.firstname,
                        b.starttime,
                        b.slots
                    FROM
                        exo.bookings b
                    INNER JOIN exo.facilities f ON (b.facid = f.facid)
                    INNER JOIN exo.members m ON (b.memid = m.memid)
                    ORDER BY b.bookid";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $tab=[];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $tab[] = $result;
            }         
            $this->disconnectDB();
            
            $tab = count($tab) > 0 ? $tab : null; 
            return $tab;
        }

        public function checkRoles($user) {
            $this->connectDB('postgres', 'P@ssw0rd');

            $sql="SELECT DISTINCT
                        privilege_type
                    FROM   
                        information_schema.table_privileges 
                    WHERE  
                        grantee = :user";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':user', $user);
            $stmt->execute();

            $tab=[];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $tab[] = $result;
            }         
            $this->disconnectDB();

            return $tab;
        }

        public function isAdmin($user) {
            $this->connectDB('postgres', 'P@ssw0rd');

            $sql="SELECT DISTINCT
                        privilege_type
                    FROM   
                        information_schema.role_table_grants
                    WHERE  
                        grantee = :user";

            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':user', $user);
            $stmt->execute();

            $tab=[];
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                $tab[] = $result;
            }         
            $this->disconnectDB();

            return $tab;
        }
    }
    
?>
<?php 
    require_once 'ConnectionAPI.php';

    class DatabaseAPI extends ConnectionAPI{

        //Usage of pg_ functions
        public function insertMember($m_id, $m_sname, $m_fname, $m_address, $m_zipcode, $m_phone, $m_recommendedby) {
            
            $username = $_SESSION["username"];
            $password = $_SESSION["password"];
            $host = "localhost";
            $port = 5432;
            $dbname = "cours";
            
            //Initialize connection
            $connect = pg_connect("host=$host port=$port dbname=$dbname user=$username password=$password");        

            // prepare sql and bind parameters
            $stmt = pg_prepare($connect, "query", "INSERT INTO exo.members (memid, surname, firstname, address, zipcode, telephone, recommendedby, joindate) 
            VALUES ($1, $2, $3, $4, $5, $6, $7, $8)");

            //Format date
            $m_joindate = date('Y-m-d H:i:s');

            //Execute sql query
            $stmt = pg_execute($connect, "query", array($m_id, $m_sname, $m_fname, $m_address, $m_zipcode, $m_phone, $m_recommendedby, $m_joindate));

            //Close connection
            pg_close($connect);
        }

        //Usage of PDO
        public function insertFacility($f_facid, $f_name, $f_membercost, $f_guestcost, $f_initialoutlay, $f_monthlymaintenance){
            
            $this->connectDB($_SESSION["username"], $_SESSION["password"]);  
                  

            // prepare sql and bind parameters
            $stmt = $this->connection->prepare("INSERT INTO exo.facilities (facid, name, membercost, guestcost, initialoutlay, monthlymaintenance) 
            VALUES (:f_facid, :f_name, :f_membercost, :f_guestcost, :f_initialoutlay, :f_monthlymaintenance)");
            $stmt->bindParam(':f_facid', $f_facid);
            $stmt->bindParam(':f_name', $f_name);
            $stmt->bindParam(':f_membercost', $f_membercost);
            $stmt->bindParam(':f_guestcost', $f_guestcost);
            $stmt->bindParam(':f_initialoutlay', $f_initialoutlay);
            $stmt->bindParam(':f_monthlymaintenance', $f_monthlymaintenance);

            $stmt->execute();

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

            $tab = count($tab) > 0 ? $tab : null; 
            return $tab;
        }
    }
    
?>
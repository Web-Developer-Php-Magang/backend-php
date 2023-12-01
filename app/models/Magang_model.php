<?php

class Magang_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function requestMagang($id)
    {
        require_once('User_model.php');
        $session = $_SESSION['id'];
        $findUser = new User_model;
        $user = $findUser->findUserID($session);

        if ($user['sptjm'] == '' && $user['rekomendasi'] == '') {
            return 'Mohon lengkapi surat SPTJM dan Rekomendasi';
        } elseif ($user['sptjm'] == '') {
            return 'Mohon lengkapi surat SPTJM';
        } elseif ($user['rekomendasi'] == '') {
            return 'Mohon lengkapi surat Rekomendasi';
        } elseif ($user['status'] == '1') {
            return 'Kamu telah mengambil magang';
        } else {

            $query = "INSERT INTO tb_request_magang (user_id, mitra_id, request_status) VALUES (:session, :id, 'pending')";
            $this->db->query($query);
            $this->db->bind(':session', $session);
            $this->db->bind(':id', $id);
            $this->db->execute();
            return 'Permintaan berhasil dikirim';
        }
    }

    public function getDataWithPagination($user_id, $page, $itemsPerPage)
    {
        $offset = ($page - 1) * $itemsPerPage;

        $query = "SELECT
            m.*,
            COALESCE(rm.request_status, '') AS request_status
        FROM
            tb_mitra m
        LEFT JOIN
            tb_request_magang rm
        ON
            m.id = rm.mitra_id
            AND rm.user_id = :user_id
        WHERE
            rm.mitra_id IS NULL
                OR COALESCE(rm.request_status, '')
        ORDER BY
            m.id ASC
        LIMIT :itemsPerPage OFFSET :offset";

        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':itemsPerPage', $itemsPerPage);
        $this->db->bind(':offset', $offset);

        return $this->db->resultSet();
    }


    public function getTotalMagang($user_id)
    {
        $query = "SELECT COUNT(*) as total
            FROM tb_mitra m
            LEFT JOIN (
                SELECT rm.mitra_id, rm.request_status
                FROM tb_request_magang rm
                WHERE rm.user_id = :user_id
                AND rm.request_status IN ('', 'pending', 'accepted')
            ) rm
            ON m.id = rm.mitra_id
            WHERE rm.mitra_id IS NULL OR m.status = '0'";

        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);

        $row = $this->db->single();
        return $row['total'];
    }

    public function findByUserID($id)
    {
        $query = "SELECT m.*, rm.request_status, u.status AS mahasiswa_status
        FROM tb_mitra m
        LEFT JOIN tb_request_magang rm ON m.id = rm.mitra_id
        LEFT JOIN tb_user u ON u.id = rm.user_id
        WHERE rm.user_id = :user_id
        ORDER BY m.created_at DESC;
        ";

        $this->db->query($query);
        $this->db->bind(":user_id", $id);

        return $this->db->resultSet();
    }

    public function confirmMagang($id)
    {
        $status = false;

        $rowData = function () use ($id) {
            $selectQuery = "SELECT
                                m.status AS mitra_status,
                                m.lecture, m.name,
                                u.status AS user_status
                            FROM
                                tb_request_magang r
                            LEFT JOIN
                                tb_mitra m ON r.mitra_id = m.id
                            LEFT JOIN
                                tb_user u ON r.user_id = u.id
                            WHERE
                                m.id = :id";

            $this->db->query($selectQuery);
            $this->db->bind(":id", $id);
            return $this->db->single();
        };

        $row = $rowData();

        if ($row["lecture"] == 0 || $row['mitra_status'] == 1 || $row['user_status'] == 1) {
            return [$status, 'Permintaan tidak dapat dikirim.'];
        }

        // Insert into tb_magang
        $insertMagangQuery = "INSERT INTO tb_magang(user_id, mitra_id) VALUES (:session, :mitra_id)";
        $this->db->query($insertMagangQuery);
        $this->db->bind(":session", $_SESSION["id"]);
        $this->db->bind(":mitra_id", $id);
        $this->db->execute();


        // Update tb_mitra lecture count
        $updateMitraQuery = "UPDATE tb_mitra SET lecture = lecture - 1 WHERE id = :mitra_id";
        $this->db->query($updateMitraQuery);
        $this->db->bind(":mitra_id", $id);
        $this->db->execute();

        // Check if lecture is 0 and mitra_status is 0, then update mitra_status
        $row = $rowData();
        if ($row["lecture"] == 0 && $row['mitra_status'] == 0) {
            $updateMitraStatusQuery = "UPDATE tb_mitra SET status = '1' WHERE id = :mitra_id";
            $this->db->query($updateMitraStatusQuery);
            $this->db->bind(":mitra_id", $id);
            $this->db->execute();
        }

        // Delete from tb_request_magang
        $deleteRequestQuery = "DELETE FROM tb_request_magang WHERE user_id = :session";
        $this->db->query($deleteRequestQuery);
        $this->db->bind(":session", $_SESSION["id"]);
        $this->db->execute();

        // Update tb_user status
        $updateUserQuery = "UPDATE tb_user SET status = :status WHERE id = :session";
        $this->db->query($updateUserQuery);
        $this->db->bind(":session", $_SESSION["id"]);
        $this->db->bind(":status", '1');
        $this->db->execute();

        $status = true;
        $message = 'Kamu telah mengambil magang di ' . $row['name'];

        return [$status];
    }

    public function getMagangByID()
    {
        $getMagangQuery = "SELECT * FROM tb_magang WHERE user_id = :id";
        $this->db->query($getMagangQuery);
        $this->db->bind(":id", $_SESSION['id']);

        return $this->db->single();
    }
}

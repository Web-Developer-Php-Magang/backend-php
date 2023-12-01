<?php

class Auth_model
{
    private $table = 'tb_user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function registerUser($request)
    {
        $this->db->query('INSERT INTO ' . $this->table . '(username, password, nik, jurusan, gender, telp, email, sptjm, rekomendasi, image) VALUES (:username, :password, :nik, :jurusan, :gender, :telp, :email, :sptjm, :rekomendasi, :image)');

        $encryptedPassword = password_hash($request['password'], PASSWORD_DEFAULT);

        $this->db->bind(':username', $request['username']);
        $this->db->bind(':password', $encryptedPassword);
        $this->db->bind(':nik',      $request['nik']);
        $this->db->bind(':jurusan',  $request['jurusan']);
        $this->db->bind(':gender',   $request['gender']);
        $this->db->bind(':telp',     $request['telp']);
        $this->db->bind(':email',    $request['email']);
        $this->db->bind(':sptjm',          '');
        $this->db->bind(':rekomendasi',    '');
        $this->db->bind(':image',    '');


        $this->db->execute();
        return $this->db->rowCount();
    }

    public function loginUser($request)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $this->db->query($query);
        $this->db->bind(':email', $request['email']);

        $data =  $this->db->single();

        if ($data && password_verify($request['password'], $data['password'])) {
            return $data;
        } else {
            return null;
        }
    }
}

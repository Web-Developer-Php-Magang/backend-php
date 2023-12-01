<?php

class User_model
{
    private $table = 'tb_user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findUserID($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function updateUser($request, $file)
    {
        $user        = $this->findUserID($_SESSION["id"]);
        $rekomendasi = Controller::saveFile('storage/rekomendasi/', $file["rekomendasi"], $user['rekomendasi']);
        $sptjm       = Controller::saveFile('storage/sptjm/', $file["sptjm"], $user['sptjm']);
        $image       = Controller::saveFile('assets/img/profile/', $file["image"], $user['image']);

        // Menggunakan operasi ternary untuk mengganti nilai jika input kosong
        $request['rekomendasi'] = ($file['rekomendasi']['name'] === '') ? $user['rekomendasi'] : $rekomendasi;
        $request['sptjm']       = ($file['sptjm']['name'] === '') ? $user['sptjm'] : $sptjm;
        $request['image']       = ($file['image']['name'] === '') ? $user['image'] : $image;

        // Membandingkan dan menentukan apakah akan menggunakan password lama atau yang baru
        $comparePassword = (password_verify($request['password'], $user['password'])) ? $user['password'] : password_hash($request['password'], PASSWORD_DEFAULT);

        $query = "UPDATE " . $this->table . " SET
                    username = :username,
                    telp = :telp,
                    email = :email,
                    sptjm = :sptjm,
                    rekomendasi = :rekomendasi,
                    image = :image,
                    password = :password
                    WHERE id = :id";

        $this->db->query($query);

        $this->db->bind(':id',          $_SESSION["id"]);
        $this->db->bind(':username',    $request['username']);
        $this->db->bind(':telp',        $request['telp']);
        $this->db->bind(':email',       $request['email']);
        $this->db->bind(':sptjm',       $request['sptjm']);
        $this->db->bind(':rekomendasi', $request['rekomendasi']);
        $this->db->bind(':image',       $request['image']);
        $this->db->bind(':password',    $comparePassword);

        // Mengganti nilai session dengan nilai yang diperbarui
        $_SESSION["password"] = $request['password'];

        // Eksekusi query
        $this->db->execute();
        return $this->db->rowCount();
    }
}

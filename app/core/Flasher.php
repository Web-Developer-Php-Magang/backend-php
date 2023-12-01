<?php

class Flasher
{

    public static function setMessage($pesan, $aksi, $type)
    {

        $_SESSION['msg'] = [
            'pesan' => $pesan,
            'aksi'  => $aksi,
            'type'  => $type
        ];
    }

    public static function Message()
    {
        if (isset($_SESSION['msg'])) {
            echo '<div class="d-flex justify-content-center align-items-center alert alert-' . $_SESSION['msg']['type'] . ' alert-dismissible fade show" role="alert">
                    <strong>' . $_SESSION['msg']['pesan'] . ' </strong> ' . $_SESSION['msg']['aksi'] . '.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';

            unset($_SESSION['msg']);
        }
    }
}

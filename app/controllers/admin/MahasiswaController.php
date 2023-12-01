<?php
class MahasiswaController extends Controller
{
    public function index()
    {
    }

    public function add_mahasiswa()
    {
        $data = [
            'sc' => [
                '<script src="' . BASE_URL . 'assets/plugins/select2/js/select2.min.js"></script>',
                '<script src="' . BASE_URL . 'assets/plugins/moment/moment.min.js"></script>',
                '<script src="' . BASE_URL . 'assets/js/bootstrap-datetimepicker.min.js"></script>',
                '<script src="' . BASE_URL . 'assets/js/add-department.js"></script>'
            ]
        ];

        $this->view('admin/template/header');
        $this->view('admin/add-mahasiswa');
        $this->view('admin/template/footer', $data);
    }

    public function edit_mahasiswa()
    {
        $data = [
            'sc' => [
                '<script src="' . BASE_URL . 'assets/plugins/select2/js/select2.min.js"></script>',
                '<script src="' . BASE_URL . 'assets/plugins/moment/moment.min.js"></script>',
                '<script src="' . BASE_URL . 'assets/js/bootstrap-datetimepicker.min.js"></script>',
                '<script src="' . BASE_URL . 'assets/js/add-department.js"></script>'
            ]
        ];

        $this->view('admin/template/header');
        $this->view('admin/edit-mahasiswa');
        $this->view('admin/template/footer', $data);
    }

    public function store_mahasiswa()
    {
    }

    public function show_mahasiswa()
    {
    }

    public function destroy_mahasiswa()
    {
    }
}

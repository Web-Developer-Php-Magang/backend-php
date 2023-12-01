<?php
class DepartmentController extends Controller
{
    public function index()
    {
    }

    public function add_department()
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
        $this->view('admin/add-department');
        $this->view('admin/template/footer', $data);
    }

    public function edit_department()
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
        $this->view('admin/edit-department');
        $this->view('admin/template/footer', $data);
    }

    public function store_department()
    {
    }

    public function show_department()
    {
    }

    public function destroy_department()
    {
    }
}

<?php

class DashboardController extends Controller
{

    public function index()
    {
        $data = [
            'sc' => [
                '<script src="' . BASE_URL . 'assets/plugins/apexchart/apexcharts.min.js"></script>',
                '<script src="' . BASE_URL . 'assets/plugins/apexchart/chart-data.js"></script>'
            ],
        ];

        $this->view('admin/template/header');
        $this->view('admin/dashboard');
        $this->view('admin/template/footer', $data);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use App\Models\DatetoSkipModel;
use App\Models\NotifModel;
use \Hermawan\DataTables\DataTable;

class DatetoSkipController extends BaseController
{
    protected $akses;
    public function __construct()
    {
        $this->akses = session('akses');
    }

    public function index()
    {
        $data = array(
            'judul' => 'Hari Libur',
            'sub_judul' => 'Kelola Hari Libur',
        );
        return view('admin/date_to_skip', $data);
    }

    public function json_date_to_skip()
    {
        $db = db_connect();
        $builder = $db->table('date_to_skip')->select('date_to_skip.id, 
        date_to_skip.date_to_skip, 
        date_to_skip.ket')


            ->orderBy('date_to_skip', 'desc');

        return DataTable::of($builder)->toJson();
    }

    public function add_date_to_skip()
    {
        $model = new DatetoSkipModel();
        if (!$this->validate([
            'date_to_skip'     => ['label' => 'Tanggal', 'rules' => 'required'],
            'ket_date_to_skip'     => ['label' => 'Keterangan', 'rules' => 'required'],

        ])) {

            $respond = [
                'success' => false,
                'date_to_skip_error' => \Config\Services::validation()->getError('date_to_skip'),
                'ket_date_to_skip_error' => \Config\Services::validation()->getError('ket_date_to_skip'),
            ];

            return json_encode($respond);
        }

        $date_to_skip = $this->request->getVar('date_to_skip');
        $ket = $this->request->getVar('ket_date_to_skip');



        $data = [
            'date_to_skip'           => $date_to_skip,
            'ket'           => $ket,

        ];

        $result = $model->insert($data);


        if ($result) {
            $respond = [
                'success' => true,
            ];
            return json_encode($respond);
        } else {
            $respond = [
                'success' => false,
            ];
            return json_encode($respond);
        }
    }

    public function update_notif()
    {
        $model = new NotifModel();
        if (!$this->validate([
            'notif_title_edit'     => ['label' => 'Judul', 'rules' => 'required'],
            'notif_konten_edit'     => ['label' => 'Konten', 'rules' => 'required'],
            'notif_tag_edit'     => ['label' => 'Tag', 'rules' => 'required'],

        ])) {

            $respond = [
                'success' => false,
                'notif_title_edit_error' => \Config\Services::validation()->getError('notif_title_edit'),
                'notif_konten_edit_error' => \Config\Services::validation()->getError('notif_konten_edit'),
                'notif_tag_edit_error' => \Config\Services::validation()->getError('notif_tag_edit'),

            ];

            return json_encode($respond);
        }

        $id = $this->request->getVar('id_notif');
        $notif_title = $this->request->getVar('notif_title_edit');
        $notif_konten = $this->request->getVar('notif_konten_edit');
        $notif_tag = $this->request->getVar('notif_tag_edit');


        $data = [
            'title'           => $notif_title,
            'informasi'           => $notif_konten,
            'tag'           => $notif_tag,

        ];

        $result = $model->update($id, $data);
        if ($result) {
            $respond = [
                'success' => true,
            ];
            return json_encode($respond);
        } else {
            $respond = [
                'success' => false,
            ];
            return json_encode($respond);
        }
    }

    public function del_notif($id)
    {
        $model = new NotifModel();
        $data = $model->where('id', $id)->delete();
        die;
        return json_encode($data);
    }

    public function get_notif($id)
    {
        $model = new NotifModel();

        $data = $model->where('id', $id)->first();
        return json_encode($data);
    }
}

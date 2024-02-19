<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use App\Models\NotifModel;
use \Hermawan\DataTables\DataTable;

class NotifController extends BaseController
{
    protected $akses;
    public function __construct()
    {
        $this->akses = session('akses');
    }

    public function index()
    {
        $data = array(
            'judul' => 'Pemberitahuan',
            'sub_judul' => 'Kelola Pemberitahuan pada Aplikasi ATEI Bartim',
            'judul' => 'Kelola Pemberitahuan',
        );
        return view('admin/notif', $data);
    }

    public function json_notif()
    {

        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $db = db_connect();
            $builder = $db->table('tbl_info')->select('tbl_info.id, 
            tbl_info.title, 
            tbl_info.informasi, 
            tbl_info.created_at, 
            tbl_info.updated_at, 
            tbl_info.tag')


                ->orderBy('created_at', 'desc');

            return DataTable::of($builder)->toJson();
        }
    }

    public function add_notif()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {

            $model = new NotifModel();
            if (!$this->validate([
                'notif_title'     => ['label' => 'Judul', 'rules' => 'required'],
                'notif_konten'     => ['label' => 'Konten', 'rules' => 'required'],
                'notif_tag'     => ['label' => 'Tag', 'rules' => 'required'],

            ])) {

                $respond = [
                    'success' => false,
                    'notif_title_error' => \Config\Services::validation()->getError('notif_title'),
                    'notif_konten_error' => \Config\Services::validation()->getError('notif_konten'),
                    'notif_tag_error' => \Config\Services::validation()->getError('notif_tag'),

                ];

                return json_encode($respond);
            }

            $notif_title = $this->request->getVar('notif_title');
            $notif_konten = $this->request->getVar('notif_konten');
            $notif_tag = $this->request->getVar('notif_tag');


            $data = [
                'title'           => $notif_title,
                'informasi'           => $notif_konten,
                'tag'           => $notif_tag,

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
    }

    public function update_notif()
    {
        if (($this->akses != '1')) {
            return redirect('login');
        } else {

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

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use \Hermawan\DataTables\DataTable;

class Banner extends BaseController
{
    protected $akses;
    public function __construct()
    {
        $this->akses = session('akses');
    }

    public function index()
    {
        $data = array(
            'judul' => 'Banner',
            'sub_judul' => 'Kelola Banner pada Aplikasi ATEI Bartim',
            'judul' => 'Kelola Banner',
        );
        return view('admin/banner', $data);
    }

    public function json_banner()
    {

        if (($this->akses != '1')) {
            return redirect('login');
        } else {
            $db = db_connect();
            $builder = $db->table('tbl_banner')->select('tbl_banner.id, 
            tbl_banner.title, 
            tbl_banner.img_path, 
            tbl_banner.created_at, 
            tbl_banner.updated_at')


                ->orderBy('created_at', 'desc');

            return DataTable::of($builder)->toJson();
        }
    }

    public function add_banner()
    {

        helper(['form', 'url']);
        $db = db_connect();

        $model = new BannerModel();
        $validateImage = $this->validate([
            'banner' => [
                'uploaded[banner]',
                'mime_in[banner, image/png, image/jpg,image/jpeg, image/gif]',
                'max_size[banner, 2048]',
            ],
        ]);

        if ($validateImage) {
            if (!$this->validate([
                'banner_title'     => ['label' => 'Judul', 'rules' => 'required'],

            ])) {

                $respond = [
                    'success' => false,
                    'status' => 0,
                    'banner_title_error' => \Config\Services::validation()->getError('banner_title'),

                ];

                return json_encode($respond);
            }
            $title = $this->request->getVar('banner_title');
            $title_with_underscore = str_replace(' ', '_', $title);
            $imageFile = $this->request->getFile('banner');

            $dname = explode(".", $imageFile->getClientName());
            $ext = end($dname);
            $imageFile->move(ROOTPATH . 'public/banner/', $title_with_underscore . '.' . $ext);

            // $imageFile = base_url().'/uploads/'.$judul;



            $builder = $db->table('tbl_banner')->select('title')->where('title', $title_with_underscore)->countAllResults();
            if ($builder) {
                $respond = [
                    'success' => false,
                    'status' => 1,
                ];
                return json_encode($respond);
            } else {
                $data = [

                    'title'           => $title,
                    'img_path' => base_url() . '/public/banner/' . $title_with_underscore . '.' . $ext,
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
                        'status' => 3,
                    ];
                    return json_encode($respond);
                }
            }
        } else {
            //image error
            $respond = [
                'success' => false,
                'status' => 3,
            ];
            return json_encode($respond);
        }
    }

    public function del_banner($id)
    {
        $model = new BannerModel();
        $img = $model->where('id', $id)->first();

        $imgExt = $img['img_path'];
        $file = basename($imgExt);

        unlink(FCPATH . 'public/banner/' . $file);
        $data = $model->where('id', $id)->delete();
        die;
        return json_encode($data);
    }
}

<?php

namespace App\Controllers;

require_once(APPPATH . "ThirdParty/gridphp/lib/inc/jqgrid_dist.php");

use App\Models\HomeModel;
use Jqgrid;
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Home extends BaseController
{
    protected $_data = array();
    protected $uri;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->security = \Config\Services::security();
        $this->session = \Config\Services::session();
        $this->validation =  \Config\Services::validation();
        $this->encrypter = \Config\Services::encrypter();
        $this->request = \Config\Services::request();
        $this->uri = new \CodeIgniter\HTTP\URI();
        $this->router = service('router');
        $this->_data['session'] = $this->session;
        $this->_data['security'] = $this->security;
        $this->home_model = new HomeModel();
        $this->_data['project_title'] = 'Rent My Room';
        $this->_data['required_span'] = '<span style="color: red">*</span>';
        $this->_data['page_title'] = '';
        $this->_data['all_ad_categories'] = $this->home_model->get_categories('1');
        $this->_data['all_ads'] = $this->home_model->get_user_ads();
        if ($this->session->has('seller_id')) {
            $this->_data['seller_id'] = $this->session->get('seller_id');
            $this->profile_id = $this->session->get('seller_id');
            $this->seller_id = $this->session->get('seller_id');
        }
    }

    private function check_login()
    {
        if ($this->session->has('seller_id')) {
        } else {
            return redirect()->to(base_url());
        }
    }

    public function index()
    {
        $this->_data['page_title'] = '';
        if ($this->request->getGet('flt_category_id')) {
            $where = " where 1=1 ";
            if ($this->request->getGet('flt_category_id') != "All") {
                $where = " AND a.cat_id = '" . $this->request->getGet('flt_category_id') . "' ";
                $this->_data['flt_category_id'] = $this->request->getGet('flt_category_id');
            }
            if ($this->request->getGet('flt_keywords') != "") {
                $where = " AND (cat_title like '%" . $this->request->getGet('flt_keywords') . "%' OR acc_name like '%" . $this->request->getGet('flt_keywords') . "%' ) ";
                $this->_data['flt_category_id'] = $this->request->getGet('flt_keywords');
            }

            $this->_data['all_ads'] = $this->home_model->get_ads_by_filters($where);
        }

        echo view('frontend/header', $this->_data);
        echo view('frontend/index');
        echo view('frontend/footer');
    }

    public function login_valid()
    {
        if ($this->request->getMethod() == 'post') {
            $response = [];
            $token = csrf_hash();
            $rules = [
                'seller_email' => [
                    'label'  => 'Email',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your email',
                    ],
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your password',
                    ],
                ]
            ];
            if (!$this->validate($rules)) {
                $response = json_encode(['success' => false, 'msg' => 'Enter Email and Password', 'token' => $token]);
            } else {
                $redirect_url = ($this->request->getPost('login_redirect_url')) ? $this->request->getPost('login_redirect_url') : base_url() . 'home/my_account';
                $post     = $this->request->getPost();
                $email    = $post['seller_email'];
                $password = md5($post['password']);
                $login_valid = $this->home_model->login_valid($email, $password);

                if ($login_valid['success']) {
                    $profile = $login_valid['data'];
                    $this->session->set('seller_id', $profile['id']);
                    $this->session->set('full_name_home', $profile['seller_first_name']);
                    $msg = '';
                    $success = true;
                } else {
                    $success = false;
                    $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              Incorrect email or password.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>';
                }
                $response['redirect_url'] = $redirect_url;
                $response['success'] = $success;
                $response['msg']     = $msg;
                $response['token']   = $token;
            }
            echo json_encode($response);
        }
    }

    public function signup($id = "")
    {
        $this->_data['page_title'] = 'Create an account';
        echo view('frontend/header', $this->_data);
        echo view('frontend/signup');
        echo view('frontend/footer');
    }

    public function save_account()
    {
        if ($this->request->getMethod() == 'post') {
            $response = [];
            $token = csrf_hash();
            $rules = [
                'seller_email' => [
                    'label'  => 'Email',
                    'rules'  => 'trim|required|valid_email|is_unique[seller_profiles.seller_email]',
                    'errors' => [
                        'required' => 'Enter your email',
                        'valid_email' => 'Enter your valid email',
                        'is_unique' => 'Email already exists. Enter any other email address.',
                    ],
                ],
                'seller_first_name' => [
                    'label'  => 'seller_first_name',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your First Name',
                    ],
                ],
                'seller_last_name' => [
                    'label'  => 'seller_last_name',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your Last Name',
                    ],
                ],
                'seller_phone' => [
                    'label'  => 'seller_phone',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your Phone Number',
                    ],
                ],
                'about_seller' => [
                    'label'  => 'seller_phone',
                    'rules'  => 'trim'
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your password',
                    ],
                ]
            ];
            if (!$this->validate($rules)) {
                $response = ['success' => false, 'msg' => \Config\Services::validation()->listErrors('my_list'), 'token' => $token];
            } else {
                $post              = $this->request->getPost();
                $seller_first_name = $post['seller_first_name'];
                $seller_last_name  = $post['seller_last_name'];
                $email             = $post['seller_email'];
                $about_seller      = $post['about_seller'];
                $password          = md5($post['password']);

                $ins_data['seller_first_name'] = $seller_first_name;
                $ins_data['seller_last_name'] = $seller_last_name;
                $ins_data['seller_email'] = $email;
                $ins_data['secret_word'] = $password;
                $ins_data['about_seller'] = $about_seller;
                $ins_data['seller_phone'] = $seller_phone;
                $ins_data['email_verified'] = 1;
                $ins_data['account_status'] = 1;
                $ins_data['add_date'] = date('Y-m-d H:i:s');
                $ins_data['add_ip'] = $_SERVER['REMOTE_ADDR'];

                $ins               = $this->home_model->_insert('seller_profiles', $ins_data);
                if ($ins) {
                    $msg = 'Your account has been created successfully. Now you can login with your email and password.';
                    $this->session->setFlashdata('success_response_for_sweet_alert', $msg);
                    $success = true;
                } else {
                    $success = false;
                    $msg = 'Error occured. Data not saved.';
                }
                $response['success'] = $success;
                $response['msg']     = $msg;
                $response['token']   = $token;
            }
            echo json_encode($response);
        }
    }

    public function post_ad($ad_id = "")
    {
        if (!$this->session->has('seller_id')) return redirect()->to('/');
        $this->_data['ad_id'] = $ad_id;
        $this->_data['page_title'] = 'PostAnAd';
        $ad_detail = false;
        $ad_services_offered = [];
        $ad_dates = '';
        if ($ad_id != "") {

            $ad_detail = $this->home_model->get_ads_by_filters(" where a.id = '" . $ad_id . "' ");
            if (!$ad_detail) return redirect()->to('/');
            $ad_detail = $ad_detail[0];
            if ($ad_detail['seller_id'] != $this->seller_id)  return redirect()->to('/');
            $this->_data['ad_dates'] = $this->home_model->get_single_row("ad_dates", " where ad_id = '" . $ad_id . "' ", "MIN(ad_date) AS min_date, MAX(ad_date) AS max_date");
            $services = $this->home_model->get_all_rows("ad_services_offered", "service_id", " where ad_id = '" . $ad_id . "' ");
            if ($services) {
                foreach ($services as $key => $value) {
                    $ad_services_offered[] = $value->service_id;
                }
            }
        }
        $this->_data['ad_services_offered'] = $ad_services_offered;
        $this->_data['ad_detail'] = $ad_detail;
        $this->_data['countries'] = $this->home_model->get_countries();
        $this->_data['services_list'] = $this->home_model->get_all_rows("services_list", "id,service_desc", " where enabled = 1 ");
        echo view('frontend/header', $this->_data);
        echo view('frontend/post_ad');
        echo view('frontend/footer');
    }

    public function category($category_id = "")
    {
        if ($category_id == "") return redirect()->to('/');
        $this->_data['page_title'] = 'PostAnAd';
        $this->_data['all_ads'] = $this->home_model->get_ad_by_category($category_id);
        echo view('frontend/header', $this->_data);
        echo view('frontend/category');
        echo view('frontend/footer');
    }

    public function about()
    {
        echo view('frontend/header', $this->_data);
        echo view('frontend/about');
        echo view('frontend/footer');
    }

    public function contact()
    {
        echo view('frontend/header', $this->_data);
        echo view('frontend/contact');
        echo view('frontend/footer');
    }

    public function save_ajax_data()
    {
        if ($this->request->getMethod() == 'post') {
            $post = $this->request->getPost();
            $form_name = $post['form_name'];
            $token = csrf_hash();
            switch ($form_name) {
                case 'save_ad':
                    $rules = [
                        'cat_id' => [
                            'label'  => 'acc',
                            'rules'  => 'trim|required',
                            'errors' => [
                                'required' => 'Select Type of accommodation',
                            ],
                        ],
                        'acc_name' => [
                            'label'  => 'acc',
                            'rules'  => 'trim|required',
                            'errors' => [
                                'required' => 'Enter accommodation name',
                            ],
                        ],
                        'country' => [
                            'label'  => 'acc',
                            'rules'  => 'trim|required',
                            'errors' => [
                                'required' => 'Select country',
                            ],
                        ],
                        'city' => [
                            'label'  => 'acc',
                            'rules'  => 'trim|required',
                            'errors' => [
                                'required' => 'Enter city name',
                            ],
                        ],
                        'address' => [
                            'label'  => 'acc',
                            'rules'  => 'trim|required',
                            'errors' => [
                                'required' => 'Enter address',
                            ],
                        ],
                        'postal_code' => [
                            'label'  => 'acc',
                            'rules'  => 'trim|required',
                            'errors' => [
                                'required' => 'Enter Postal code',
                            ],
                        ],
                        'ad_price' => [
                            'label'  => 'acc',
                            'rules'  => 'trim|required',
                            'errors' => [
                                'required' => 'Enter price per hour',
                            ],
                        ],
                        'dates' => [
                            'label'  => 'acc',
                            'rules'  => 'trim|required',
                            'errors' => [
                                'required' => 'Select dates',
                            ],
                        ]
                    ];
                    if (!empty($_FILES['ad_picture_1']['name'])) {
                        $rules = [
                            'ad_picture_1' => [
                                'label' => 'ad_picture_1',
                                'rules' => 'uploaded[ad_picture_1]'
                                    . '|mime_in[ad_picture_1,image/jpg,image/jpeg,image/png]'
                                    . '|max_size[ad_picture_1,5120]',
                                'errors' => [
                                    'max_size' => 'Feature Picture not uploaded. Upload the image file only upto 2 mb file size.',
                                    'mime_in' => 'Feature Picture not uploaded. Upload the image file only upto 2 mb file size.',
                                ]
                            ],
                        ];
                    }
                    if (!empty($_FILES['ad_picture_2']['name'])) {
                        $rules = [
                            'ad_picture_2' => [
                                'label' => 'ad_picture_2',
                                'rules' => 'uploaded[ad_picture_2]'
                                    . '|mime_in[ad_picture_2,image/jpg,image/jpeg,image/png]'
                                    . '|max_size[ad_picture_2,5120]',
                                'errors' => [
                                    'max_size' => 'Picture 2 not uploaded. Upload the image file only upto 2 mb file size.',
                                    'mime_in' => 'Picture 2 not uploaded. Upload the image file only upto 2 mb file size.',
                                ]
                            ],
                        ];
                    }
                    if (!empty($_FILES['ad_picture_3']['name'])) {
                        $rules = [
                            'ad_picture_3' => [
                                'label' => 'ad_picture_3',
                                'rules' => 'uploaded[ad_picture_3]'
                                    . '|mime_in[ad_picture_3,image/jpg,image/jpeg,image/png]'
                                    . '|max_size[ad_picture_3,5120]',
                                'errors' => [
                                    'max_size' => 'Picture 3 not uploaded. Upload the image file only upto 2 mb file size.',
                                    'mime_in' => 'Picture 3 not uploaded. Upload the image file only upto 2 mb file size.',
                                ]
                            ],
                        ];
                    }
                    if (!$this->validate($rules)) {
                        echo json_encode(array('success' => false, 'message' => \Config\Services::validation()->listErrors(), 'token' => $token));
                    } else {

                        $ins_data['seller_id'] = $this->_data['seller_id'];
                        $ins_data['cat_id'] = $post['cat_id'];
                        $ins_data['acc_name'] = $post['acc_name'];
                        $ins_data['ad_desc'] = $post['ad_desc'];
                        $ins_data['country'] = $post['country'];
                        $ins_data['address'] = $post['address'];
                        $ins_data['city'] = $post['city'];
                        $ins_data['postal_code'] = $post['postal_code'];
                        $ins_data['ad_price'] = $post['ad_price'];

                        $ad_id = $post['ad_id'];

                        if ($ad_id == "") {
                            $ins_data['add_date'] = date('Y-m-d H:i:s');
                            $ins_data['add_ip'] = $_SERVER['REMOTE_ADDR'];
                            $add = $this->home_model->_insert('ad_collections', $ins_data);
                            if ($add) {

                                //// date
                                $dates    = json_decode($post['dates']);
                                $start_dt = $dates->start;
                                $end_dt   = $dates->end;
                                while (strtotime($start_dt) <= strtotime($end_dt)) {

                                    $arr = [];

                                    $arr['ad_id'] = $add;
                                    $arr['ad_date'] = date('Y-m-d', strtotime($start_dt));
                                    $this->home_model->_insert('ad_dates', $arr);

                                    $start_dt = date("Y-m-d", strtotime("+1 days", strtotime($start_dt)));
                                }

                                if ($this->request->getPost('services_offered')) {
                                    $services_offered = $this->request->getPost('services_offered');
                                    foreach ($services_offered as $key => $value) {
                                        $val = explode(' --- ', $value);
                                        $service_id = $val[0];
                                        $service_desc = $val[1];
                                        $arr = [];

                                        $arr['ad_id'] = $add;
                                        $arr['service_id'] = $service_id;
                                        $arr['service_desc'] = $service_desc;
                                        $this->home_model->_insert('ad_services_offered', $arr);
                                    }
                                }

                                $file_1 = $this->request->getFile('ad_picture_1');
                                if ($file_1->isValid()) {
                                    $filename = rand(11111, 99999) . time();
                                    $original_file_name = $file_1->getName();
                                    $ext      = strtolower($file_1->guessExtension());
                                    $filepath = ROOTPATH . '/public/my_images/';
                                    $newName  = $filename . "." . $ext;
                                    $image = \Config\Services::image()
                                        ->withFile($file_1)
                                        ->resize(50, 50, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/thumbnail/' . $newName);
                                    $image2 = \Config\Services::image()
                                        ->withFile($file_1)
                                        ->resize(815, 459, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/' . $newName);
                                    if ($file_1->move(WRITEPATH . 'uploads')) {
                                        unlink(WRITEPATH . 'uploads/' . $original_file_name);
                                        $update_data['ad_picture_1'] = $newName;
                                        $this->home_model->_update('ad_collections', $update_data, " id = '" . $add . "' ");
                                    } else {
                                        $errors++;
                                    }
                                }

                                $file_2 = $this->request->getFile('ad_picture_2');
                                if ($file_2->isValid()) {
                                    $filename = rand(11111, 99999) . time();
                                    $original_file_name = $file_2->getName();
                                    $ext      = strtolower($file_2->guessExtension());
                                    $filepath = ROOTPATH . '/public/my_images/';
                                    $newName  = $filename . "." . $ext;
                                    $image = \Config\Services::image()
                                        ->withFile($file_2)
                                        ->resize(50, 50, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/thumbnail/' . $newName);
                                    $image2 = \Config\Services::image()
                                        ->withFile($file_2)
                                        ->resize(815, 459, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/' . $newName);
                                    if ($file_2->move(WRITEPATH . 'uploads')) {
                                        unlink(WRITEPATH . 'uploads/' . $original_file_name);
                                        $update_data['ad_picture_2'] = $newName;
                                        $this->home_model->_update('ad_collections', $update_data, " id = '" . $add . "' ");
                                    } else {
                                        $errors++;
                                    }
                                }

                                $file_3 = $this->request->getFile('ad_picture_3');
                                if ($file_3->isValid()) {
                                    $filename = rand(11111, 99999) . time();
                                    $original_file_name = $file_3->getName();
                                    $ext      = strtolower($file_3->guessExtension());
                                    $filepath = ROOTPATH . '/public/my_images/';
                                    $newName  = $filename . "." . $ext;
                                    $image = \Config\Services::image()
                                        ->withFile($file_3)
                                        ->resize(50, 50, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/thumbnail/' . $newName);
                                    $image2 = \Config\Services::image()
                                        ->withFile($file_3)
                                        ->resize(815, 459, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/' . $newName);
                                    if ($file_3->move(WRITEPATH . 'uploads')) {
                                        unlink(WRITEPATH . 'uploads/' . $original_file_name);
                                        $update_data['ad_picture_3'] = $newName;
                                        $this->home_model->_update('ad_collections', $update_data, " id = '" . $add . "' ");
                                    } else {
                                        $errors++;
                                    }
                                }

                                $success     = true;
                                $message     = 'Your ad has been posted successfully.';
                                $this->session->setFlashdata('success_response_for_sweet_alert', $message);
                            } else {
                                $success = false;
                                $message = 'Error occured.';
                            }
                            echo json_encode(array('success' => $success, 'message' => $message, 'token' => $token));
                        } /// if aad_id == ""
                        else if ($ad_id != "") {
                            $ins_data['update_date'] = date('Y-m-d H:i:s');
                            $ins_data['update_ip'] = $_SERVER['REMOTE_ADDR'];
                            $ins_data['update_by'] = $this->seller_id;
                            $add = $this->home_model->_update('ad_collections', $ins_data, " id = '" . $ad_id . "' ");
                            if ($add) {
                                $this->home_model->_delete('ad_dates', " ad_id = '" . $ad_id . "' ");
                                //// date
                                $dates    = json_decode($post['dates']);
                                $start_dt = $dates->start;
                                $end_dt   = $dates->end;
                                while (strtotime($start_dt) <= strtotime($end_dt)) {

                                    $arr = [];

                                    $arr['ad_id'] = $ad_id;
                                    $arr['ad_date'] = date('Y-m-d', strtotime($start_dt));
                                    $this->home_model->_insert('ad_dates', $arr);

                                    $start_dt = date("Y-m-d", strtotime("+1 days", strtotime($start_dt)));
                                }
                                $this->home_model->_delete('ad_services_offered', " ad_id = '" . $ad_id . "' ");
                                if ($this->request->getPost('services_offered')) {
                                    $services_offered = $this->request->getPost('services_offered');
                                    foreach ($services_offered as $key => $value) {
                                        $val = explode(' --- ', $value);
                                        $service_id = $val[0];
                                        $service_desc = $val[1];
                                        $arr = [];

                                        $arr['ad_id'] = $ad_id;
                                        $arr['service_id'] = $service_id;
                                        $arr['service_desc'] = $service_desc;
                                        $this->home_model->_insert('ad_services_offered', $arr);
                                    }
                                }

                                $file_1 = $this->request->getFile('ad_picture_1');
                                if ($file_1->isValid()) {
                                    $filename = rand(11111, 99999) . time();
                                    $original_file_name = $file_1->getName();
                                    $ext      = strtolower($file_1->guessExtension());
                                    $filepath = ROOTPATH . '/public/my_images/';
                                    $newName  = $filename . "." . $ext;
                                    $image = \Config\Services::image()
                                        ->withFile($file_1)
                                        ->resize(50, 50, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/thumbnail/' . $newName);
                                    $image2 = \Config\Services::image()
                                        ->withFile($file_1)
                                        ->resize(815, 459, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/' . $newName);
                                    if ($file_1->move(WRITEPATH . 'uploads')) {
                                        unlink(WRITEPATH . 'uploads/' . $original_file_name);
                                        $update_data['ad_picture_1'] = $newName;
                                        $this->home_model->_update('ad_collections', $update_data, " id = '" . $ad_id . "' ");
                                    } else {
                                        $errors++;
                                    }
                                }

                                $file_2 = $this->request->getFile('ad_picture_2');
                                if ($file_2->isValid()) {
                                    $filename = rand(11111, 99999) . time();
                                    $original_file_name = $file_2->getName();
                                    $ext      = strtolower($file_2->guessExtension());
                                    $filepath = ROOTPATH . '/public/my_images/';
                                    $newName  = $filename . "." . $ext;
                                    $image = \Config\Services::image()
                                        ->withFile($file_2)
                                        ->resize(50, 50, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/thumbnail/' . $newName);
                                    $image2 = \Config\Services::image()
                                        ->withFile($file_2)
                                        ->resize(815, 459, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/' . $newName);
                                    if ($file_2->move(WRITEPATH . 'uploads')) {
                                        unlink(WRITEPATH . 'uploads/' . $original_file_name);
                                        $update_data['ad_picture_2'] = $newName;
                                        $this->home_model->_update('ad_collections', $update_data, " id = '" . $ad_id . "' ");
                                    } else {
                                        $errors++;
                                    }
                                }

                                $file_3 = $this->request->getFile('ad_picture_3');
                                if ($file_3->isValid()) {
                                    $filename = rand(11111, 99999) . time();
                                    $original_file_name = $file_3->getName();
                                    $ext      = strtolower($file_3->guessExtension());
                                    $filepath = ROOTPATH . '/public/my_images/';
                                    $newName  = $filename . "." . $ext;
                                    $image = \Config\Services::image()
                                        ->withFile($file_3)
                                        ->resize(50, 50, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/thumbnail/' . $newName);
                                    $image2 = \Config\Services::image()
                                        ->withFile($file_3)
                                        ->resize(815, 459, false, 'height')
                                        ->save(ROOTPATH . '/public/my_images/' . $newName);
                                    if ($file_3->move(WRITEPATH . 'uploads')) {
                                        unlink(WRITEPATH . 'uploads/' . $original_file_name);
                                        $update_data['ad_picture_3'] = $newName;
                                        $this->home_model->_update('ad_collections', $update_data, " id = '" . $ad_id . "' ");
                                    } else {
                                        $errors++;
                                    }
                                }

                                $success     = true;
                                $message     = 'Your ad has been posted successfully.';
                                $this->session->setFlashdata('success_response_for_sweet_alert', $message);
                            } else {
                                $success = false;
                                $message = 'Error occured.';
                            }
                            echo json_encode(array('success' => $success, 'message' => $message, 'token' => $token));
                        }
                    }
                    break;
                    //// Guardado de datos de fecha del usuario
                case 'book_ad':
                    $rules = [
                        'choose_dates' => [
                            'label'  => 'acc',
                            'rules'  => 'required',
                            'errors' => [
                                'required' => 'Choose at least one date',
                            ],
                        ]
                    ];
                    if (!$this->validate($rules)) {
                        echo json_encode(array('success' => false, 'message' => \Config\Services::validation()->listErrors(), 'token' => $token));
                    } else {
                        $errors = 0;
                        $ad_id = $post['ad_id'];
                        $ad_detail = $this->home_model->get_user_ads('', $ad_id);
                        //// Verifica si ad data no existe en la base de datos
                        if (!$ad_detail) {
                            echo json_encode(array('success' => false, 'message' => 'Ad not found', 'token' => $token));
                            die;
                        }
                        $seller_email = $ad_detail['seller_email'];
                        //// El usuario ha seleccionado las fechas
                        $choose_dates = json_decode($post['choose_dates']);
                        $start_dt = $choose_dates->start;
                        $end_dt   = $choose_dates->end;
                        while (strtotime($start_dt) <= strtotime($end_dt)) {
                            $dd = [];
                            $dd['is_booked'] = 1;
                            $dd['booked_by'] = $this->seller_id;
                            $dd['booked_on'] = date('Y-m-d H:i:s');
                            $dd['booked_on_ip'] = $_SERVER['REMOTE_ADDR'];
                            $update = $this->home_model->_update('ad_dates', $dd, " ad_date = '" . $start_dt . "' AND ad_id = '" . $ad_id . "' ");
                            if ($update) {
                            } else {
                                $errors++;
                            }
                            $start_dt = date("Y-m-d", strtotime("+1 days", strtotime($start_dt)));
                        }

                        if ($errors == 0) {
                            $success     = true;
                            $message     = 'Your booking date(s) have been submitted successfully.';
                            $this->session->setFlashdata('success_response_for_sweet_alert', $message);
                        } else {
                            $success = false;
                            $message = 'Error occured.';
                        }
                        echo json_encode(array('success' => $success, 'message' => $message, 'token' => $token));
                    }
                    break;

                case 'cancelReservation':
                    $record_id = $post['record_id'];
                    $update_data['is_booked'] = 0;
                    $update_data['booked_by'] = NULL;
                    $update_data['booked_on'] = NULL;
                    $update_data['booked_on_ip'] = NULL;

                    $update = $this->home_model->_update('ad_dates', $update_data, " id = '" . $record_id . "' ");
                    if ($update) {
                        $success     = true;
                        $message     = 'Your booking has been cancelled.';
                        $this->session->setFlashdata('success_response_for_sweet_alert', $message);
                    } else {
                        $success = false;
                        $message = 'Error occured.';
                    }
                    echo json_encode(array('success' => $success, 'message' => $message, 'token' => $token));
                    break;

                case 'delete_my_ad':
                    $record_id = $post['record_id'];

                    $this->home_model->_delete('ad_dates', " ad_id = '" . $record_id . "' ");
                    $delete = $this->home_model->_delete('ad_collections', " id = '" . $record_id . "' ");
                    if ($delete) {
                        $success     = true;
                        $message     = 'Your ad deleted successfully.';
                        $this->session->setFlashdata('success_response_for_sweet_alert', $message);
                    } else {
                        $success = false;
                        $message = 'Error occured.';
                    }
                    echo json_encode(array('success' => $success, 'message' => $message, 'token' => $token));
                    break;

                case 'rejectReservation':
                    $record_id = $post['record_id'];
                    $update_data['is_booked'] = 0;
                    $update_data['booking_status'] = 2;

                    $update = $this->home_model->_update('ad_dates', $update_data, " id IN (" . $record_id . ") ");
                    if ($update) {
                        $success     = true;
                        $message     = 'Your have rejected the booking successfully.';
                        $this->session->setFlashdata('success_response_for_sweet_alert', $message);
                    } else {
                        $success = false;
                        $message = 'Error occured.';
                    }
                    echo json_encode(array('success' => $success, 'message' => $message, 'token' => $token));
                    break;

                case 'approveReservation':
                    $record_id = $post['record_id'];
                    $update_data['booking_status'] = 1;

                    $update = $this->home_model->_update('ad_dates', $update_data, " id IN (" . $record_id . ") ");

                    if ($update) {
                        $success     = true;
                        $message     = 'Your have approved the booking successfully.';
                        $this->session->setFlashdata('success_response_for_sweet_alert', $message);
                    } else {
                        $success = false;
                        $message = 'Error occured.';
                    }
                    echo json_encode(array('success' => $success, 'message' => $message, 'token' => $token));
                    break;
            }
        }
    }

    public function my_account()
    {
        if (!$this->session->has('seller_id')) return redirect()->to('/');
        $this->_data['page_title'] = 'My Account';
        $this->_data['profile_data'] = $this->home_model->get_single_row('seller_profiles', " where id = '" . $this->profile_id . "' ");

        if ($this->request->getMethod() == 'post') {
            $response = [];
            $token = csrf_hash();
            $rules = [

                'seller_first_name' => [
                    'label'  => 'seller_first_name',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your First Name',
                    ],
                ],
                'seller_last_name' => [
                    'label'  => 'seller_last_name',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your Last Name',
                    ],
                ],
                'seller_phone' => [
                    'label'  => 'seller_phone',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your Phone Number',
                    ],
                ],
                'about_seller' => [
                    'label'  => 'seller_phone',
                    'rules'  => 'trim'
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'trim',
                    'errors' => [
                        'required' => 'Enter your password',
                    ],
                ]
            ];
            $errors_before_form = 0;
            $post              = $this->request->getPost();
            $current_password = $post['current_password'];
            if (!empty($current_password)) {
                $rules['new_password'] =  [
                    'label'  => 'Password',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'Enter your new password',
                    ],
                ];
                $current_password = md5($current_password);
                $row = $this->home_model->get_single_row('seller_profiles', " where id = '" . $this->profile_id . "' AND secret_word = '" . $current_password . "' ");
                if ($row) {
                } else {
                    $this->session->setFlashdata('response', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Wrong current password entered</div>');
                    $errors_before_form++;
                }
            }

            if (!$this->validate($rules) || $errors_before_form > 0) {
                $response = ['success' => false, 'msg' => \Config\Services::validation()->listErrors('my_list'), 'token' => $token];
            } else if ($this->validate($rules) && $errors_before_form == 0) {
                $post              = $this->request->getPost();
                $seller_first_name = $post['seller_first_name'];
                $seller_last_name  = $post['seller_last_name'];

                $about_seller      = $post['about_seller'];
                $current_password = $post['current_password'];
                if (!empty($new_password)) {
                    $ins_data['secret_word'] = md5($post['new_password']);
                }


                $ins_data['seller_first_name'] = $seller_first_name;
                $ins_data['seller_last_name'] = $seller_last_name;
                $ins_data['about_seller'] = $about_seller;
                $ins_data['seller_phone'] = $post['seller_phone'];

                $ins_data['update_date'] = date('Y-m-d H:i:s');
                $ins_data['update_ip'] = $_SERVER['REMOTE_ADDR'];
                $ins               = $this->home_model->_update('seller_profiles', $ins_data, " id = '" . $this->seller_id . "' ");
                if ($ins) {
                    $msg = 'Your account has been created successfully. Now you can login with your email and password.';
                    $this->session->setFlashdata('success_response_for_sweet_alert', $msg);
                    $success = true;
                } else {
                    $success = false;
                    $msg = 'Error occured. Data not saved.';
                    $this->session->setFlashdata('failed_response_for_sweet_alert', $msg);
                }
                $response['success'] = $success;
                $response['msg']     = $msg;
                $response['token']   = $token;
            }
            echo json_encode($response);
        }

        $this->_data['my_ads']       = $this->home_model->get_user_ads($this->profile_id);
        echo view('frontend/header', $this->_data);
        echo view('frontend/my_account');
        echo view('frontend/footer');
    }

    public function my_ads()
    {
        if (!$this->session->has('seller_id')) return redirect()->to('/');
        $db_conf = array("type" => strtolower($this->db->DBDriver), "server" => $this->db->hostname, "user" => $this->db->username, "password" => $this->db->password, "database" => $this->db->database);

        $g = new Jqgrid($db_conf);
        $opt["caption"] = "";
        $opt['rownumbers']  = true;
        $opt["loadComplete"] = "function(ids) { grid_onload(ids); }";

        $opt["shrinkToFit"] = true;
        $opt["width"] = "800";
        $g->set_options($opt);

        $g->table = "ad_collections";
        $g->set_actions(
            array(
                "add" => false,
                "edit" => false,
                "delete" => false,
                "showhidecolumns" => false,
                "rowactions" => false,
                "autofilter" => true,
                "refresh" => false
            )
        );
        $g->select_command = "select ad_collections.*, ad_categories.cat_title, ad_categories.cat_img,  
                (SELECT COUNT(ad_dates.id) FROM ad_dates WHERE  ad_dates.`ad_id` = ad_collections.id AND is_booked = 1 ) bookings
                from ad_collections
                INNER JOIN ad_categories on ad_categories.id = ad_collections.cat_id 
                where ad_collections.seller_id = '" . $this->profile_id . "' ";

        $col = array();
        $col["title"] = "ID";
        $col["name"] = "id";
        $col["width"] = "3";
        $col["editable"] = false;
        $col["search"] = false;
        $col["hidden"] = true;
        $cols[] = $col;

        $col = array();
        $col["title"] = "ad_picture_1";
        $col["name"] = "ad_picture_1";
        $col["width"] = "3";
        $col["editable"] = false;
        $col["search"] = false;
        $col["hidden"] = true;
        $cols[] = $col;

        $col = array();
        $col["title"] = "bookings";
        $col["name"] = "bookings";
        $col["width"] = "3";
        $col["editable"] = false;
        $col["search"] = false;
        $col["hidden"] = true;
        $cols[] = $col;


        $template = '<img width="30" height="30" src="' . base_url() . 'public/my_images/thumbnail/{ad_picture_1}">';
        $cols[] = array("title" => "", "width" => "50", "name" => "ad_picture_1_img", "editable" => false, "search" => false, "default" => $template);

        $cols[] = array("title" => "Accommodation Name", "name" => "acc_name", "editable" => false, "search" => true);

        $all_ad_categories = $this->home_model->get_categories();
        $str = ":--ALL--;";
        if ($all_ad_categories) {
            foreach ($all_ad_categories as $key => $value) {
                $str .= $value['id'] . ":" . $value['cat_title'];
                if ($key !== array_key_last($all_ad_categories)) {
                    $str .= ";";
                }
            }
        }

        $cols[] = array("title" => "Type of Accommodation", "name" => "cat_title", "editable" => false, "search" => true, "stype" => "select", "searchoptions" => array("value" => $str), "dbname" => "ad_collections.cat_id");
        $cols[] = array("title" => "Address", "name" => "address", "editable" => false, "search" => true);
        $cols[] = array("title" => "City", "name" => "city", "editable" => false, "search" => true);
        $cols[] = array("title" => "Country", "name" => "country", "editable" => false, "search" => true);

        $template = '<a title="View Ad Bookings" data-toggle="tooltip" class="btn btn-primary btn-sm text-white" href="' . base_url('/home/view_ad_bookings/') . '{id}" data-id="{id}">{bookings}</a>';
        $cols[] = array("title" => "Bookings", "name" => "view_ad_bookings", "editable" => false, "search" => false, "template" => $template, "width" => "50", "sortable" => false);

        $action_template = '<a title="Update Ad Details" data-toggle="tooltip" class="btn btn-primary btn-sm text-white" href="' . base_url('/home/post_ad/') . '{id}"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';

        $action_template .= '<a title="Delete Ad" data-toggle="tooltip" class="btn btn-danger btn-sm text-white delete_my_ad" href="javascript:void(0)" data-id="{id}" data-bookings="{bookings}" onclick="delete_my_ad(this)"><i class="fa fa-trash"></i></a>';


        $cols[] = array("title" => "Action", "name" => "update_info", "editable" => false, "search" => false, "template" => $action_template);

        $g->set_columns($cols);
        $this->_data['ad_grid_out'] = $g->render("gridlist");
        echo view('frontend/header', $this->_data);
        echo view('frontend/my_ads');
        echo view('frontend/footer');
    }

    public function my_reservations()
    {
        if (!$this->session->has('seller_id')) return redirect()->to('/');
        $db_conf = array("type" => strtolower($this->db->DBDriver), "server" => $this->db->hostname, "user" => $this->db->username, "password" => $this->db->password, "database" => $this->db->database);
        $g = new Jqgrid($db_conf);
        $opt["caption"] = "";
        $opt['rownumbers']  = true;
        $opt["loadComplete"] = "function(ids) { grid_onload(ids); }";
        $opt["shrinkToFit"] = false;
        $opt["width"] = "800";
        $g->set_options($opt);

        $g->table = "ad_collections";
        $g->set_actions(
            array(
                "add" => false,
                "edit" => false,
                "delete" => false,
                "showhidecolumns" => false,
                "rowactions" => true,
                "autofilter" => true,
                "refresh" => false
            )
        );
        $g->select_command = "SELECT a.id, acc_name,ad_date, c.`cat_title`, b.`ad_picture_1`, b.`address`, b.`city`, b.`country`,
                                CASE
                                    WHEN booking_status = 0 THEN 'Pending'
                                    WHEN  booking_status = 1 THEN 'Approved'
                                    WHEN  booking_status = 2 THEN 'Rejected'
                                END
                                as status, booking_status, d.seller_first_name, d.seller_phone
                                FROM `ad_dates` a
                                INNER JOIN ad_collections b ON a.`ad_id` = b.`id`
                                INNER JOIN ad_categories c ON c.id = b.`cat_id`
                                INNER JOIN seller_profiles d ON d.id = b.seller_id
                                WHERE a.`booked_by` = '" . $this->profile_id . "' ";
        // $col = array();
        // $col["title"] = "";
        // $col["name"] = "closed";
        // $col["width"] = "50";
        //  $col["search"] = false;
        //  $col["sortable"] = false;
        // $col["editable"] = true;
        // $col["edittype"] = "checkbox"; // render as checkbox
        // $col["editoptions"] = array("value"=>"1:0"); // with these values "checked_value:unchecked_value"

        // // custom formatter to show active checkbox
        // $col["formatter"] = "function(cellvalue, options, rowObject){ return cboxFormatter(cellvalue, options, rowObject); }";
        // $col["unformat"] = "function(cellvalue, options, cell){ return cboxUnFormat(cellvalue, options, cell);}";

        // $col["align"] = "center";
        // $cols[] = $col; 
        $col = array();
        $col["title"] = "ID";
        $col["name"] = "id";
        $col["width"] = "3";
        $col["editable"] = false;
        $col["search"] = false;
        $col["hidden"] = true;
        $cols[] = $col;

        $col = array();
        $col["title"] = "ad_picture_1";
        $col["name"] = "ad_picture_1";
        $col["width"] = "3";
        $col["editable"] = false;
        $col["search"] = false;
        $col["hidden"] = true;
        $cols[] = $col;

        $col = array();
        $col["title"] = "booking_status";
        $col["name"] = "booking_status";
        $col["width"] = "3";
        $col["editable"] = false;
        $col["search"] = false;
        $col["hidden"] = true;
        $cols[] = $col;

        // $template = '<input type="checkbox" value={id} name="ad_ids[]" class="ad_ids">';
        // $cols[] = array("title" => '<input type="checkbox" class="check_all_ad_ids">',"width"=>"50","name"=>"checkbox","editable" => false,"search"=>false,"sortable"=>false,"default" => $template);

        $template = '<img width="30" height="30" src="' . base_url() . 'public/my_images/thumbnail/{ad_picture_1}">';
        $cols[] = array("title" => "", "width" => "50", "name" => "ad_picture_1_img", "editable" => false, "search" => false, "default" => $template);

        $cols[] = array("title" => "Accommodation Name", "name" => "acc_name", "editable" => false, "search" => true);

        $all_ad_categories = $this->home_model->get_categories();
        $str = ":--ALL--;";
        if ($all_ad_categories) {
            foreach ($all_ad_categories as $key => $value) {
                $str .= $value['id'] . ":" . $value['cat_title'];
                if ($key !== array_key_last($all_ad_categories)) {
                    $str .= ";";
                }
            }
        }

        $cols[] = array("title" => "Reserve Date", "name" => "ad_date", "editable" => false, 'formatter' => 'date', 'formatoptions' => array("srcformat" => 'Y-m-d', "newformat" => 'd-m-Y', "opts" => array("changeYear" => true, "dateFormat" => 'dd-mm-yy')), "dbname" => "DATE_FORMAT(ad_date,'%Y-%m-%d')");
        $cols[] = array("title" => "Type of Accommodation", "name" => "cat_title", "editable" => false, "search" => true, "stype" => "select", "searchoptions" => array("value" => $str), "dbname" => "ad_collections.cat_id");
        $cols[] = array("title" => "Address", "name" => "address", "editable" => false, "search" => true);
        $cols[] = array("title" => "City", "name" => "city", "editable" => false, "search" => true);
        $cols[] = array("title" => "Country", "name" => "country", "editable" => false, "search" => true);
        $cols[] = array("title" => "Owner Name", "name" => "seller_first_name", "editable" => false, "search" => true);
        $cols[] = array("title" => "Owner Phone", "name" => "seller_phone", "editable" => false, "search" => true);
        $str = ":--ALL--;1:Approved;0:Pending;2:Rejected";
        $cols[] = array("title" => "Booking Status", "name" => "status", "editable" => false, "search" => true, "stype" => "select", "searchoptions" => array("value" => $str), "dbname" => "booking_status");

        $action_template .= '<a title="Cancel Reservation" data-toggle="tooltip" class="btn btn-danger btn-sm text-white cancelReservationBtn" href="javascript:void(0)" data-booking-status="{booking_status}" data-id="{id}" onclick="cancelReservation(this)"><i class="fa fa-trash"></i></a>';
        $cols[] = array("title" => "Action", "name" => "update_info", "editable" => false, "search" => false, "template" => $action_template, "width" => "50");

        $g->set_columns($cols);
        $this->_data['ad_reservations_grid_out'] = $g->render("gridlist");
        echo view('frontend/header', $this->_data);
        echo view('frontend/my_reservations');
        echo view('frontend/footer');
    }

    public function view_ad_bookings($ad_id)
    {
        if (!$this->session->has('seller_id')) return redirect()->to('/');
        $ad_detail = $this->home_model->get_user_ads('', $ad_id);
        if (!$ad_detail) return redirect()->to('/');
        $ad_booking_details = $this->home_model->get_ad_booking_details($ad_id);
        if (!$ad_booking_details) return redirect()->to('/');

        if (!$this->session->has('seller_id')) return redirect()->to('/');
        $db_conf = array("type" => strtolower($this->db->DBDriver), "server" => $this->db->hostname, "user" => $this->db->username, "password" => $this->db->password, "database" => $this->db->database);
        $g = new Jqgrid($db_conf);
        $opt["caption"] = "";
        $opt['rownumbers']  = true;
        $opt["loadComplete"] = "function(ids) { grid_onload(ids); }";
        $opt["shrinkToFit"] = false;
        $opt["width"] = "800";
        $g->set_options($opt);

        // set database table for CRUD operations
        $g->table = "ad_collections";
        $g->set_actions(
            array(
                "add" => false,
                "edit" => false,
                "delete" => false,
                "showhidecolumns" => false,
                "rowactions" => true,
                "autofilter" => true,
                "refresh" => false
            )
        );

        $g->select_command = "SELECT GROUP_CONCAT(a.id SEPARATOR ',') AS ids, GROUP_CONCAT(DATE_FORMAT(ad_date,'%d-%m-%Y') SEPARATOR ', ') AS reserve_dates, ad_picture_1, b.`acc_name`, b.`ad_desc`, b.`address`, 
                c.`seller_first_name`, a.`booking_status`,
                CASE
                    WHEN a.booking_status = 0 THEN 'Pending'
                    WHEN a.booking_status = 1 THEN 'Approved'
                    WHEN a.booking_status = 2 THEN 'Rejected'
                END
                as status, city, country, c.seller_phone, cat_title
                FROM `ad_dates` a
                INNER JOIN ad_collections b ON b.`id` = a.`ad_id`
                INNER JOIN ad_categories d ON d.`id` = b.cat_id
                INNER JOIN seller_profiles c ON c.id = a.`booked_by`
                where ad_id = '" . $ad_id . "'
                GROUP BY ad_id, booked_by";

        $col = array();
        $col["title"] = "ID";
        $col["name"] = "ids";
        $col["width"] = "3";
        $col["editable"] = false;
        $col["search"] = false;
        $col["hidden"] = true;
        $cols[] = $col;

        $col = array();
        $col["title"] = "ad_picture_1";
        $col["name"] = "ad_picture_1";
        $col["width"] = "3";
        $col["editable"] = false;
        $col["search"] = false;
        $col["hidden"] = true;
        $cols[] = $col;

        $col = array();
        $col["title"] = "booking_status";
        $col["name"] = "booking_status";
        $col["width"] = "3";
        $col["editable"] = false;
        $col["search"] = false;
        $col["hidden"] = true;
        $cols[] = $col;


        $template = '<img width="30" height="30" src="' . base_url() . 'public/my_images/thumbnail/{ad_picture_1}">';
        $cols[] = array("title" => "", "width" => "50", "name" => "ad_picture_1_img", "editable" => false, "search" => false, "default" => $template);

        $cols[] = array("title" => "Accommodation Name", "name" => "acc_name", "editable" => false, "search" => true);

        $all_ad_categories = $this->home_model->get_categories();
        $str = ":--ALL--;";
        if ($all_ad_categories) {
            foreach ($all_ad_categories as $key => $value) {
                $str .= $value['id'] . ":" . $value['cat_title'];
                if ($key !== array_key_last($all_ad_categories)) {
                    $str .= ";";
                }
            }
        }

        $cols[] = array("title" => "Reserve Dates", "name" => "reserve_dates", "editable" => false, "search" => false,);
        $cols[] = array("title" => "Type of Accommodation", "name" => "cat_title", "editable" => false, "search" => true, "stype" => "select", "searchoptions" => array("value" => $str), "dbname" => "ad_collections.cat_id");
        $cols[] = array("title" => "Booked by", "name" => "seller_first_name", "editable" => false, "search" => true);
        $cols[] = array("title" => "Phone", "name" => "seller_phone", "editable" => false, "search" => true);
        $cols[] = array("title" => "Address", "name" => "address", "editable" => false, "search" => true);
        $cols[] = array("title" => "City", "name" => "city", "editable" => false, "search" => true);
        $cols[] = array("title" => "Country", "name" => "country", "editable" => false, "search" => true);

        $str = ":--ALL--;1:Approved;0:Pending;2:Rejected";
        $cols[] = array("title" => "Booking Status", "name" => "status", "editable" => false, "search" => true, "stype" => "select", "searchoptions" => array("value" => $str), "dbname" => "booking_status");

        $template = '<a title="Approve Reservation" data-toggle="tooltip" class="btn btn-success btn-sm text-white approve_btn" href="javascript:void(0)" data-id="{ids}" data-booking-status="{booking_status}" onclick="approveReservation(this)"><i class="fa fa-check"></i></a>';
        $cols[] = array("title" => "Approve", "name" => "approve", "editable" => false, "search" => false, "template" => $template, "width" => "50");

        $action_template = '<a title="Reject Reservation" data-booking-status="{booking_status}" data-toggle="tooltip" class="btn btn-danger btn-sm text-white reject_btn" href="javascript:void(0)" data-id="{ids}" onclick="rejectReservation(this)"><i class="fa fa-trash"></i></a>';
        $cols[] = array("title" => "Reject", "name" => "reject", "editable" => false, "search" => false, "template" => $action_template, "width" => "50");

        $g->set_columns($cols);
        $this->_data['out'] = $g->render("gridlist");
        echo view('frontend/header', $this->_data);
        echo view('frontend/ad_booking_details');
        echo view('frontend/footer');
    }

    public function view_ad($ad_id, $my = "")
    {
        $ad_detail = $this->home_model->get_user_ads('', $ad_id);
        if (!$ad_detail) return redirect()->to('/');

        if ($this->session->has('seller_id') && $ad_detail['seller_id'] == $this->session->get('seller_id')) $my = 'y';
        $ad_dates_array = [];
        $ad_dates = $this->home_model->get_all_rows('ad_dates', "*", " where ad_id = '" . $ad_id . "' ", " ad_date asc");
        if ($ad_dates) {
            foreach ($ad_dates as $key => $date) {
                if ($date->is_booked == '1' || $date->ad_date < date('Y-m-d')) continue;
                $ad_dates_array[] = date('d-m-Y', strtotime($date->ad_date));
            }
        }
        $this->_data['ad_dates_array'] = $ad_dates_array;
        $ad_services_offered = $this->home_model->get_all_rows('ad_services_offered', "*", " where ad_id = '" . $ad_id . "' ");
        $this->_data['ad_id'] = $ad_id;
        $this->_data['ad_detail'] = $ad_detail;
        $this->_data['ad_dates'] = $ad_dates;
        $this->_data['ad_services_offered'] = $ad_services_offered;
        $this->_data['my'] = $my;
        echo view('frontend/header', $this->_data);
        echo view('frontend/view_ad');
        echo view('frontend/footer');
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to(base_url());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Social;
use App\Education;
use App\Work;
use Auth;
use Image;
use Hash;
use App\Http\Controllers\Proxynpm;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DomCrawler\Crawler;
use Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    public $response;
    private $client;
    public $equasis;
    public $path_proxy;
    public $vessle = null;
    public $output;
    public $erros = array();

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function change_skin(Request $request)
    {
        $user = Auth::User();
        $user->skin = $request->skin;
        if ($user->save()) {
            echo 'Tema berhasil diupdate.';
        } else {
            echo 'Tema gagal diupdate.';
        }
    }

    public function profile()
    {
        $profile = Auth::User();
        return view('config.profile', compact('profile'));
    }

    public function photo_profile(Request $request)
    {
        $user = Auth::User();
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $destination = base_path().'/public/uploads/images/users/';
            $filename = 'photo_'.$user->name.'.'.$photo->getClientOriginalExtension();
            if ($photo->isValid()) {
                if (!empty($user->photo)) {
                    if (file_exists($destination.$user->photo)) {
                        unlink($destination.$user->photo);
                    }
                    if (file_exists($destination.'fit_'.$user->photo)) {
                        unlink($destination.'fit_'.$user->photo);
                    }
                }
                $photo->move($destination, $filename);
                // open file a image resource
                $img = Image::make($destination.$filename);

                // crop image
                $img->fit(100)->save($destination.'fit_'.$filename);
                $user->photo = $filename;
                $user->save();
                $data['photo'] = $filename;
                $data['message'] = 'photo berhasil diedit!';
                echo json_encode($data);
            } else {
                echo 'photo gagal diedit!';
            }
        }
    }

    public function poster_profile(Request $request)
    {
        $user = Auth::User();
        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');
            $destination = base_path().'/public/uploads/images/posters/';
            $filename = 'poster_'.$user->name.'.'.$poster->getClientOriginalExtension();
            if ($poster->isValid()) {
                if (!empty($user->poster)) {
                    if (file_exists($destination.$user->poster)) {
                        unlink($destination.$user->poster);
                    }
                    if (file_exists($destination.'fit_'.$user->poster)) {
                        unlink($destination.'fit_'.$user->poster);
                    }
                }
                $poster->move($destination, $filename);
                // open file a image resource
                $img = Image::make($destination.$filename);

                // crop image
                $img->fit(300, 135, null, 'top')->save($destination.'fit_'.$filename);
                $user->poster = $filename;
                $user->save();
                $data['poster'] = $filename;
                $data['message'] = 'poster berhasil diedit!';
                echo json_encode($data);
            } else {
                echo 'poster gagal diedit!';
            }
        }
    }

    public function update_profile(Request $request)
    {
        $user = Auth::User();
        $column = $request->column;
        $user->$column = $request->value;
        if ($user->save()) {
            echo 'Data berhasil diupdate';
        } else {
            echo 'Data gagal diupdate';
        }
    }

    public function update_password(Request $request)
    {
        $user = Auth::User();
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            if ($user->save()) {
                $data['success'] = true;
                $data['message'] = "Password berhasil diganti!";
            } else {
                $data['success'] = false;
                $data['message'] = "Password gagal diganti!";
            }
        } else {
            $data['success'] = false;
            $data['message'] = "Password lama ga sesuai!";
        }
        echo json_encode($data);
    }

    public function get_address(Request $request)
    {
        $village_id = $request->village_id;
        $data['paddress'] = paddress($village_id);
        $data['address'] = address($village_id);
        echo json_encode($data);
    }

    public function remove_photo(Request $request)
    {
        $user = Auth::User();
        $user->photo = null;
        $data['photo'] = Auth::User()->gender == 'm' ? 'ikhwan.png' : 'akhwat.png';
        if ($user->save()) {
            $data['message'] = 'Photo berhasil dihapus!';
        } else {
            $data['message'] = 'Photo gagal dihapus!';
        }
        echo json_encode($data);
    }

    public function remove_poster(Request $request)
    {
        $user = Auth::User();
        $user->poster = null;
        if ($user->save()) {
            echo 'Poster berhasil dihapus!';
        } else {
            echo 'Poster gagal dihapus!';
        }
    }

    public function get_social(Request $request)
    {
        $social = Social::find($request->id);
        echo json_encode($social);
    }

    public function update_social(Request $request)
    {
        $social = Social::find($request->id);
        $social->name = $request->name;
        $social->icon = $request->icon;
        $social->link = $request->link;
        $social->color = $request->color;
        if ($social->save()) {
            echo 'Data media sosial berhasil diupdate!';
        } else {
            echo 'Data media sosial gagal diupdate!';
        }
    }

    public function add_social(Request $request)
    {
        $social = new Social;
        $social->name = $request->name;
        $social->icon = $request->icon;
        $social->link = $request->link;
        $social->color = $request->color;
        $social->user_id = Auth::User()->id;
        if ($social->save()) {
            $data['id'] = $social->id;
            $data['message'] = 'Data media sosial berhasil disimpan!';
            echo json_encode($data);
        } else {
            echo 'Data media sosial gagal disimpan!';
        }
    }

    public function remove_social(Request $request)
    {
        $user = Auth::User();
        $social = Social::where('id', $request->id)->where('user_id', Auth::User()->id)->first();
        if ($social) {
            $social->delete();
            echo 'Data media sosial berhasil dihapus!';
        } else {
            echo 'Data media sosial gagal dihapus!';
        }
    }

    public function get_education(Request $request)
    {
        $education = Education::find($request->id);
        echo json_encode($education);
    }

    public function update_education(Request $request)
    {
        $education = Education::find($request->id);
        $education->name = $request->name;
        $education->level = $request->level;
        $education->majors = $request->majors;
        $education->place = $request->place;
        $education->year_in = $request->year_in;
        $education->year_out = $request->year_out;
        $education->current = $request->status;
        if ($education->save()) {
            $data['level'] = education_levels($education->level);
            $data['message'] = 'Data riwayat pendidikan berhasil diupdate!';
            echo json_encode($data);
        } else {
            echo 'data riwayat pendidikan gagal diupdate!';
        }
    }

    public function add_education(Request $request)
    {
        $education = new Education;
        $education->user_id = Auth::User()->id;
        $education->name = $request->name;
        $education->level = $request->level;
        $education->majors = $request->majors;
        $education->place = $request->place;
        $education->year_in = $request->year_in;
        $education->year_out = $request->year_out;
        $education->current = $request->status;
        if ($education->save()) {
            $data['id'] = $education->id;
            $data['level'] = education_levels($education->level);
            $data['message'] = 'Data riwayat pendidikan berhasil disimpan!';
            echo json_encode($data);
        } else {
            echo 'Data riwayat pendidikan gagal disimpan!';
        }
    }

    public function remove_education(Request $request)
    {
        $user = Auth::User();
        $education = Education::where('id', $request->id)->where('user_id', Auth::User()->id)->first();
        if ($education) {
            $education->delete();
            echo 'Data riwayat pendidikan berhasil dihapus!';
        } else {
            echo 'Data riwayat pendidikan gagal dihapus!';
        }
    }

    public function get_work(Request $request)
    {
        $work = Work::find($request->id);
        echo json_encode($work);
    }

    public function update_work(Request $request)
    {
        $work = Work::find($request->id);
        $work->name = $request->name;
        $work->position = $request->position;
        $work->office = $request->office;
        $work->place = $request->place;
        $work->year_in = $request->year_in;
        $work->year_out = $request->year_out;
        $work->current = $request->status;
        if ($work->save()) {
            echo 'Data riwayat pekerjaan berhasil diupdate!';
        } else {
            echo 'data riwayat pekerjaan gagal diupdate!';
        }
    }

    public function add_work(Request $request)
    {
        $work = new Work;
        $work->user_id = Auth::User()->id;
        $work->name = $request->name;
        $work->position = $request->position;
        $work->office = $request->office;
        $work->place = $request->place;
        $work->year_in = $request->year_in;
        $work->year_out = $request->year_out;
        $work->current = $request->status;
        if ($work->save()) {
            $data['id'] = $work->id;
            $data['message'] = 'Data riwayat pekerjaan berhasil disimpan!';
            echo json_encode($data);
        } else {
            echo 'Data riwayat pekerjaan gagal disimpan!';
        }
    }

    public function remove_work(Request $request)
    {
        $user = Auth::User();
        $work = Work::where('id', $request->id)->where('user_id', Auth::User()->id)->first();
        if ($work) {
            $work->delete();
            echo 'Data riwayat pekerjaan berhasil dihapus!';
        } else {
            echo 'Data riwayat pekerjaan gagal dihapus!';
        }
    }

    // function for scraper website Equasis
    public function scraper()
    {
        $scraper = Auth::User();
        return view('scraper.scraper', compact('scraper'));
    }

    public function get_login($email, $password) {
        try {
            $this->client->request('GET', 'http://www.equasis.org/EquasisWeb/public/HomePage?fs=HomePage&P_ACTION=NEW_CONNECTION');
            $response = $this->client->request('POST', 'http://www.equasis.org/EquasisWeb/authen/HomePage?fs=HomePage', [
                'form_params' => [
                    'j_email' => $email,
                    'j_password' => $password,
                    'submit' => 'Login',
                ]
            ]);
        } catch (RequestException $e) {
            $this->errors[] = $e->getMessage();
        }
        if (empty($response)) {
            throw new Exception('Login response is empty ');
        }
        if ($response->getStatusCode() != 200) {
            throw new Exception('Response not 200 ');
        }
        return $response->getBody()->getContents();
    }

    public function scrape(Request $request) {
        $email= $request->email;
        $password= $request->password;
        $subname= $request->subname;
        $mmsi= $request->mmsi;
        $ship=$request->ship;
        $company=$request->company;
        try {
            echo var_dump('start guzzle');
            $this->setGuzzle();
            echo var_dump('finish guzzle');
            echo var_dump('start login');
            $this->get_login($email,$password);
            echo var_dump('finish login');
            if (!is_null($subname)) {
                $this->getByImo($subname);
            } else {
                $this->getByMmsi($mmsi);
                $html = $this->response->getBody()->getContents();
                $imos = $this->getImoFromSearch($html);
                $imo = trim($imos[0]);
            }

            $this->getVessle($imo);
            $html = $this->response->getBody()->getContents();
            if (strpos($html, 'No result has been found')) {
                $this->vessle = false;
            } else {
                if (strpos($html, 'equasis')) {
                    $this->vessleData($html);
                }
            }
        } catch (RequestException $e) {
            $this->errors[] = Psr7\str($e->getRequest());
        } catch (Exception $ex) {
            $this->erros[] = $ex->getMessage();
        }
    }

    public function getVessle($imo) {
        try {
            $this->response = $this->client->request('POST', 'http://www.equasis.org/EquasisWeb/restricted/ShipInfo?fs=Search', [
                'form_params' => [
                    'P_IMO' => $imo
                ]
            ]);
        } catch (RequestException $e) {
            $this->errors[] = Psr7\str($e->getRequest());
        }
        if ($this->response->getStatusCode() != 200) {
            throw new Exception($response->getStatusCode());
        }
    }

    public function getByMmsi($mmsi) {
        try {
            $this->response = $this->client->request('POST', 'http://www.equasis.org/EquasisWeb/restricted/Search?fs=Search', [
                'form_params' => [
                    'P_PAGE' => 1,
                    'P_PAGE_COMP' => 1,
                    'P_PAGE_SHIP' => 1,
                    'ongletActifSC' => 'ship',
                    'P_ENTREE_HOME_HIDDEN' => '',
                    'P_IMO' => '',
                    'P_CALLSIGN' => '',
                    'P_NAME' => '',
                    'P_NAME_cu' => 'on',
                    'P_MMSI' => $mmsi,
                    'P_GT_GT' => '',
                    'P_GT_LT' => '',
                    'P_DW_GT' => '',
                    'P_DW_LT' => '',
                    'P_YB_GT' => '',
                    'P_YB_LT' => '',
                    'P_CLASS_rb' => 'HC',
                    'P_CLASS_ST_rb' => 'HC',
                    'P_FLAG_rb' => 'HC',
                    'P_CatTypeShip_rb' => 'HC',
                    'buttonAdvancedSearch' => 'advancedOk',
                ]
            ]);
        } catch (RequestException $e) {
            $this->errors[] = Psr7\str($e->getRequest());
        }
        if ($this->response->getStatusCode() != 200) {
            throw new Exception($this->response->getStatusCode());
        }
    }

    public function getByImo($imo) {
        try {
            $this->response = $this->client->request('POST', 'http://www.equasis.org/EquasisWeb/restricted/Search?fs=Search', [
                'form_params' => [
                    'P_PAGE' => '1',
                    'P_PAGE_COMP' => '1',
                    'P_PAGE_SHIP' => '1',
                    'ongletActifSC' => 'ship',
                    'P_ENTREE_HOME_HIDDEN' => $imo,
                    'P_ENTREE' => $imo,
                    'checkbox-shipSearch' => 'Ship',
                    'Submit' => 'SEARCH'
                ]
            ]);
            echo var_dump($this->response);
        } catch (RequestException $e) {
            $this->errors[] = Psr7\str($e->getRequest());
        }
        if ($this->response->getStatusCode() != 200) {
            throw new Exception($this->response->getStatusCode());
        }
    }

    public function setGuzzle() {
//        echo var_dump($this->path_proxy);
//        $proxys = new Proxynpm($this->path_proxy);
//        $proxys->output = $this->output;
//        $proxy = $proxys->getProxy();
        $this->setHeaders();
        $this->client = new Client([
            'headers' => $this->setHeaders(),
            'timeout' => 60,
            'cookies' => new \GuzzleHttp\Cookie\CookieJar,
            'http_errors' => false,
            'allow_redirects' => true
//            'allow_redirects' => true,
//            'proxy' => 'tcp://' . $proxy['ip'] . ':' . $proxy['port']
        ]);
//        $this->client = new \GuzzleHttp\Client();
    }

    private function setHeaders() {
        return [
            'User-Agent' => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0",
            'Accept-Language' => "en-US,en;q=0.5"
        ];
    }

    function getImoFromSearch($html) {
        $crawler = new Crawler($html);
        $imo = $crawler->filter('#ShipResultId')->each(function($node, $key) {
            return $node->filter('a')->eq(0)->text();
        });
        return $imo;
    }

    function vessleData($html) {
        $this->vessle = array();

        $html = new \Symfony\Component\DomCrawler\Crawler($html);

        $this->vessle['nome'] = trim($html->filter('.color-gris-bleu-copyright > b:nth-child(1)')->text());
        $this->vessle['imo'] = trim($html->filter('.color-gris-bleu-copyright > b:nth-child(2)')->text());

        $html->filter('.access-body > div:nth-child(1) > div:nth-child(1) > div')->each(function($v, $k) {
            $lable = $v->filter('div')->eq(0)->text();
            switch (true) {
                case (strpos($lable, 'Flag')):
                    $this->vessle['bandeira'] = str_replace('(', '', trim($v->filter('div:nth-child(4) ')->text()));
                    $this->vessle['bandeira'] = str_replace(')', '', $this->vessle['bandeira']);
                    break;
                case (strpos($lable, 'Call Sign')):
                    $this->vessle['callsign'] = str_replace('(', '', trim($v->filter('div:nth-child(2) ')->text()));
                    break;
                case (strpos($lable, 'MMSI')):
                    $this->vessle['mmsi'] = str_replace('(', '', trim($v->filter('div:nth-child(2) ')->text()));
                    break;
                case (strpos($lable, 'Gross tonnage')):
                    $this->vessle['tonnage'] = str_replace('(', '', trim($v->filter('div:nth-child(2) ')->text()));
                    break;
                case (strpos($lable, 'dwt')):
                    $this->vessle['dwt'] = str_replace('(', '', trim($v->filter('div:nth-child(2) ')->text()));
                    break;
                case (strpos($lable, 'Type of ship')):
                    $this->vessle['tipo'] = str_replace('(', '', trim($v->filter('div:nth-child(2) ')->text()));
                    break;
                case (strpos($lable, 'Year of build')):
                    $this->vessle['year'] = str_replace('(', '', trim($v->filter('div:nth-child(2) ')->text()));
                    break;
            }
        });

        $armadores = $html->filter("[name='formShipToComp'] > table tr ");
        if (sizeof($armadores) > 1) {
            $first = true;
            foreach ($armadores as $armador) {
                try {
                    if ($first == false) {
                        $linha = new \Symfony\Component\DomCrawler\Crawler($armador);
                        $this->vessle['armadores'][] = array(
                            'imo' => trim($linha->filter("a")->text()),
                            'tipo' => trim($linha->filter('td:nth-child(2)')->text()),
                            'nome' => trim($linha->filter('td:nth-child(3)')->text()),
                            'morada' => trim($linha->filter('td:nth-child(4)')->text())
                        );
                    }
                } catch (Exception $ex) {
                    echo $ex->getMessage() . "\n";
                }
                $first = false;
            }
        }
    }
}

<?phpnamespace App\Http\Controllers\Admin;use App\Http\Models\AdminRole;use Illuminate\Http\Request;class IndexController extends CommonController{    public function __construct()    {        parent::__construct();    }    public function logout(Request $request)    {        $request->session()->forget('admin_info');        return redirect('Admin/Login/index');    }    public function index()    {        $data = ['message_list'=>$this->message_list];        return view('Admin.Index.index',$data);    }    public function about_us()    {        return abort(404);    }    public function billboard()    {        return view('Admin.Index.billboard');    }}
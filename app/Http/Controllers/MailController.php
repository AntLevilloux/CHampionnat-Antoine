class TestController extends Controller
{
    public function store(Request $request)
    {
        $user = User::find($request['user_id']);
        $test = $this->respository->store($request->all());
        Mail::to($user)->send(new InfoMail($test));
    }
}

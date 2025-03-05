<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Member;
use App\Models\Faculty;
use App\Models\ProposalReview;
use App\Http\Requests\Admin\ProposalRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProposalController extends Controller
{
    use AuthorizesRequests;
    private $view;
    private $proposal;
    private $route;
    private $member;
    private $faculty;
    private $proposalReview;

    public function __construct(){
        $this->view = "pages.admin.proposal.";
        $this->proposal = new Proposal();
        $this->route = "admin.proposal.";
        $this->member = new Member();
        $this->faculty = new Faculty();
        $this->proposalReview = new ProposalReview();
    }

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $schemes = $request->input('filter_scheme', '');
        $facultyId = $request->input('filter_faculty', 'all');
        $status = $request->input('filter_status', 'all');

        // Query dasar dengan eager loading
        $query = Proposal::with(['leader', 'faculty', 'advisor', 'proposalReview']);

        // Jika ada pencarian, cari berdasarkan title, team_name, atau leader.name
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                ->orWhere('team_name', 'LIKE', "%{$search}%")
                ->orWhereHas('leader', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%"); // Pencarian berdasarkan nama leader
                });
            });
        }

        // Filter berdasarkan skema
        if (!empty($schemes)) {
            $schemesArray = explode(',', $schemes);
            $query->whereIn('scheme', $schemesArray);
        }

        // Filter berdasarkan fakultas
        if ($facultyId !== 'all') {
            $query->where('faculty_id', $facultyId);
        }

        // Filter berdasarkan status
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        // Ambil data dengan pagination
        $proposal = $query->paginate(10);
        $scheme = ['KI', 'KC', 'K', 'RE', 'RSH', 'PM', 'PI', 'VGK', 'GFT', 'AI'];
        $faculty = Faculty::all();

        // Ambil advisor berdasarkan proposal_id yang ditemukan
        $proposalIds = $proposal->pluck('id')->all();
        $advisor = Member::whereIn('proposal_id', $proposalIds)
            ->where('role_in_team', 'advisor')
            ->get()
            ->groupBy('proposal_id');

        $data = [
            'proposal' => $proposal,
            'advisor' => $advisor,
            'scheme' => $scheme,
            'faculty' => $faculty,
            'search' => $search
        ];
        if ($request->ajax()) {
            return view($this->view . "table", $data)->render();
        }
        return view($this->view . "index", $data);
    }


    public function edit(string $id=null){
        $proposal = $this->proposal::find($id);
        $faculty = $this->faculty::all();
        $advisor = $this->member::where('proposal_id', $id)
            ->where('role_in_team', 'advisor')
            ->get();
        $member = $this->member::where('proposal_id', $id)
            ->where('role_in_team', 'member')
            ->get();

        // Mengambil semua data review proposal berdasarkan id proposal
        $proposalReview = $this->proposalReview::where('proposal_id', $id)->get();

        return view($this->view."edit",[
            'proposal' => $proposal,
            'advisor' => $advisor,
            'member' => $member,
            'faculty' => $faculty,
            'proposalReview' => $proposalReview
        ]);
    }

    // Update Status Proposal
    public function store(Request $request){
        $status = $request->status;
        if ($request->has('id')) {
            $proposal = $this->proposal::findOrFail($request->id);
            $proposal->status = $status;
            $proposal->save();
            alert()->html('Berhasil', 'Status berhasil diubah', 'success');
            return redirect()->back();
        }
    }

    // Tambah Log Catatan Review Proposal
    // proposal_id = id proposal yang dikirim dari $proposal->id pada method edit
    public function review(string $proposal_id, string $id=null){
        $proposalReview = null;
        $proposal = $this->proposal::findOrFail($proposal_id);
        if ($id) {
            $proposalReview = $this->proposalReview::findOrFail($id);
        }
        return view($this->view."review",[
            'proposal_id' => $proposal_id,
            'proposal' => $proposal,
            'proposalReview' => $proposalReview
        ]);
    }

    public function storeReview(string $proposal_id, ProposalRequest $request){
        $validatedData = $request->validated();
        $validatedData['proposal_id'] = $proposal_id;

        if ($request->has('id')) {
            $proposalReview = $this->proposalReview::findOrFail($request->id);
            $this->authorize('update', $proposalReview);
            $proposalReview->update($validatedData);
            alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
            return redirect()->route($this->route . 'edit', ['id' => $proposal_id]);
        } else {
            $proposalReview = $this->proposalReview::create($validatedData);
            alert()->html('Berhasil', 'Data berhasil ditambahkan', 'success');
            return redirect()->route($this->route . 'edit', ['id' => $proposal_id]);
        }
    }

    public function upload(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('storage'), $fileName);

            $url = asset('storage/'.$fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}

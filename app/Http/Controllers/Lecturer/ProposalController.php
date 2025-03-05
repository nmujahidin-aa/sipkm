<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Member;
use App\Models\User;
use App\Models\ProposalReview;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleEnum;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Lecturer\ProposalRequest;

class ProposalController extends Controller
{
    use AuthorizesRequests;
    private $view;
    private $proposal;
    private $member;
    private $proposalReview;
    private $user;
    private $route;

    public function __construct(){
        $this->member = new Member();
        $this->proposal = new Proposal();
        $this->proposalReview = new ProposalReview();
        $this->view = "pages.lecturer.proposal.";
        $this->user = new User();
        $this->route = "dosen.proposal.";
    }
    public function index(){
        $member = $this->member::where('user_id', Auth::user()->id)->get();
        $proposal = $this->proposal::with('user')->whereIn('id', $member->pluck('proposal_id'))->get();
        $advisor = $this->member::whereIn('proposal_id', $proposal->pluck('id')->all())
            ->where('role_in_team', 'advisor')
            ->get()
            ->groupBy('proposal_id');

        // Cari di model member dimana semua yang mempunyai proposal_id sama dengan $proposal->id dan value dari role_in_team = member
        $proposal_member = $this->member::whereIn('proposal_id', $proposal->pluck('id')->all())
            ->where('role_in_team', 'member')
            ->get()
            ->groupBy('proposal_id');

        // Cari proposal review by proposal_id
        $proposalReview = $this->proposalReview::whereIn('proposal_id', $proposal->pluck('id')->all())
            ->where('status', false)
            ->get()
            ->groupBy('proposal_id');

        return view($this->view . "index",[
            'proposal' => $proposal,
            'proposal_member' => $proposal_member,
            'advisor' => $advisor,
            'proposalReview' => $proposalReview
        ]);
    }

    public function edit(string $id = null){
        $proposal = null;
        if ($id) {
            $proposal = $this->proposal::findOrFail($id);
            $this->authorize('update', $proposal);
        }
        $members = $this->user->role(RoleEnum::MAHASISWA)->get();
        $advisors = $this->user->role(RoleEnum::DOSEN)->get();

        // Mengambil semua data review proposal berdasarkan id proposal
        $proposalReview = $this->proposalReview::where('proposal_id', $id)->get();

        return view($this->view."edit",[
            'proposal' => $proposal,
            'members' => $members,
            'advisors' => $advisors,
            'proposalReview' => $proposalReview
        ]);
    }

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

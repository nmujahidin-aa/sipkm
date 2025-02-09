<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleEnum;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\ProposalRequest;

class ProposalController extends Controller
{
    private $view;
    private $route;
    private $proposal;
    private $member;
    private $user;
    public function __construct()
    {
        $this->view = "pages.user.proposal.";
        $this->route = "proposal.";
        $this->proposal = new Proposal();
        $this->member = new Member();
        $this->user = new User();
    }

    public function index()
    {
        $member = $this->member::where('user_id', Auth::user()->id)->get();
        $proposal = $this->proposal::whereIn('id', $member->pluck('proposal_id'))->get();
        $advisor = $this->member::where('proposal_id', $proposal->pluck('id')->all())
            ->where('role_in_team', 'advisor')
            ->get()
            ->keyBy('proposal_id');

        // Cari di model member dimana semua yang mempunyai proposal_id sama dengan $proposal->id dan value dari role_in_team = member
        $proposal_member = $this->member::whereIn('proposal_id', $proposal->pluck('id')->all())
            ->where('role_in_team', 'member')
            ->get()
            ->groupBy('proposal_id');

        return view($this->view . "index",[
            'proposal' => $proposal,
            'proposal_member' => $proposal_member,
            'advisor' => $advisor,
        ]);
    }

    public function edit(string $id = null){
        $proposal = null;
        if ($id) {
            $proposal = $this->proposal::findOrFail($id);
        }
        $members = $this->user->role(RoleEnum::MAHASISWA)->get();
        $advisors = $this->user->role(RoleEnum::DOSEN)->get();
        $scheme = ['KI', 'KC', 'K', 'RE', 'RSH', 'PM', 'PI', 'VGK', 'GFT', 'AI'];

        return view($this->view."edit",[
            'proposal' => $proposal,
            'members' => $members,
            'advisors' => $advisors,
            'scheme' => $scheme,
        ]);
    }

    public function store(ProposalRequest $request)
    {
        $validatedData = $request->validated();

        // Jika ini proses edit, ambil proposal yang sudah ada
        $proposal = $request->has('id') ? $this->proposal::findOrFail($request->id) : null;

        // Upload file jika ada file baru yang diunggah
        if ($request->hasFile('file')) {
            $user = User::findOrFail($request->leader_id);
            $name = preg_replace('/\s+/', '', $user->name);
            $fileName = $name . '_UniversitasNegeriMalang_' . $request->scheme . '.' . $request->file->getClientOriginalExtension();
            $validatedData['file'] = $request->file->storeAs('proposal', $fileName, 'public');
        } elseif ($proposal && $proposal->file) {
            // Jika tidak ada file baru, pertahankan file lama
            $validatedData['file'] = $proposal->file;
        }

        // Tambahkan data dasar proposal
        $validatedData['status'] = 'new';
        $validatedData['faculty_id'] = User::findOrFail($request->leader_id)->faculty_id;

        // Simpan atau update proposal
        $proposal = $this->proposal::updateOrCreate(['id' => $request->id], $validatedData);

        // Hapus anggota lama sebelum menyimpan yang baru
        $proposal->proposalMembers()->delete();

        // Simpan advisor, leader, dan anggota tim
        $roles = [
            'advisor' => $request->advisors,
            'leader' => $request->leader_id,
            'member' => $request->members,
        ];

        foreach ($roles as $role => $users) {
            if ($users) {
                $users = is_array($users) ? $users : [$users];
                foreach ($users as $userId) {
                    $proposal->proposalMembers()->create([
                        'proposal_id' => $proposal->id,
                        'user_id' => $userId,
                        'role_in_team' => $role,
                    ]);
                }
            }
        }

        alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
        return redirect()->route($this->route . 'index')->with('success', 'Proposal berhasil disimpan!');
    }
}
